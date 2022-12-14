<x-layout>
<div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1">Lấy lại mật khẩu</h2>
            <form action="{{ route('password.update',['user' => $user, 'token' => $token]) }}" method="POST" autocomplete="off">
                @csrf
                <div class="space-y-2">
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Mật khẩu mới</label>
                        <input type="password" name="password" id="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <div>
                        <label for="password_confirmation" class="text-gray-600 mb-2 block">Nhập lại mật khẩu mới</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <button type="submit" class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
