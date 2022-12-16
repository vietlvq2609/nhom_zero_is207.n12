<div style="width:600px; margin:0 auto">
    <div style="text-align:center">
        <h2>Xin chào {{ $user->name }}</h2>
        <p>Zero Food gửi email này để để xác nhận bạn hủy đơn hàng</p>
        <p><b>Thời gian:</b>{{ $shop_order->order_date }} </p>
        <p><b>Mã đơn hàng:</b>{{ $shop_order->id }} </p>
        <p><b>Phương thức thanh toán:</b> {{ $payment_method->value }} </p>
        <p><b>Phương thức vận chuyển:</b> {{ $shipping_method->name }} </p>
        <p><b>Địa chỉ giao hàng:</b> {{$shipping_address->unit}}, {{$shipping_address->unit}}, {{$shipping_address->street}}, {{$shipping_address->line1}}, {{$shipping_address->line2}}, {{$shipping_address->city}}, {{$shipping_address->country_name}}.</p>
        <p><b>Tổng tiền:</b>{{ $shop_order->order_total }} </p>
        <!-- chuyển khoảng ngân hàng = 2, ví điện tử =3 -->
        <p>Số tiền bạn đã gửi sẽ được hoàn lại vào tài khoản của bạn: {{$payment_method->value}}, {{$payment_method->provider}}, {{$payment_method->number}}</p>
        <p>
            <a style="display:inline-block; background: orange; color: #000; padding:7px 25px; font-weight:bold"
            href="{{ route('cart.cancleView') }}">Xem lại đơn hàng</a>
        </p>
    </div>
</div>