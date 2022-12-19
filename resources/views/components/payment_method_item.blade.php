@props(['payment'])

<div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800 mb-4">
    <input type="hidden" value="{{ $payment->id }}">
    <div class="flex w-full items-center justify-between">

        <!-- nút mặc định, địa chỉ nào đang là mặc định sẽ được check -->
        @if ($payment->is_default)
            <div class="size-selector relative mr-4">
                <input type="radio" id="defaultPayment_{{ $payment->id }}" name="defaultPayment" class="checked:hidden absolute bg-transparent border-none w-full h-full cursor-pointer" checked
                    value="{{ $payment->id }}"
                    onclick="checkDefault({{ $payment->id }})">
                <label for="defaultPayment" class="px-2 text-sm border border-gray-200 rounded-sm h-6 flex items-center justify-center shadow-sm text-gray-600">
                    Mặc định
                </label>
            </div>
        @else
            <div class="size-selector relative mr-4">
                <input type="radio" id="defaultPayment_{{ $payment->id }}" name="defaultPayment" class="checked:hidden absolute bg-transparent border-none w-full h-full cursor-pointer"
                    value="{{ $payment->id }}"    
                    onclick="checkDefault({{ $payment->id }})">
                <label for="defaultPayment" class="px-2 text-sm border border-gray-200 rounded-sm h-6 flex items-center justify-center shadow-sm text-gray-600">
                    Mặc định
                </label>
            </div>
        @endif

        <!-- các trường thông tin của địa chỉ -->
        <div class="max-w-md max-w-sm">
            <div class="flex justify-between flex-2">
                <div class="font-semibold">{{ $payment->value }}</div>
                <div class="font-semibold">{{ $payment->provider}}</div>
                <div class="font-semibold">{{ $payment->account_number}}</div>
                <!-- <div class="font-semibold">{{ $payment->expiry_date}}</div> -->
            </div>
        </div>
        <!-- nút xóa -->
        
        <div class="size-selector relative">
            <input type="checkbox" id="delete_{{ $payment->id }}" name="delete[]" class="absolute bg-transparent border-none w-full h-full cursor-pointer"
            value="{{ $payment->id }}" 
            onclick="checkDelete({{ $payment->id }})">
            <label for="delete_{{ $payment->id }}" class="px-2 text-sm border border-gray-200 rounded-sm h-6 flex items-center justify-center shadow-sm text-gray-600">
                Xóa
            </label>
        </div>
    </div>
</div>
