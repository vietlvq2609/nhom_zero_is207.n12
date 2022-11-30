@props(['bill','items'])

@php 
    $bill_total = 0
@endphp

<div class="mt-6">
    <div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800">
        Mã đơn: {{ $bill->id}}
    </div>
    <div class="flex-column bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800 mt-6">
        <div class="flex">
            <div class="flex w-3/5 items-center w-3/5">
                <p class="p-2">Sản phẩm</p>
            </div>
            <div class="flex justify-between items-center flex-1">
                <div class="p-2">Đơn giá</div>
                <div class="p-2">Số lượng</div>
                <div class="p-2">Số tiền</div>
                @if($bill->status == 5)
                <div class="p-2">Thao tác</div>
                @endif
            </div>
        </div>

        <div class="flex-comun">
            @foreach ($items as $item)
            @if( $item->order_id == $bill->id )
                @php 
                    $bill_total = $bill_total + $item->price * $item->qty
                @endphp
                <x-order_items :item="$item" :order_status="$bill->status"/>
            @endif
            @endforeach
        </div>
    </div>
    <div id="ShippingMethodAndTotal" class="flex-column py-3 px-5 w-full ml-auto mt-8">
        <div class="flex">
            <div class="size-selector relative mr-8">
                <p class="font-semibold inline-block">
                    {{$bill->ship_name}}
                </p>
            </div>
    
            <!-- Phí ship -->
    
            <div class="flex justify-between ml-auto px-5">
                <div class="px-5">Phí ship:</div>
                <div id="show_ship_cost" >{{$bill->ship_price}} đ</div>
            </div>
        </div>
    
        <div class="flex py-3 px-5 justify-between w-2/5 ml-auto mt-8">
            <div class="uppercase text-blue-900 text-lg">Tổng cộng:</div>
            <div id="total">{{ $bill_total + $bill->ship_price}} đ</div>
        </div>
    
        <div class="flex justify-between py-3">
            <p class="text-gray-800">{{$bill->unit}}, {{$bill->street}}, {{$bill->address1}}, {{$bill->address2}}, {{$bill->city}}, {{$bill->country_name}}.</p>
        </div>
    
            <!-- phương thức thanh toán -->
    
        <div class="flex justify-between">
            <p class="text-gray-800">{{$bill->value}}, {{$bill->provider}}, {{$bill->account_number}}.</p>
        </div>
    </div>
    <div class="flex justify-end ">
        @if($bill->status == 2)
        <a href="/cart/receive/{{$bill->id}}" class="ml-6 text-red-500 text-lg underline rounded p-1 hover:scale-105"
            onclick="
                if(!confirm('Xác nhận đã nhận đơn hàng')) 
                    event.preventDefault()">
            Xác nhận đã nhận hàng
        </a>
        @elseif ($bill->status == 4 || $bill->status == 5)
        <a href="/cart/buyAgain/{{$bill->id}}" class="ml-6 text-red-500 text-lg underline rounded p-1 hover:scale-105"
            onclick="
                if(!confirm('Xác nhận mua lại đơn hàng! Các đơn hàng đã hết sản phẩm sẽ không được đưa vào giỏ hàng!')) 
                    event.preventDefault()">
            Mua lại
        </a>
        @else
        <a href="/cart/cancle/{{$bill->id}}" class="ml-6 text-red-500 text-lg underline rounded p-1 hover:scale-105"
            onclick="
                if(!confirm('Xác nhận hủy đơn hàng!')) 
                    event.preventDefault()">
            Hủy đơn hàng
        </a>
        @endif
    </div>
</div>