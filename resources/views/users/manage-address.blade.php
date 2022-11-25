<x-layout>
    <div class="container w-3/5">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-primary text-2xl font-semibold py-4 ">Địa chỉ</h1>
            <a href="{{ route('user.new-address') }}" class="text-red-500 text-lg font-semibold">Thêm địa chỉ mới</a>
        </div>
        <h2 class="text-primary text-2xl font-semibold py-4 ">Địa chỉ mặc định:</h2>

         <!-- địa chỉ mặc định được hiển thị trong phần "Địa chỉ mặc định": -->
        
        @foreach ($addresses as $address)
            @if ($address->is_default)
                <div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800 mb-4 justify-between">
                    <div class="flex-column w-full">
                        <div class="flex justify-between">
                            <div class="font-semibold">{{ $address->unit_number}}</div>
                            <div class="font-semibold">{{ $address->street_number}}</div>
                            <div class="font-semibold">{{ $address->address_line1}}</div>
                            <div class="font-semibold">{{ $address->address_line2}}</div>
                            <div class="font-semibold">{{ $address->city}}</div>
                            <div class="font-semibold">{{ $address->country_name}}</div>
                        </div>
                        <br>
                        <div class="font-semibold">{{ $address->region}}</div>
                    </div>
                </div>
            @endif
        @endforeach

        <h2 class="text-primary text-2xl font-semibold py-4 ">Danh sách các địa chỉ:</h2>
        <div class="divide-y-4 divide-white">
            <form for="{{route('user.updateAddress')}}" method="POST">
            @csrf 
                @foreach ($addresses as $address)
                    <x-address_item :address="$address"/>
                @endforeach
                <button class="block m-auto w-3/5 py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">
                   Lưu
                </button>
            </form>
        </div>
    </div>

    <script>
        //khi địa chỉ đang chọn là địa chỉ mặc định thì không thể chọn xóa
        function checkDelete(id)
        {
            if(document.getElementById(`defaultAddress_${id}`).checked)
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
    </script>
</x-layout>