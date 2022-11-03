@props(['cart-item'])

<div class="flex bg-amber-100 items-center py-3 px-5 w-full rounded text-sm text-gray-800">
    <div class="flex w-3/5 items-center w-3/5">
        <input class="rounded mr-4 text-amber-500 p-2 cursor-pointer" type="checkbox" name="item">
        <img src="https://cf.shopee.vn/file/22d34f0e7067aeda684906c43c58a345_tn" class="w-14 h-14">
        <p class="p-2  ">Dây Đàn Classic Addrioas chính hãng siêu víp cấp vũ trụ</p>
    </div>
    <div class="flex justify-between items-center flex-1">
        <div class="">
            <input type="number" name="" class="w-10 py-0 px-1" min="1">
            <button class="ml-6 text-red-500 underline rounded p-1 hover:scale-105">Xoá</button>
        </div>
        <div class="text-right font-semibold">100.000đ</div>
    </div>
</div>
