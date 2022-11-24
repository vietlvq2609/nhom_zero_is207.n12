@props(['address'])

<div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800 mb-4">
    <input type="hidden" value="{{ $address->id }}">
    <div class="flex w-3/5 items-center w-3/5">

        <!-- nút mặc định, địa chỉ nào đang là mặc định sẽ được check -->
        @if ($address->is_default)
            <div class="size-selector relative mr-4">
                <input type="radio" id="defaultAddress_{{ $address->id }}" name="defaultAddress" class="checked:hidden absolute bg-transparent border-none w-full h-full cursor-pointer" checked
                    value="{{ $address->id }}"
                    onclick="checkDefault({{ $address->id }})">
                <label for="defaultAddress" class="px-2 text-sm border border-gray-200 rounded-sm h-6 flex items-center justify-center shadow-sm text-gray-600">
                    Mặc định
                </label>
            </div>
        @else
            <div class="size-selector relative mr-4">
                <input type="radio" id="defaultAddress_{{ $address->id }}" name="defaultAddress" class="checked:hidden absolute bg-transparent border-none w-full h-full cursor-pointer"
                    value="{{ $address->id }}"    
                    onclick="checkDefault({{ $address->id }})">
                <label for="defaultAddress" class="px-2 text-sm border border-gray-200 rounded-sm h-6 flex items-center justify-center shadow-sm text-gray-600">
                    Mặc định
                </label>
            </div>
        @endif

        <!-- các trường thông tin của địa chỉ -->

        <div name="product_tatal_price" class="font-semibold">{{ $address->country_name}}</div>

        

        <p class="p-1 text-red-600 text-lg">{{ $address->region}}</p>
    </div>

    <div class="flex justify-between items-center flex-1">
        <div class="font-semibold">{{ $address->city}}</div>
        <div name="product_tatal_price" class="font-semibold">{{ $address->country_name}}</div>

        <!-- nút xóa -->
        
        <div class="size-selector relative">
            <input type="checkbox" id="delete_{{ $address->id }}" name="delete[]" class="absolute bg-transparent border-none w-full h-full cursor-pointer"
                value="{{ $address->id }}" 
                onclick="checkDelete({{ $address->id }})">
            <label for="delete_{{ $address->id }}" class="px-2 text-sm border border-gray-200 rounded-sm h-6 flex items-center justify-center shadow-sm text-gray-600">
                Xóa
            </label>
        </div>
    </div>
</div>