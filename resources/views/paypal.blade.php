
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://bootstrap.hexschool.com/favicon.ico">

    <title>Paypal Test Form</title>

    <!-- Bootstrap core CSS -->
    <link href="https://bootstrap.hexschool.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://bootstrap.hexschool.com/docs/4.1/examples/checkout/form-validation.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.6/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Paypal Test Form</h2>
        <p class="lead">目前僅可用於沙盒環境 (Sandbox Environment)</p>
    </div>

    <div class="row">
        <div class="col-md-12 order-md-1">
            <h4 class="mb-3">購買商品</h4>
            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="lastName">商品名稱</label>
                        <input type="text" class="form-control" id="name" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">幣別</label>
                        <select class="custom-select d-block w-100" id="currency" required>
                            <option value="TWD">新台幣</option>
                            <option value="USD">美金</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName">商品數量</label>
                        <input type="number" class="form-control" id="mount" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            required.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName">價格</label>
                        <input type="number" class="form-control" id="price" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            required.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName">運費</label>
                        <input type="number" class="form-control" id="shipping_fee" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            required.
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="lastName">商品說明</label>
                        <input type="text" class="form-control" id="description" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block send-btn" type="button">確定結帳</button>
            </form>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-md-12 order-md-1">
            <h4 class="mb-3">退款</h4>
            <form class="needs-validation-2" novalidate>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="txn_id">交易 ID</label>
                        <input type="text" class="form-control" id="txn_id" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="refund_currency">幣別</label>
                        <select class="custom-select d-block w-100" id="refund_currency" required>
                            <option value="TWD">新台幣</option>
                            <option value="USD">美金</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="refund_money">金額</label>
                        <input type="number" class="form-control" id="refund_money" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            required.
                        </div>
                    </div>
                </div>
                <div class="alert alert-success" role="alert" style="display: none">
                    退款成功<br>
                    <a href="https://dev.inredis.com/logs" target="_blank">查看 PayPal 回傳退款結果</a><br>
                    <a href="https://www.sandbox.paypal.com/myaccount/home" target="_blank">查看 PayPal 帳戶交易明細 (sb-ec1mf213505@business.example.com, PR?^kN>E)</a>
                </div>
                <div class="alert alert-warning" role="alert" style="display: none">
                    退款失敗<br>
                    <a href="https://dev.inredis.com/logs" target="_blank">查看 PayPal 回傳退款結果</a><br>
                    <a href="https://www.sandbox.paypal.com/myaccount/home" target="_blank">查看 PayPal 帳戶交易明細</a> (sb-ec1mf213505@business.example.com, PR?^kN>E)
                </div>
                <hr class="mb-4">
                <button class="btn btn-danger btn-lg btn-block send-refund-btn" type="button">確定退款</button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019 Yu Lin Chou</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="https://inredis.com">Support</a></li>
        </ul>
    </footer>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>window.jQuery || document.write('<script src="https://bootstrap.hexschool.com/docs/4.1/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="https://bootstrap.hexschool.com/docs/4.1/assets/js/vendor/popper.min.js"></script>
<script src="https://bootstrap.hexschool.com/docs/4.1/dist/js/bootstrap.min.js"></script>
<script src="https://bootstrap.hexschool.com/docs/4.1/assets/js/vendor/holder.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.6/dist/sweetalert2.all.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.send-btn', function(){
            Swal.fire({
                title: '交易處理中',
                html: '將訂單傳送至 PayPal... 請稍等',
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false,
            });
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            var validation = true;
            var args = {
                currency : $('#currency').val(),
                name : $('#name').val(),
                mount : $('#mount').val(),
                price : $('#price').val(),
                shipping_fee : $('#shipping_fee').val(),
                description : $('#description').val(),
            };

            // Loop over them and prevent submission
            Array.prototype.filter.call(forms, function(form) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    validation = false;
                }
                form.classList.add('was-validated');
            });
            setTimeout(function () {
                if (validation) {
                    $.ajax({
                        type: "post",
                        url: "/paypal",
                        dataType: "json",
                        data: args,
                        success: function (result) {
                            if (result.type === 'success') {
                                location.assign(result.paypal_url);
                            }
                        },
                        error: function () {
                            console.log('error')
                        }
                    });
                }
            }, 1000);

        });


        $(document).on('click', '.send-refund-btn', function(){
            Swal.fire({
                title: '退款處理中',
                html: '將退款資訊傳送至 PayPal... 請稍等',
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false,
            });
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation-2');
            var validation = true;
            var args = {
                currency : $('#refund_currency').val(),
                money : $('#refund_money').val(),
                txn_id : $('#txn_id').val(),
            };

            // Loop over them and prevent submission
            Array.prototype.filter.call(forms, function(form) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    validation = false;
                }
                form.classList.add('was-validated');
            });
            setTimeout(function () {
                if (validation) {
                    $.ajax({
                        type: "post",
                        url: "/refund",
                        dataType: "json",
                        data: args,
                        success: function (result) {
                            Swal.fire('Complete');
                            if (result.type === 'success') {
                                $('.alert-success').show();
                                $('.alert-warning').hide();
                            } else {
                                $('.alert-warning').show();
                                $('.alert-success').hide();
                            }
                        },
                        error: function () {
                            console.log('error')
                        }
                    });
                }
            }, 1000);

        });
    })();
</script>
</body>
</html>
