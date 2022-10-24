  @props(['categories']);
  <!-- categories -->
  <div class="container py-16">
      <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Danh mục sản phẩm</h2>
      <div class="grid grid-cols-3 gap-3">
          @foreach($categories as $category)
          @unless($category->id == 1)
          <div class="relative rounded-sm overflow-hidden group h-40">
              <img src="{{$category->category_image}}" alt="{{ $category->category_name }}" class="w-full">
              <a href="/products?category={{$category->id}}" class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">{{ $category->category_name }}</a>
          </div>
          @endunless
          @endforeach
      </div>
  </div>
  <!-- ./categories -->