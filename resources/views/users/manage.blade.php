<x-layout>

    <!-- account wrapper -->
    <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">

        <!-- sidebar -->
        <div class="col-span-3">
            <div class="px-4 py-3 shadow flex items-center gap-4">
                <div class="flex-shrink-0">
                    @if(!file_exists(public_path().'/storage/avatar/'.Auth::user()->avatar) )
                    <img src="{{ asset('/assets/images/Avatar.jpg') }}" alt="avatar" class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
                    @else
                    <img src="{{asset('/storage/avatar/'.Auth::user()->avatar)}}" alt="avatar" class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
                    @endif
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600">Hello,</p>
                    <!-- <h4 class="text-gray-800 font-medium">John Doe</h4> -->
                    <h4 class="text-gray-800 font-medium">{{ auth()->user()->name }}</h4>
                </div>
            </div>

            <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
                <div class="space-y-1 pl-8">
                    <a href="#" class="relative text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-address-card"></i>
                        </span>
                        Manage account
                    </a>
                    <a href="{{ route('user.changeInfo') }}" class="relative hover:text-primary block capitalize transition">
                        Profile information
                    </a>
                    <a href="{{ route('user.address') }}" class="relative hover:text-primary block capitalize transition">
                        Manage addresses
                    </a>
                    <a href="{{ route('user.changePassword') }}" class="relative hover:text-primary block capitalize transition">
                        Change password
                    </a>
                </div>

                <div class="space-y-1 pl-8 pt-4">
                    <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-solid fa-box-archive"></i>
                        </span>
                        My order history
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        My returns
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        My Cancellations
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        My reviews
                    </a>
                </div>


                <form method="POST" action="/logout" class="space-y-1 pl-8 pt-4">
                    @csrf
                    <button class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-arrow-right-from-bracket"></i>
                        </span>
                        Đăng xuất
                    </button>
                </form>

            </div>
        </div>
        <!-- ./sidebar -->

        <!-- info -->
        <div class="col-span-9 grid grid-cols-3 gap-4">

            <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-medium text-gray-800 text-lg">Personal Profile</h3>
                    <a href="#" class="text-primary">Edit</a>
                </div>
                <div class="space-y-1">
                    <h4 class="text-gray-700 font-medium">{{ auth()->user()->name }}</h4>
                    <p class="text-gray-800">{{ auth()->user()->email_address }}</p>
                    <p class="text-gray-800">{{ auth()->user()->phone_number }}</p>
                </div>
            </div>

            <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-medium text-gray-800 text-lg">Shipping address</h3>
                    <a href="{{ route('user.address') }}" class="text-primary">Edit</a>
                </div>
                <div class="space-y-1">
                    <h4 class="text-gray-700 font-medium">{{ auth()->user()->name }}</h4>

                    <!-- in ra địa chỉ mặc định (địa chỉ nhận hàng) -->
                    @if($shipping == null)
                        <p class="text-gray-800">Bạn chưa thêm địa chỉ mặc định</p>
                    @else
                        <p class="text-gray-800">{{$shipping[0]->unit}}, {{$shipping[0]->street}}, {{$shipping[0]->address1}}, {{$shipping[0]->address2}}, {{$shipping[0]->city}}, {{$shipping[0]->country_name}}.</p>
                    @endif

                    <p class="text-gray-800">{{ auth()->user()->phone_number }}</p>
                </div>
            </div>

            <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-medium text-gray-800 text-lg">Billing address</h3>
                    <a href="{{ route('user.paymentMethodView') }}" class="text-primary">Edit</a>
                </div>
                <div class="space-y-1">
                    <h4 class="text-gray-700 font-medium">{{ auth()->user()->name }}</h4>
                    @if($billing == null)
                        <p class="text-gray-800">Bạn chưa thêm phương thức thanh toán mặc định</p>
                    @else
                        <p class="text-gray-800">{{$billing[0]->value}}, {{$billing[0]->provider}}, {{$billing[0]->number}}.</p>
                    @endif
                    <p class="text-gray-800">{{ auth()->user()->phone_number }}</p>
                </div>
            </div>

        </div>
        <!-- ./info -->

    </div>
    <!-- ./account wrapper -->
</x-layout>
