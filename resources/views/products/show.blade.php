<x-layout>
    <!-- breadcrumb -->
    <div class="container py-4 flex items-center gap-3">
        <a href="/" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">{{ $product_name }}</p>
    </div>
    <!-- ./breadcrumb -->

    <!-- product-detail -->
    <div class="container grid grid-cols-2 gap-6">
        <div>
            <img src="{{ $product_image }}" alt="product" class="w-full">
            <div class="grid grid-cols-5 gap-4 mt-4">
                <img src="{{ $product_image }}" alt="product2" class="w-full cursor-pointer border border-primary">
            </div>
        </div>

        <form method="POST" action="/cart">
            @csrf
            <div>
                <h2 class="text-3xl font-medium uppercase mb-2">{{ $product_name }}</h2>
                <div class="flex items-center mb-4">
                    <div class="flex gap-1 text-sm text-yellow-400">
                        @for ($i = 0 ; $i < $product_rate; $i ++)
                           <span><i class="fa-solid fa-star"></i></span>
                        @endfor
                    </div>
                    <div class="text-xs text-gray-500 ml-3">({{$review_count}} Reviews)</div>
                </div>
                <div class="space-y-2">
                    <p class="text-gray-800 font-semibold space-x-2">
                        <span>Số lượng sản phẩm: </span>
                        <span name="item_qty" class="text-green-600">{{ $product_options->first()->qty }}</span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Phân loại: </span>
                        <span class="text-gray-600">{{ $product_category }}</span>
                    </p>
                </div>
                <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
                    <!-- <p name="new_price" class="text-xl text-primary font-semibold">90.000 đ</p> -->
                    <p name="new_price" class="text-xl text-primary font-semibold">{{ $product_options->first()->price }} đ</p>
                    <p name="price" class="text-base text-gray-400 line-through">100.000 đ</p>
                </div>

                <p class="mt-4 text-gray-600">{{ $product_description }}</p>

                <div class="pt-4">
                    <h3 class="text-sm text-gray-800 uppercase mb-1 font-bold">Size</h3>
                    <div class="flex items-center gap-2">
                        @foreach ($product_options as $option)
                            <div class="size-selector relative">
                                <input type="radio" name="product_item_id" class="checked:hidden absolute bg-transparent border-none w-full h-full cursor-pointer"  
                                    value="{{ $option->id }}" 
                                    onclick="
                                            document.getElementsByName('new_price')[0].innerHTML= `{{ $option->price }} đ`;
                                            document.getElementsByName('item_qty')[0].innerHTML= `{{ $option->qty }}`
                                    ">
                                <label
                                    class="px-2 text-sm border border-gray-200 rounded-sm h-6 flex items-center justify-center shadow-sm text-gray-600">{{ $option->value }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="mt-4">
                    <h3 class="text-sm text-gray-800 uppercase mb-1 font-bold">Số lượng</h3>
                    <livewire:counter />
                </div>

                <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
                    <button type="submit"
                        class="block w-72 py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">
                        <i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- ./product-detail -->

    <!-- description -->
    <div class="container pb-16">
        <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">Chi tiết sản phẩm</h3>
        <div class="w-full pt-6">
            <div class="text-gray-600">
                {{ $product_description }}
            </div>
        </div>
    </div>
    <!-- ./description -->

    <!-- Comment -->
    <div class="container pb-16">
        <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">Đánh giá</h3>
        <div class="flex-column w-full pt-6">
            @if($review_count == 0)
            <div class="text-gray-600">
                Chưa có đánh giá nào
            </div>
            @else
                @foreach ($reviews as $review)
                <div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800 mt-6">
                    <div class="flex-shrink-0">
                        @if(!file_exists(public_path().'/storage/avatar/'.$review->avatar) )
                        <img src="{{ asset('/assets/images/Avatar.jpg') }}" alt="avatar" class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
                        @else
                        <img src="{{asset('/storage/avatar/'.$review->avatar)}}" alt="avatar" class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
                        @endif
                    </div>
                    <div class="flex-column ml-3">
                        <div class="text-gray-600 flex">
                            {{$review->user_name}} 
                            <p class="text-gray-600 ml-6">
                                Đánh giá:
                            </p>
                            <div class="flex gap-1 text-sm text-yellow-400 ml-6">
                                @for ($i = 0 ; $i < $review->rate; $i ++)
                                    <span><i class="fa-solid fa-star"></i></span>
                                @endfor
                            </div>
                        </div>
                        <div class="text-gray-600 flex">
                            <p class="text-gray-600 mr-2">
                                Bình luận: {{$review->comment}}
                            </p>
                        </div>
                        <div class="text-gray-600 flex">
                            <p class="text-gray-600 mr-2">
                                Thời gian: {{ $review->day }} - {{$review->month }} - {{$review->year}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <div class="mt-8 w-screen items-center">
            {{ $reviews->links() }}
        </div>
    </div>
    <!-- ./Comment -->


    <script>
        // làm cho lựa chọn đầu tiên ở mục SIZE luôn được check
        var CheckfirstInput = document.getElementsByName('product_item_id')[0]
        CheckfirstInput.toggleAttribute('checked')
    </script>
</x-layout>
