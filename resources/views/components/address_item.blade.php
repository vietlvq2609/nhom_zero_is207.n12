@props(['address'])

<div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800">
    <div class="flex w-3/5 items-center w-3/5">

        <div name="product_tatal_price" class="font-semibold">{{ $address->country_name}}</div>
        <p class="p-2">{{ $address->id}}</p>
        <p class="p-1 text-red-600 text-lg">{{ $address->region}}</p>

    </div>
    <div class="flex justify-between items-center flex-1">
        <div class="font-semibold">{{ $address->city}}</div>
        
        <div name="product_tatal_price" class="font-semibold">{{ $address->country_name}}</div>
        <form action="{{ route('user.deleteAddress') }}" method="POST">
        @csrf 
            <input name="address_id" type="hidden" value="{{ $address->id }}">
            <button class="ml-6 text-red-500 text-lg underline rounded p-1 hover:scale-105">Xoá</button>
        </form>
        <form action="" method="POST">
            <button class="ml-6 text-red-500 text-lg underline rounded p-1 hover:scale-105">Mặc định</button>
        </form>
    </div>
</div>