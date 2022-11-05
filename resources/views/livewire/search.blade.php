<form wire:submit.prevent="filter" class="space-y-2">
    @foreach ($categories as $category)
        <div class="flex items-center">
            <input type="checkbox" wire:model="search" value="{{$category->id}}" id="cat-1"
                class="text-primary focus:ring-0 rounded-sm cursor-pointer">
            <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">{{ $category->category_name }}</label>
            <div class="ml-auto text-gray-600 text-sm">**</div>
        </div>
    @endforeach
    <button type="submit">Lọc</button>
</form>
