@props(['product'])
@props(['product_price'])

<div class="bg-white shadow border rounded overflow-hidden group flex flex-col">
    <div class="relative h-[130px] overflow-hidden">
        <img src="{{ $product->product_image }}" alt="product 1" class="w-full">
        <a href="/products/{{ $product->id }}"
            class="text-white text-lg w-9 h-8 rounded-full flex items-center justify-center transition"
            title="view product">
            <div
                class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                        justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </a>
    </div>
    <div class="flex flex-col pt-4 pb-3 px-4 flex-1">
        <a href="/products/{{ $product->id }}" class="flex-1">
            <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                {{ $product->name }}
            </h4>
        </a>
        <div class="flex items-baseline mb-1 space-x-2">
            <?php
                $min_price= 0;
                $max_price= 0;
                foreach ($product_price as $price)
                {
                    if($product->id == $price->id) {
                        $min_price= $price->value;
                        $max_price = $price->value;
                    }
                }
                foreach ($product_price as $price)
                {
                    if($product->id == $price->id and $price->value < $min_price) {
                        $min_price= $price->value;
                    }
                    if($product->id == $price->id and $price->value > $max_price) {
                        $max_price = $price->value;
                    }
                }
            ?>
            <p class="text-xl text-primary font-semibold">{{ $min_price }}</p>
            <p class="text-xl text-primary font-semibold"> đến</p>
            <p class="text-xl text-primary font-semibold">{{ $max_price }}</p>
            <p class="text-sm text-gray-400 line-through">$45</p>
        </div>
        <div class="flex items-center">
            <div class="flex gap-1 text-sm text-yellow-400">
                <span><i class="fa-solid fa-star"></i></span>
                <span><i class="fa-solid fa-star"></i></span>
                <span><i class="fa-solid fa-star"></i></span>
                <span><i class="fa-solid fa-star"></i></span>
                <span><i class="fa-solid fa-star"></i></span>
            </div>
            <div class="text-xs text-gray-500 ml-3">(150)</div>
        </div>
    </div>
    <a href="/products/{{ $product->id }}"
        class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">Xem sản phẩm</a>
</div>
