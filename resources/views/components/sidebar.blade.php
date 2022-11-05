@props(['categories'])

<div class="col-span-1 bg-white px-4 pb-6 shadow rounded overflow-hidden">
    <div class="divide-y divide-gray-200 space-y-5">
        <div>
            <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Danh mục</h3>
            <livewire:search />
        </div>

        <div class="pt-4">
            <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Mức giá</h3>
            <div class="mt-4 flex items-center">
                <input type="text" name="min" id="min"
                    class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                    placeholder="min">
                <span class="mx-3 text-gray-500">-</span>
                <input type="text" name="max" id="max"
                    class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                    placeholder="max">
            </div>
        </div>

        <div class="pt-4">
            <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">size</h3>
            <div class="flex items-center gap-2">
                <div class="size-selector">
                    <input type="radio" name="size" id="size-xs" class="hidden">
                    <label for="size-xs"
                        class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XS</label>
                </div>
                <div class="size-selector">
                    <input type="radio" name="size" id="size-sm" class="hidden">
                    <label for="size-sm"
                        class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">S</label>
                </div>
            </div>
        </div>
    </div>
</div>

