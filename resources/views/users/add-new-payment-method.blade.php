<x-layout>
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1">Thêm phương thức thanh toán mới</h2>
            <form action="{{ route('user.addPaymentMethod') }}" method="POST" autocomplete="off">
                @csrf
                <div class="space-y-2">

                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    
                    <!-- loại phương thức thanh toán -->

                    @php
                        $payment_types = DB::table('payment_types')
                            ->select('id','value')
                            ->get();
                    @endphp

                    <div>
                        <label for="payment_type_id" class="text-gray-600 mb-2 block">Chọn phương thức thanh toán:</label>
                        <select name="payment_type_id" id="payment_type" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                        @foreach ($payment_types as $payment_type)
                            <option value="{{$payment_type->id}}" selected>
                                {{$payment_type->value}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    @error('payment_type_id')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                

                    <!-- Provider -->

                    <div>
                        <label for="provider" class="text-gray-600 mb-2 block">Nhà cung cấp (hoặc tên của bạn nếu bạn chọn trả bằng tiền mặt):</label>
                        <input type="text" name="provider" id="provider" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="VD: Sacombank, Momo, Nguyễn Văn A">
                    </div>
                    @error('provider')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <!-- Số tài khoản -->

                    <div>
                        <label for="account_number" class="text-gray-600 mb-2 block">Số tài khoản (hoặc số điện thoại nếu bạn dùng ví điện tử hoặc trả bằng tiền mặt):</label>
                        <input type="text" name="account_number" id="account_number" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="VD: 3141xxxxxxxxxxx, 0933xxxxxx">
                    </div>
                    @error('account_number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <!-- ngày hết hạn -->

                    <!-- <div>
                        <label for="expiry_date" class="text-gray-600 mb-2 block">Ngày hết hạn (chỉ điền khi bạn áp dụng ):</label>
                        <input type="text" name="expiry_date" id="expiry_date" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="VD: Ngày thẻ hết hạn, vd: 12/20">
                    </div>
                    @error('expiry_date')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror -->
                </div>
                <div class="mt-4">
                    <button type="submit" class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Thêm phương thức</button>
                </div>
            </form>
        </div>
    </div>
    
</x-layout>