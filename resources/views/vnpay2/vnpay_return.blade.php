<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset("/css/assets/bootstrap.min.css")}}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="{{asset("/css/assets/jumbotron-narrow.css")}}" rel="stylesheet">
    <script src="{{asset("/css/assets/jquery-1.11.3.min.js")}}"></script>
</head>
<body>
<div class="container" style="text-align: center;border: 1px solid lightgoldenrodyellow;padding-top:20px;border-radius: 5px;box-shadow: 0 0 5px 7px #e7e7e7">
    <div class="header clearfix">
        <h3 class="text-muted">Thông tin giao dịch VNPAY</h3>
    </div>
    <div class="table-responsive">
        <div class="form-group">
            <label >Mã đơn hàng: </label>
            <label>{{$vnpayData['vnp_TxnRef']}}</label>
        </div>
        <div class="form-group">
            <label >Số tiền: </label>
            <label>{{number_format($vnpayData['vnp_Amount'] / 100)}} VND</label>
        </div>
        <div class="form-group">
            <label >Nội dung thanh toán: </label>
            <label>{{$vnpayData['vnp_OrderInfo']}}</label>
        </div>
        <div class="form-group">
            <label >Phản hồi GD: </label>
            <label>
                @if($vnpayData['vnp_ResponseCode'] == "00")
                    <span>Thành công</span>
                @else
                    <span>Không thành công</span>
                @endif
            </label>
        </div>
        <div class="form-group">
            <label >Mã GD Tại VNPAY: </label>
            <label>{{$vnpayData['vnp_TransactionNo']}}</label>
        </div>
        <div class="form-group">
            <label >Mã Ngân hàng: </label>
            <label>{{$vnpayData['vnp_BankCode']}}</label>
        </div>
        <div class="form-group">
            <label >Thời gian thanh toán:</label>
            <label>{{$vnpayData['vnp_PayDate']}}</label>
        </div>
        <div class="form-group">
            <label >Kết quả: GD Thành Công!</label>
            <br>
            <label style="margin-top: 15px">
                <a href="{{url("/")}}">
                    <button class="btn btn-success" style="outline: none">Trang chủ</button>
                </a>
            </label>
        </div>
    </div>
    <p>
        &nbsp;
    </p>
    <footer class="footer">
        <p>&copy; VNPAY <?php echo date('Y')?></p>
    </footer>
</div>
</body>
</html>

