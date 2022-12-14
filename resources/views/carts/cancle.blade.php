<x-layout>
    <div class="container lg:w-3/5 md:w-10\/12 sm:w-10\/12">
        <h1 id="Gio_Hang" class="text-primary text-2xl font-semibold py-4">Đã hủy</h1>
        <div class="divide-y-4 divide-white">
            <div class="flex items-center py-3 px-5 w-full rounded text-sm text-gray-800">
                <div class="flex justify-between items-center flex-1">
                    <div class="font-semibold">
                        <a href="/cart" >Mua</a>    
                    </div>
                    <div class="font-semibold">
                        <!-- order_statuses có status là "đang xử lý" -->
                        <a href="{{route('cart.prepareView')}}">Đang chuẩn bị hàng</a>    
                    </div>
                    <div class="font-semibold">
                        <!-- order_statuses có status là "đang giao" -->
                        <a href="{{route('cart.shippingView')}}">Đang giao</a>    
                    </div>
                    <div class="font-semibold">
                        <!-- order_statuses có status là "giao thành công" -->
                        <a href="{{route('cart.receiveView')}}">Đã nhận</a>    
                    </div>
                    <div class="font-semibold">
                        <!-- order_statuses có status là "giao thành công" -->
                        <a href="{{route('cart.boughtView')}}">Đã mua</a>    
                    </div>
                    <div class="font-semibold text-red-600 text-lg">
                        <!-- order_statuses có status là "Đã hủy" -->
                        <a href="#">Đã hủy</a>    
                    </div>
                </div>
            </div>

            @foreach ($bills as $bill)
                <x-order_bills :bill="$bill" :items="$items"/>
            @endforeach
        </div>
    <div>
</x-layout>