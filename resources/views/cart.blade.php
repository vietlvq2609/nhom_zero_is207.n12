<x-layout>
    <div class="container w-3/5">
        <h1 class="text-primary text-2xl font-semibold py-4">Giỏ hàng</h1>
        @php
            $total = 0;
        @endphp
        <div class="divide-y-4 divide-white">
            <div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800">
                <div class="flex w-3/5 items-center w-3/5">
                    <p class="p-2">Sản phẩm</p>
                </div>
                <div class="flex justify-between items-center flex-1">
                    <div class="font-semibold">Đơn giá</div>
                    <div class="font-semibold">Số lượng</div>
                    <div class="font-semibold">Số tiền</div>
                    <div class="font-semibold">Thao tác</div>
                </div>
            </div>

            @foreach ($items as $item)
                <x-cart-item :item="$item" />
                @php
                    $total += $item->price * $item->qty;
                @endphp
            @endforeach
        </div>
        <div class="flex py-3 px-5 justify-between w-2/5 ml-auto mt-8">
            <div class="uppercase text-blue-900 text-lg">Tổng cộng:</div>
            <div>{{$total}}đ</div>
        </div>
        <button
            class="block m-auto w-3/5 py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Đặt
            hàng</button>
    </div>
</x-layout>
