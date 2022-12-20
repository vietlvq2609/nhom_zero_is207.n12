<x-layout>
    <x-breadcrumb text="Shop" />

    <!-- shop wrapper -->
    <div class="lg:container md:w-screen sm:container sm:px-1 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 lg:gap-6 md:gap-2 sm:gap-6 pt-4 pb-16 items-start m-auto">
        <!-- sidebar -->
        <x-sidebar />
        <!-- ./sidebar -->

        <!-- products -->
        <div class="lg:col-span-3 md:col-span-2 sm:col-span-1">
            {{-- <div class="flex justify-end items-center mb-4">
                <select name="sort" id="sort"
                    class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                    <option value="latest">Mới nhất</option>
                    <option value="price-low-to-high">Giá thấp đến cao</option>
                    <option value="price-high-to-low">Giá cao đến thấp</option>
                </select>
            </div> --}}

            <!-- hiện danh sách các product -->
            @unless(count($products) == 0)
                <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 lg:gap-6 md:gap-2">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" :product_price="$product_price" />
                    @endforeach
                </div> 
            @else
            <!-- báo lỗi khi không tìm thấy sản phẩm nào -->
                <div class="flex justify-center items-center flex-col">
                    <img src="https://taphoa.cz/static/media/cart-empty-img.8b677cb3.png">
                    <p>Không tìm thấy sản phẩm</p>
                </div>
            @endunless
        </div>
        <!-- ./products -->
        <div class="mt-8 w-screen items-center">
            {{ $products->links() }}
        </div>
    </div>
    <!-- ./shop wrapper -->
</x-layout>
