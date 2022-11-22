@props(['item'])

<div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800">
    <div class="flex w-3/5 items-center w-3/5">
        {{-- <input class="rounded mr-4 text-amber-500 p-2 cursor-pointer" type="checkbox" name="item"> --}}
        <img src="{{ $item->product_image }}" class="w-16 h-16 object-contain">
        <p class="p-2">{{ $item->product_name }}</p>
        <p class="p-1 text-red-600 text-lg">{{ $item->variation_value }}</p>

    </div>
    <div class="flex justify-between items-center flex-1">
        <div class="flex">
            <input type="number" name="qty" value="{{ $item->qty }}" class="w-10 py-0 px-1" min="1">
            <form action="/cart/delete/{{$item->id}}" method="POST">
                <button class="ml-6 text-red-500 text-lg underline rounded p-1 hover:scale-105">Xoá</button>
            </form>
        </div>
        <div class="text-right font-semibold">{{ $item->price }}đ</div>
    </div>
</div>
