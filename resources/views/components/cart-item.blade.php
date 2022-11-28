@props(['item'])
<!-- khai báo các giá trị của các item khi khách hàng nhấn nút Đặt hàng -->
<!-- các giá trị này lưu trong thẻ input type="hidden" -->
<input type="hidden" name="">



<div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800">
    <div class="flex w-3/5 items-center w-3/5">
        <img src="{{ $item->product_image }}" class="w-16 h-16 object-contain">
        <p class="p-2">{{ $item->product_name }}</p>
        <p class="p-1 text-red-600 text-lg">{{ $item->variation_value }}</p>
    </div>
    <div class="flex justify-between items-center flex-1">
        <input type="hidden" id="price_{{$item->id}}" value="{{ $item->price }}">
        <div class="font-semibold">{{ $item->price }}đ</div>
        <input id="item_{{$item->id}}" type="number" name="qty" value="{{ $item->qty }}" class="w-10 py-0 px-1" 
            min="1" onchange="changeQty({{$item->id}})">
        <div>
            <!-- tạo thẻ input hidden để lưu tạm giá trị của tổng tiền sản phẩm -->
            <input type="hidden" id="tmp_product_tatal_price_{{$item->id}}" name="product_tatal_price" value="{{ $item->price * $item->qty}}">
            <div id="product_tatal_price_{{$item->id}}" class="font-semibold inline-block">{{ $item->price * $item->qty}}</div>
            <span class="font-semibold inline-block"> đ</span>
        </div>

        <!-- nút Xóa -->
        <a href="/cart/delete/{{$item->id}}/{{$item->qty}}" class="ml-6 text-red-500 text-lg underline rounded p-1 hover:scale-105"
            onclick="
                if(!confirm('Bạn có muốn xóa sản phẩm này ra khỏi giỏ hàng!')) 
                    event.preventDefault()">
            Xoá
        </a>
    </div>
</div>
