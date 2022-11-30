<x-layout>
<div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1">Đánh giá sản phẩm</h2>
            <form action="{{ route('cart.postReview') }}" method="POST" autocomplete="off">
                @csrf
                <div class="space-y-2 mt-6">
                <input type="hidden" name="ordered_product_id" value="{{ $ordered_product_id }}">
                <input type="hidden" name="product_id" value="{{ $item->product_id }}">

                    <!-- thông tin sản phẩm -->

                    <div class="flex">
                        <a href="/products/{{ $item->product_id }}" class="flex w-full items-center justify-between">
                            <img src="{{ $item->product_image }}" class="w-16 h-16 object-contain">
                            <p class="p-2">{{ $item->product_name }}</p>
                            <p class="p-1 text-red-600 text-lg">{{ $item->variation_value }}</p>
                            <div class="font-semibold p-2">{{ $item->price }}đ</div>
                        </a>
                    </div>

                    <!-- Rate -->

                    <div>
                        <label for="rating_value" class="text-gray-600 mb-2 ">Điểm đánh giá</label>
                        <input type="number" step="1" min="1" max="5" name="rating_value" class="ml-6 border border-gray-300 px-4 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                    </div>
                    @error('rating_value')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <!-- Bình luận -->

                    <div>
                        <label for="comment" class="text-gray-600 mb-2 block">Bình luận</label>
                        <textarea rows="4" cols="50" name="comment" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"></textarea>
                    </div>

                </div>
                <div class="mt-4">
                    <button type="submit" class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>