<form wire:submit.prevent="search" class="w-full max-w-xl relative flex">
    <span class="absolute left-4 top-3 text-lg text-gray-400">
        <i class="fa-solid fa-magnifying-glass"></i>
    </span>
    <input type="text" name="search" id="search"
        wire:model="search"
        class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none" autocomplete="off"
        placeholder="Tìm kiếm sản phẩm">
    <button
        class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</form>
