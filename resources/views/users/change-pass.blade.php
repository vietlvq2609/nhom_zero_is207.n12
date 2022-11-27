<x-layout>
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1">Thay đổi mật khẩu</h2>
            <form action="{{ route('user.postChangePassword') }}" method="POST">
                @csrf
                <div class="space-y-2">
                    <div>
                        <label for="oldPasswordInput" class="text-gray-600 mb-2 block">Mật khẩu hiện tại</label>
                        <input name="old_password" type="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" 
                            id="oldPasswordInput"
                            placeholder="Mật khẩu hiện tại">
                        @error('old_password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="newPasswordInput" class="text-gray-600 mb-2 block">Mật khẩu mới</label>
                        <input name="new_password" type="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            id="newPasswordInput"
                            placeholder="Mật khẩu mới">
                        @error('new_password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="confirmNewPasswordInput" class="text-gray-600 mb-2 block">Nhập lại mật khẩu mới</label>
                        <input name="new_password_confirmation" type="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" 
                            id="confirmNewPasswordInput"
                            placeholder="Nhập lại mật khẩu mới">
                        @error('new_password_confirmation')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="mt-4">
                    <button class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Thay đổi</button>
                </div>

            </form>
        </div>
    </div>
</x-layout> 
