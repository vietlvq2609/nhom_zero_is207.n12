<x-layout>
    <!-- login -->
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1">Đăng nhập</h2>
            <form action="/user/authenticate" method="POST" autocomplete="off">
                @csrf
                <div class="space-y-2">
                    <div>
                        <label for="email_address" class="text-gray-600 mb-2 block">Địa chỉ email</label>
                        <input type="email" name="email_address" id="email" value="{{old('name')}}" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="youremail@domain.com">
                    </div>
                    @error('email_address')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                        <label for="remember" class="text-gray-600 ml-3 cursor-pointer">Ghi nhớ mật khẩu</label>
                    </div>
                    <a href="#" class="text-primary">Quên mật khẩu</a>
                </div>
                <div class="mt-4">
                    <!--   -->
                    <button type="submit" class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Đăng nhập</button>
                </div>
            </form>

            <p class="mt-4 text-center text-gray-600">Bạn chưa có tài khoản? <a href="/register" class="text-primary">Đăng ký ngay</a></p>
        </div>
    </div>
    <!-- ./login -->
</x-layout>