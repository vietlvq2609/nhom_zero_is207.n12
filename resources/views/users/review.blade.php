<x-layout>
<div class="container w-3/5">
        <h1 id="Gio_Hang" class="text-primary text-2xl font-semibold py-4">Các sản phẩm đã đánh giá</h1>
            <div class="divide-y-4 divide-white">
                @foreach ($reviews as $review)
                <div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800 mt-6">
                    <div class="flex-column ml-3">
                        <div class="flex mb-6">
                            <a href="/products/{{ $review->product_id }}" class="flex w-full items-center">
                                <img src="{{ $review->product_image }}" class="w-20 h-20 object-contain">
                                <div class="flex-column ml-6">
                                    <div class="flex ">
                                        <p class="p-2">{{ $review->product_name }}</p>
                                        <p class="p-1 text-red-600 text-lg">{{ $review->variation_value }}</p>
                                    </div>
                                    <div class="font-semibold p-2">{{ $review->price }}đ</div>
                                </div>
                            </a>
                        </div>
                        <div class="text-gray-600 flex">
                            <p class="text-gray-600">
                                Đánh giá:
                            </p>
                            <div class="flex gap-1 text-sm text-yellow-400 ml-6">
                                @for ($i = 0 ; $i < $review->rate; $i ++)
                                    <span><i class="fa-solid fa-star"></i></span>
                                @endfor
                            </div>
                        </div>
                        <div class="text-gray-600 flex mb-6">
                            <p class="text-gray-600 mr-2 ">
                                Bình luận: {{$review->comment}}
                            </p>
                        </div>
                        <div>
                            <a href="/review/{{ $review->ordered_product_id }}" class="font-semibold text-red-500 underline rounded hover:scale-105 ">Sửa</a>
                            <a href="/review/delete/{{ $review->review_id }}" class="font-semibold text-red-500 underline rounded hover:scale-105 ml-6"
                            onclick="
                                    if(!confirm('Xác nhận xóa đánh giá!')) 
                                        event.preventDefault()">Xóa</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
</x-layout>