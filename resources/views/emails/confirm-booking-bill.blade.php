<div style="width:600px; margin:0 auto">
    <div style="text-align:center">
        <h2>Xin chào {{ $user->name }}</h2>
        <p>Zero Food gửi email này để để xác nhận đơn hàng bạn đã đặt và thông báo về phương thức thanh toán cho đơn hàng</p>
        <p><b>Thời gian:</b>{{ $shop_order->order_date }} </p>
        <p><b>Mã đơn hàng:</b>{{ $shop_order->id }} </p>
        <p><b>Phương thức thanh toán:</b> {{ $payment_method->value }} </p>
        <p><b>Phương thức vận chuyển:</b> {{ $shipping_method->name }} </p>
        <p><b>Địa chỉ giao hàng:</b> {{$shipping_address->unit}}, {{$shipping_address->unit}}, {{$shipping_address->street}}, {{$shipping_address->line1}}, {{$shipping_address->line2}}, {{$shipping_address->city}}, {{$shipping_address->country_name}}.</p>
        <p><b>Tổng tiền:</b>{{ $shop_order->order_total }} </p>
        <!-- chuyển khoảng ngân hàng = 2, ví điện tử =3 -->
        @if($shop_order->payment_method_id == 2)
        <p>Xin chuyển khoản về số tài khoản: xxx, ngân hàng yyy, nội dung chuyển khoảng: Mã đơn hàng của bạn  </p>
        @else
        <p>Xin chuyển khoản về tài khoản: xxx, Ví điện tử: yyy, nội dung chuyển khoảng: Mã đơn hàng của bạn </p>
        @endif
        <p>Nếu có thông tin gì <b>sai</b>, xin hủy đơn hàng sau đó vào trang <b>đặt lại</b> sau đó thay đổi thông tin và nhấn nút <b>đặt hàng</b></p>
        <p>
            <a style="display:inline-block; background: orange; color: #000; padding:7px 25px; font-weight:bold"
            href="{{ route('cart.prepareView') }}">Xem lại đơn hàng</a>
        </p>
    </div>
</div>