<form wire:submit.prevent="filter" class="divide-y divide-gray-200 space-y-5">
    <div>
        <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Danh mục</h3>
        <div class="space-y-2">
            @foreach ($categories as $category)
                <div class="flex items-center">
                    <input type="checkbox" wire:model="search_category" value="{{ $category->id }}" id="cat-1"
                        class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                    <label for="cat-1"
                        class="text-gray-600 ml-3 cusror-pointer">{{ $category->category_name }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pt-4">
        <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Mức giá</h3>
        <div class="mt-4 flex items-center">
            <input type="text" wire:model="min_price" name="min" id="min"
                class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                placeholder="0">
            <span class="mx-3 text-gray-500">-</span>
            <input type="text" wire:model="max_price" name="max" id="max"
                class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                placeholder="max">
        </div>
    </div>

    <button type="submit" class="text-center bg-amber-500 text-white hover:brightness-90 rounded w-1/2 p-2">Lọc</button>
</form>
