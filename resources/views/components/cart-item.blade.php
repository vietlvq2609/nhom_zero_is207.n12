@props(['item','QtyOfItemInCart'])
<!-- khai báo các giá trị của các item khi khách hàng nhấn nút Đặt hàng -->
<!-- các giá trị này lưu trong thẻ input type="hidden" -->
    <input type="hidden" name="cart_item_id[{{ $QtyOfItemInCart }}]" value="{{ $item->product_items_id }}">
    <input type="hidden" name="cart_item_qty[{{ $QtyOfItemInCart }}]" value="{{ $item->qty }}">
    <input type="hidden" name="cart_item_price[{{ $QtyOfItemInCart }}]" value="{{ $item->price }}">


<div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800">

    <!-- hình ảnh, tên, loại order -->

    <a href="/products/{{ $item->product_id }}" class="flex w-3/5 items-center w-3/5">
        <img src="{{ $item->product_image }}" class="w-16 h-16 object-contain">
        <p class="p-2">{{ $item->product_name }}</p>
        <p class="p-1 text-red-600 text-lg">{{ $item->variation_value }}</p>
    </a>

    <div class="flex justify-between items-center flex-1">

        <!-- giá cố định -->

        <div class="font-semibold">{{ $item->price }}đ</div>

        <!-- số lượng sản phẩm -->

        <div class="font-semibold">{{ $item->qty }}</div>

        <!-- tiền hàng -->

        <div>
            <div class="font-semibold inline-block">{{ $item->price * $item->qty}}</div>
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
