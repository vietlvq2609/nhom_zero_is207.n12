<div class="flex items-center space-x-1">
    <div class="cursor-pointer bg-amber-500 w-7 h-7 flex justify-center items-center rounded-xl hover:brightness-90" wire:click="decrement">
        <i class="fa-solid fa-minus text-white text-sm "></i>
    </div>
    <input class="w-9 text-center h-9" type="text" name="qty" value="{{ $count }}">
    <div class="cursor-pointer bg-amber-500 w-7 h-7 flex justify-center items-center rounded-xl hover:brightness-90" wire:click="increment">
        <i class="fa-solid fa-plus text-white text-sm"></i>
    </div>
</div>
