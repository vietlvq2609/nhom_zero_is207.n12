<x-layout>
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
            <h2 class="text-2xl uppercase font-medium mb-1">Thêm địa chỉ mới</h2>
            <form action="{{ route('user.new-address-post') }}" method="POST" autocomplete="off">
                @csrf
                <div class="space-y-2">
                    
                    <!-- số nhà -->

                    <div>
                        <label for="unit_number" class="text-gray-600 mb-2 block">Số nhà:</label>
                        <input type="text" name="unit_number" id="unit_number" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="VD: số 82">
                    </div>
                    @error('unit_number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <!-- tên đường -->

                    <div>
                        <label for="street_number" class="text-gray-600 mb-2 block">Tên đường:</label>
                        <input type="text" name="street_number" id="street_number" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="VD: Quốc lộ 1A">
                    </div>
                    @error('street_number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <!-- phường, xã, thị trấn -->

                    <div>
                        <label for="address_line1" class="text-gray-600 mb-2 block">Phường/ Xã/ Thị trấn/ Ấp:</label>
                        <input type="text" name="address_line1" id="address_line1" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="VD: Đông Hòa">
                    </div>
                    @error('address_line1')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <!-- quận huyện -->

                    <div>
                        <label for="address_line2" class="text-gray-600 mb-2 block">Quận/ Huyện:</label>
                        <input type="text" name="address_line2" id="address_line2" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="VD: Gò Vấp">
                    </div>
                    @error('address_line2')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <!-- tỉnh thành phố -->

                    <div>
                        <label for="city" class="text-gray-600 mb-2 block">Tỉnh/ Thành phố</label>
                        <input type="text" name="city" id="city" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="VD: Hải Phòng">
                    </div>
                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <!-- mô tả địa chỉ cụ thể -->

                    <div>
                        <label for="region" class="text-gray-600 mb-2 block">Mô tả địa chỉ cụ thể:</label>
                        <textarea rows="4" cols="50" name="region" id="region" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="Ví dụ: đối diện trường XXX, nhà màu xxx, xung quanh có xxx,..."></textarea>
                    </div>
                    @error('region')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror


                    <!-- Quốc gia -->
                    <!-- truy xuất cơ sở dữ liệu để lấy các tên quốc gia trong bảng countries-->
                    @php
                        $countries = DB::table('countries')
                            ->select('id','country_name as name')
                            ->get();
                    @endphp

                    <div>
                        <label for="country_id" class="text-gray-600 mb-2 block">Quốc gia:</label>
                        <select name="country_id" id="country" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}" selected>
                                {{$country->name}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    @error('country_id')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <button type="submit" class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Thêm địa chỉ</button>
                </div>
            </form>
        </div>
    </div>
    
</x-layout>