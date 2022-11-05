<div
    class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
    @foreach ($categories as $category)
        <a href="/products?category={{ $category->id }}" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
            <span class="ml-6 text-gray-600 text-sm">{{ $category->category_name }}</span>
        </a>
    @endforeach
</div>
