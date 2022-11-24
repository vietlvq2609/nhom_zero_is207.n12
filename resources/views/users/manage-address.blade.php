<x-layout>
    <div class="container w-3/5">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-primary text-2xl font-semibold py-4 ">Địa chỉ</h1>
            <a href="{{route('user.new-address')}}" class="text-red-500 text-lg font-semibold">Thêm địa chỉ mới</a>
        </div>

        @php
            $default = DB::table('user_addresses')
                ->where('users.id', auth()->id())
                ->where('is_default', true)
                ->join('addresses','user_addresses.address_id','=','addresses.id')
                ->join('users','user_addresses.user_id','=','users.id')
                ->select('addresses.id as id')
                ->get();
        @endphp

        <div class="divide-y-4 divide-white">
            @foreach ($addresses as $address)
                <x-address_item :address="$address" :default="$default"/>
            @endforeach
        </div>
    </div>
</x-layout>