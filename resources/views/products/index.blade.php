<x-layout :categories="$categories">
    <x-breadcrumb text="Shop" />

    <!-- shop wrapper -->
    <div class="container grid grid-cols-4 gap-6 pt-4 pb-16 items-start">
        <!-- sidebar -->
        <div class="col-span-1 bg-white px-4 pb-6 shadow rounded overflow-hidden">
            <div class="divide-y divide-gray-200 space-y-5">
                <div>
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Danh mục</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                        <div class="flex items-center">
                            <input type="checkbox" name="cat-1" id="cat-1" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">{{$category->category_name}}</label>
                            <div class="ml-auto text-gray-600 text-sm">**</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Mức giá</h3>
                    <div class="mt-4 flex items-center">
                        <input type="text" name="min" id="min" class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm" placeholder="min">
                        <span class="mx-3 text-gray-500">-</span>
                        <input type="text" name="max" id="max" class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm" placeholder="max">
                    </div>
                </div>

                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">size</h3>
                    <div class="flex items-center gap-2">
                        <div class="size-selector">
                            <input type="radio" name="size" id="size-xs" class="hidden">
                            <label for="size-xs" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XS</label>
                        </div>
                        <div class="size-selector">
                            <input type="radio" name="size" id="size-sm" class="hidden">
                            <label for="size-sm" class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">S</label>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Color</h3>
                    <div class="flex items-center gap-2">
                        <div class="color-selector">
                            <input type="radio" name="color" id="red" class="hidden">
                            <label for="red" class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block" style="background-color: #fc3d57;"></label>
                        </div>
                        <div class="color-selector">
                            <input type="radio" name="color" id="black" class="hidden">
                            <label for="black" class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block" style="background-color: #000;"></label>
                        </div>
                        <div class="color-selector">
                            <input type="radio" name="color" id="white" class="hidden">
                            <label for="white" class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block" style="background-color: #fff;"></label>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- ./sidebar -->

        <!-- products -->
        <div class="col-span-3">
            <div class="flex items-center mb-4">
                <select name="sort" id="sort" class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                    <option value="latest">Mới nhất</option>
                    <option value="price-low-to-high">Giá thấp đến cao</option>
                    <option value="price-high-to-low">Giá cao đến thấp</option>
                </select>

                <div class="flex gap-2 ml-auto">
                    <div class="border border-primary w-10 h-9 flex items-center justify-center text-white bg-primary rounded cursor-pointer">
                        <i class="fa-solid fa-grip-vertical"></i>
                    </div>
                    <div class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>
            </div>

            @unless(count($products) == 0)
            <div class="grid grid-cols-3 gap-6">
                @foreach($products as $product)
                <x-product-card :product="$product" />
                @endforeach
            </div>
            @else
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