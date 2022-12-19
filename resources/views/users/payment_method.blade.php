<x-layout>
    @php
    $QtyInPaymentMethodList = 0            
    @endphp
    <div class="container lg:w-3/5 md:w-10\/12 sm:w-10\/12">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-primary text-2xl font-semibold py-4 ">Phương thức thanh toán</h1>
            <a href="{{ route('user.addPaymentMethodView') }}" class="text-red-500 text-lg font-semibold">Thêm</a>
        </div>
        <h2 class="text-primary text-2xl font-semibold py-4 ">Phương thức thanh toán mặc định:</h2>

         <!-- địa chỉ mặc định được hiển thị trong phần "Địa chỉ mặc định": -->
        
        @foreach ($payments as $payment)
            @if ($payment->is_default)
                <div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800 mb-4 justify-between">
                    <div class="flex-column w-full">
                        <div class="flex justify-between">
                            <div class="font-semibold">{{ $payment->value }}</div>
                            <div class="font-semibold">{{ $payment->provider}}</div>
                            <div class="font-semibold">{{ $payment->account_number}}</div>
                            <!-- <div class="font-semibold">{{ $payment->expiry_date}}</div> -->
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <h2 class="text-primary text-2xl font-semibold py-4 ">Danh sách các phương thức thanh toán:</h2>
        <div class="divide-y-4 divide-white">
            <form for="{{route('user.paymentMethod')}}" method="POST">
            @csrf 
                @foreach ($payments as $payment)
                    <x-payment_method_item :payment="$payment"/>
                    @php
                        $QtyInPaymentMethodList ++
                    @endphp
                @endforeach
                
                <input type="hidden" id="qtyOfItemInPaymentMethodList" value="{{ $QtyInPaymentMethodList }}">

                <div id="savePaymentMethodBtn">
                    <button class="block m-auto w-3/5 py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    <script>
        //khi payment đang chọn là địa chỉ mặc định thì không thể chọn xóa
        function checkDelete(id)
        {
            if(document.getElementById(`defaultPayment_${id}`).checked)
            {
                document.getElementById(`delete_${id}`).checked = false
                document.getElementById(`delete_${id}`).disable = true
            }
        }

        //khi địa chỉ được chọn là mặc định nó sẽ bỏ check nút xóa của nó
        function checkDefault(id)
        {
            if(document.getElementById(`delete_${id}`).checked)
                document.getElementById(`delete_${id}`).checked = false
        }

        // Ẩn nút lưu nếu danh sách rỗng

        var getQtyOfItemInPaymentMethodList = document.getElementById('qtyOfItemInPaymentMethodList').value
        var hiddenSavePaymentMethodBtn = document.getElementById('savePaymentMethodBtn')
        if (getQtyOfItemInPaymentMethodList == 0)
        {
            hiddenSavePaymentMethodBtn.innerHTML = 
                `
                <h1 class="block m-auto w-3/5 py-16 text-center uppercase font-roboto font-medium text-red-600 text-lg">
                    Dánh sách rỗng
                </h1>
                `
        }
    </script>
</x-layout>