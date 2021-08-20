<h2>Hi {{ $user_name }}</h2>
<p>
    <b> Bạn đã đặt hàng tại cửa hàng của chúng tôi.!</b>
</p>
<h4>Thông tin đơn đặt hàng của bạn: </h4>
<h4>Mã đơn hàng: {{$bill}}</h4>
<h4>Ngày đặt hàng: {{formatDate($dayorder)}}</h4>

<h4>Chi tiết đơn hàng của bạn: </h4>
<table border="1" cellpadding="0" cellpadding="10" width="400px">
    <thead>
        <tr style="text-align: center">
            <th>Tên SP</th>
            <th>Giá</th>
            <th>Số Lượng</th>
            <th>Thành Tiền</th>
        </tr>
    </thead>
    <tbody>
    @php $total = 0; @endphp
    @foreach($order as $item)
        @if($item->promotion_price > 0)
            @php
                $total += $item->__get("promotion_price") * $item->order_qty;
            @endphp
        @else
            @php
                $total += $item->__get("unit_price") * $item->order_qty;
            @endphp
        @endif
        <tr style="text-align: center">
            <td>{{$item->name}}</td>
            <td>
                @if($item->promotion_price > 0)
                    {{number_format($item->promotion_price)}}
                @else
                    {{number_format($item->unit_price)}}
                @endif
            </td>
            <td>{{$item->cart_qty}}</td>
            <td>
                @if($item->promotion_price > 0)
                    {{number_format($item->promotion_price)}}
                @else
                    {{number_format($item->unit_price)}}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot><tr><td colspan="4" style="text-align: center">Total: {{number_format($total)}}</td></tr></tfoot>
</table>

<h4>Số tiền đã thanh toán: {{$paid}}</h4>
<h4>Số tiền còn phải thanh toán thanh toán: {{$unpaid}}</h4>
