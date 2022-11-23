@props(['item'])

<div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800">
    <div class="flex w-3/5 items-center w-3/5">
        <img src="{{ $item->product_image }}" class="w-16 h-16 object-contain">
        <p class="p-2">{{ $item->product_name }}</p>
        <p class="p-1 text-red-600 text-lg">{{ $item->variation_value }}</p>

    </div>
    <div class="flex justify-between items-center flex-1">
        <div class="font-semibold">{{ $item->price }}đ</div>
        <input type="number" name="qty" value="{{ $item->qty }}" class="w-10 py-0 px-1" min="1" onchange="myFuntion()">
        <div name="product_tatal_price" class="font-semibold">{{ $item->price * $item->qty}}đ</div>
        <form action="/cart/delete/{{$item->id}}" method="POST">
            <button class="ml-6 text-red-500 text-lg underline rounded p-1 hover:scale-105">Xoá</button>
        </form>
    </div>
</div>
<script>
    
    var price = document.getElementsByName('product_tatal_price')[{{ $item->id }}]
    var value, result
    function myFuntion()
    {
        console.log({{ $item->id }} , price)
        value = document.getElementsByName('qty')[0].value
        result = {{ $item->price }} * value
        // price.innerHTML= `${result}đ`
    }
</script>