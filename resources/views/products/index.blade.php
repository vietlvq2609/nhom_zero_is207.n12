<x-layout>
    <x-breadcrumb text="Shop" />

    <!-- shop wrapper -->
    <div class="container grid grid-cols-4 gap-6 pt-4 pb-16 items-start">
        <!-- sidebar -->
        <x-sidebar />
        <!-- ./sidebar -->

        <!-- products -->
        <div class="col-span-3">
            <div class="flex justify-end items-center mb-4">
                <select name="sort" id="sort"
                    class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                    <option value="latest">Mới nhất</option>
                    <option value="price-low-to-high">Giá thấp đến cao</option>
                    <option value="price-high-to-low">Giá cao đến thấp</option>
                </select>
            </div>

            <!-- hiện danh sách các product -->
            @unless(count($products) == 0)
                <div class="grid grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" :product_price="$product_price" />
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $products->links() }}
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
    </div>
    <!-- ./shop wrapper -->
</x-layout>
