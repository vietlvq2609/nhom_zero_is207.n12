<x-layout :categories="$categories">
    <!-- login -->
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1">Đăng ký tài khoản mới</h2>
            <form action="/register" method="POST" autocomplete="off">
                @csrf
                <div class="space-y-2">
                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">Họ và tên</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Nguyễn Văn A">
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone_number" class="text-gray-600 mb-2 block">Số điện thoại</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{old('phone_number')}}" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="0981xxxxxx">
                        @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email_address" class="text-gray-600 mb-2 block">Địa chỉ email</label>
                        <input type="email" name="email_address" value="{{old('email_address')}}" id="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="ngvana@email.com">
                        @error('email_address')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-gray-600 mb-2 block">Nhập lại mật khẩu</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                        @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Đăng ký</button>
                </div>
            </form>
            <p class="mt-4 text-center text-gray-600">Đã có tài khoản? <a href="/login" class="text-primary">Đăng nhập ngay</a></p>
        </div>
    </div>
    <!-- ./login -->
</x-layout>