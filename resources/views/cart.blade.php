<x-layout>
    <div class="container w-3/5">
        <form action="" method="POST">
            <h1 id="Gio_Hang" class="text-primary text-2xl font-semibold py-4">Giỏ hàng</h1>
            @php
                $total = 0;
                $QtyOfItemInCart = 0;
            @endphp
            <div class="divide-y-4 divide-white">
    
                <div class="flex items-center py-3 px-5 w-full rounded text-sm text-gray-800">
                    <div class="flex justify-between items-center flex-1">
                        <div class="font-semibold text-red-600 text-lg">
                            <a href="#" >Mua</a>    
                        </div>
                        <div class="font-semibold">
                            <!-- order_statuses có status là "đang xử lý" -->
                            <a href="#">Đang chuẩn bị hàng</a>    
                        </div>
                        <div class="font-semibold">
                            <!-- order_statuses có status là "đang giao" -->
                            <a href="#">Đang giao</a>    
                        </div>
                        <div class="font-semibold">
                            <!-- order_statuses có status là "giao thành công" -->
                            <a href="#">Đã nhận</a>    
                        </div>
                    </div>
                </div>
    
                <div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800 mt-6">
                    <div class="flex w-3/5 items-center w-3/5">
                        <p class="p-2">Sản phẩm</p>
                    </div>
                    <div class="flex justify-between items-center flex-1">
                        <div class="p-2">Đơn giá</div>
                        <div class="p-2">Số lượng</div>
                        <div class="p-2">Số tiền</div>
                        <div class="p-2">Thao tác</div>
                    </div>
                </div>

                
                @foreach ($items as $item)
                <x-cart-item :item="$item" />
                    @php
                        $total += $item->price * $item->qty;
                        $QtyOfItemInCart ++;
                    @endphp
                @endforeach

                <input type="hidden" id="qtyOfItemInCart" value="{{ $QtyOfItemInCart }}">
            </div>

            <div class="flex py-3 px-5 justify-between w-2/5 ml-auto mt-8">
                <div class="uppercase text-blue-900 text-lg">Tổng cộng:</div>
                <div id="total">{{$total}}đ</div>
            </div>
            <div id="BookingBtn">
                <button id="BookingBtn" class="block m-auto w-3/5 py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">
                    Đặt hàng
                </button>
            </div>
            
        </form>
    </div>

    <script>
        //khi không có sản phẩm trong giỏ hàng thì tắt nút "Đặt hàng"
        var getQtyOfItemInCart = document.getElementById('qtyOfItemInCart').value
        var hiddenBookingBtn = document.getElementById('BookingBtn')
        if (getQtyOfItemInCart == 0)
            hiddenBookingBtn.innerHTML = 
            `
            <h1 class="block m-auto w-3/5 py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">
                Giỏ hàng Rỗng
            </h1>
            `

        function changeQty(itemId)
        {
            // giá trị thẻ input number vừa thay đổi
            var curQty = document.getElementById(`item_${itemId}`).value

            // thay đổi tổng giá trị của sản phẩm và gán lại giá trị cho thẻ input lưu giá trị đó
            var product_tatal_price = document.getElementById(`product_tatal_price_${itemId}`)
            var item_price = document.getElementById(`price_${itemId}`).value
            var price_after_change = curQty * item_price

            product_tatal_price.innerHTML= `${price_after_change}`
            document.getElementById(`tmp_product_tatal_price_${itemId}`).value = price_after_change

            //thay đổi giá trị của mục "Tổng tiền"
            var list_items = document.getElementsByName('product_tatal_price')
            var result = 0
            for (var i=0;i<list_items.length; i++)
                result += Number(list_items[i].value) 
            
            document.getElementById('total').innerHTML=`${result} đ`
        }
    </script>
</x-layout>
