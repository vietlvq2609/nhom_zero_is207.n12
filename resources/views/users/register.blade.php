<x-layout>
    <!-- login -->
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Create an account</h2>
            <p class="text-gray-600 mb-6 text-sm">
                Register for new cosutumer
            </p>
            <form action="/register" method="POST" autocomplete="off">
                @csrf
                <div class="space-y-2">
                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">Full Name</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="fulan fulana">
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone_number" class="text-gray-600 mb-2 block">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{old('phone_number')}}" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="0981xxxxxx">
                        @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email_address" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email_address" value="{{old('email_address')}}" id="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="youremail.@domain.com">
                        @error('email_address')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-gray-600 mb-2 block">Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                        @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="block w-full py-2 text-center bg-primary border border-primary rounded hover:bg-primary hover:text-white text-primary transition uppercase font-roboto font-medium">create
                        account</button>
                </div>
            </form>
            <p class="mt-4 text-center text-gray-600">Already have account? <a href="/login" class="text-primary">Login now</a></p>
        </div>
    </div>
    <!-- ./login -->
</x-layout>