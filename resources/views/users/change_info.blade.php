<x-layout>
<div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1 text-center">Thông tin chung</h2>
            <form action="{{ route('user.postChangeInfo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-2">
                    <div class="flex justify-center py-4">
                    @if(!file_exists(public_path().'/assets/images/avatars/'.Auth::user()->avatar))
                    <img src="{{ asset('/assets/images/Avatar.jpg') }}" alt="avatar mặc định" class="rounded-full w-28 h-28 border border-gray-200 object-cover">
                    @else
                    <img src="{{ asset('/assets/images/avatars/'.Auth::user()->avatar) }}" alt="avatar của người dùng" class="rounded-full w-28 h-28 border border-gray-200 object-cover">
                    @endif
                </div>
                    
                    <div>
                        <label for="avatar" class="text-gray-600 mb-2 block">Chọn file ảnh để đặt lại Avartar:</label>
                        <input name="avatar" type="file" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" 
                            id="avatar">
                        @error('avatar')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">Họ và tên: </label>
                        <input name="name" type="text" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" 
                            id="name" value="{{ auth()->user()->name }}" placeholder="{{ auth()->user()->name }}">
                        @error('name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="phone_number" class="text-gray-600 mb-2 block">Số điện thoại</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ auth()->user()->phone_number }}" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="0981xxxxxx"
                        onchange="isNumber()">
                        @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email_address" class="text-gray-600 mb-2 block">Địa chỉ email</label>
                        <input type="email" name="email_address" value="{{ auth()->user()->email_address }}" id="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="ngvana@email.com">
                        @error('email_address')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Mật khẩu:</label>
                        <input type="password" name="password" id="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Lưu</button>
                </div>

            </form>
        </div>
    </div>
    <script>
        function isNumber()
        {
            // var phone = document.getElementById('phone_number').value
            // if (Number.NaN())
        }
    </script>
</x-layout>