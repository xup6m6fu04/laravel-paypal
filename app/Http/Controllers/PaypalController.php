<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Refund;
use PayPal\Api\Sale;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Log;

class PaypalController extends Controller
{
    protected $client_id;
    protected $client_secret;
    protected $callback_url;
    protected $paypal;

    public function __construct()
    {
        $this->client_id = config('paypal.client_id');
        $this->client_secret = config('paypal.client_secret');
        $this->callback_url = config('paypal.callback_url');

        $this->paypal = new ApiContext(
            new OAuthTokenCredential(
                $this->client_id,
                $this->client_secret
            )
        );
        // $this->paypal->setConfig(
        //     array(
        //         'mode' => 'live',
        //     )
        // );
    }

    public function pay(Request $request)
    {
        $data = $request->all();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($data['name'])
             ->setCurrency($data['currency'])
             ->setQuantity($data['mount'])
             ->setPrice($data['price']);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($data['shipping_fee'])
                ->setSubtotal($data['price'] * $data['mount']);

        $amount = new Amount();
        $amount->setCurrency($data['currency'])
               ->setTotal($data['price'] * $data['mount'] + $data['shipping_fee'])
               ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription($data['description'])
                    ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($this->callback_url . '?success=true')
                     ->setCancelUrl($this->callback_url . '/?success=false');

        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

        try {
            $payment->create($this->paypal);
        } catch (\PayPal\Exception\PayPalConnectionException $e) {
            Log::debug($e);
            return response()->json([
                'type' => 'failure',
                'message' => $e->getData()
            ]);
        }

        $approvalUrl = $payment->getApprovalLink();

        return response()->json([
            'type' => 'success',
            'paypal_url' => $approvalUrl
        ]);
    }

    public function callback(Request $request)
    {
        $request = $request->all();
        $success = trim($request['success']);

        if ($success == 'false' && !isset($request['paymentId']) && !isset($request['PayerID'])) {
            return view('results')->with([
                'status' => '取消付款',
                'results' => $request,
            ]);
        }

        $paymentId = trim($request['paymentId']);
        $PayerID = trim($request['PayerID']);

        if (!isset($success, $paymentId, $PayerID)) {
            return view('results')->with([
                'status' => '支付失敗',
                'results' => $request,
            ]);
        }

        $payment = Payment::get($paymentId, $this->paypal);
        $execute = new PaymentExecution();
        $execute->setPayerId($PayerID);

        try {
            $payment->execute($execute, $this->paypal);
        } catch (Exception $e) {
            return view('results')->with([
                'status' => '支付失敗',
                'results' => $request,
            ]);
        }

        return view('results')->with([
            'status' => '支付成功',
            'results' => $request,
        ]);
    }

    public function notify()
    {
        // 異步回調
        $json = file_get_contents('php://input');
        Log::info(json_encode(json_decode($json, true), 128));
        return "success";
    }

    public function refund(Request $request)
    {
        try {
            $data = $request->all();

            $txn_id = $data['txn_id'];  // 異步回調中拿到的 ID
            $amt = new Amount();
            $amt->setCurrency($data['currency'])
                ->setTotal($data['money']);  // 退款的費用

            $refund = new Refund();
            $refund->setAmount($amt);

            $sale = new Sale();
            $sale->setId($txn_id);

            $refundedSale = $sale->refund($refund, $this->paypal);
        } catch (Exception $e) {
            // PayPal 退款失敗
            Log::debug($e->getMessage());
            return response()->json([
                'type' => 'failure',
                'message' => $e->getMessage(),
            ]);
        }
        // 退款完成
        Log::info($refundedSale);
        return response()->json([
            'type' => 'success',
        ]);
    }
}
