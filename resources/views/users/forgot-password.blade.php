<x-layout>
    <!-- get new password -->
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1">Quên mật khẩu</h2>
            <form action="{{ route('password.email') }}" method="POST" autocomplete="off">
                @csrf
                <div class="space-y-2">
                    <div>
                        <label for="email_address" class="text-gray-600 mb-2 block">Địa chỉ email</label>
                        <input type="email" name="email_address" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="youremail@domain.com">
                    </div>
                    @error('email_address')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <!--   -->
                    <button type="submit" class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Tiếp tục</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>