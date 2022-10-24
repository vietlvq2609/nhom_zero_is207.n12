@props(['categories']);

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZeroFood - Ăn ngon mặc đẹp</title>

    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" type="image/x-icon">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Alpine JS -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: '#ef3b2d',
                    },
                },
            },
        }
    </script>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<!-- primary color bg-amber-500 -->

<body>
    <!-- header -->
    <header class="py-4 shadow-sm bg-white">
        <div class="container flex items-center justify-between">
            <a href="/">
                <img src="/assets/images/logo.svg" alt="Logo" class="w-32">
            </a>

            <div class="w-full max-w-xl relative flex">
                <span class="absolute left-4 top-3 text-lg text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" id="search" class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none" autocomplete="off" placeholder="Tìm kiếm sản phẩm">
                <button class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                <a href="#" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-2xl">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div class="text-xs leading-3">Giỏ hàng</div>
                    <div class="absolute right-0 top-0 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
                        2</div>
                </a>
                <a href="/user" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-2xl">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="text-xs leading-3">Tài khoản</div>
                </a>
                @else
                <a href="#" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-2xl">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div class="text-xs leading-3">Giỏ hàng</div>
                    <div class="absolute right-0 top-0 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
                        0</div>
                </a>
                @endauth
            </div>
        </div>
    </header>
    <!-- ./header -->

    <!-- navbar -->
    <nav class="bg-gray-800">
        <div class="container flex">
            <div class="px-8 py-4 bg-primary flex items-center cursor-pointer relative group">
                <span class="text-white">
                    <i class="fa-solid fa-bars"></i>
                </span>
                <span class="capitalize ml-2 text-white">Order ngay</span>

                <!-- dropdown -->
                <div class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                    @foreach($categories as $category)
                    <a href="/products?category={{$category->id}}" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <span class="ml-6 text-gray-600 text-sm">{{$category->category_name}}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-between flex-grow pl-12">
                <div class="flex items-center space-x-6 capitalize">
                    <a href="/" class="text-gray-200 hover:text-white transition">Trang chủ</a>
                    <a href="/products" class="text-gray-200 hover:text-white transition">Shop</a>
                    <a href="/about" class="text-gray-200 hover:text-white transition">Về chúng tôi</a>
                    <a href="/contact" class="text-gray-200 hover:text-white transition">Liên hệ</a>
                </div>
                @auth
                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="text-gray-200 hover:text-white transition">
                        <i class="fa-solid fa-door-closed"></i>
                        <span>Đăng xuất</span>
                    </button>
                </form>
                @else
                <div>
                    <a href="/login" class="inline-block bg-primary rounded py-1 px-2 text-gray-200 hover:brightness-95 text-sm transition">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Đăng nhập</span>
                    </a>
                    <a href="/register" class="inline-block bg-emerald-600 rounded py-1 px-2 text-white hover:brightness-95 text-sm transition">
                        <i class="fa-solid fa-user"></i>
                        <span>Đăng ký</span>
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </nav>
    <!-- ./navbar -->
    <main>
        {{$slot}}
    </main>
    <!-- footer -->
    <footer class="bg-white pt-10 pb-7 border-t border-gray-100">
        <div class="container grid grid-cols-2">
            <div class="col-span-1 space-y-8">
                <img src="/assets/images/logo.svg" alt="logo" class="w-30">
                <div class="mr-2">
                    <p class="text-gray-500">
                        Đồ án cuối kỳ môn Nhập môn phát triển ứng dụng web
                    </p>
                    <p class="text-primary">
                        Nhóm Zero
                    </p>
                </div>
            </div>

            <div class="col-span-1 grid justify-end items-center">
                <div class="flex space-x-6">
                    <a href="facebook.com" target="_blank" class="text-gray-400 hover:text-gray-500"><i class="text-3xl fa-brands fa-facebook-square"></i></a>
                    <a href="instagram.com" target="_blank" class="text-gray-400 hover:text-gray-500"><i class="text-3xl fa-brands fa-instagram-square"></i></a>
                    <a href="twitter.com" target="_blank" class="text-gray-400 hover:text-gray-500"><i class="text-3xl fa-brands fa-twitter-square"></i></a>
                    <a href="github.com" target="_blank" class="text-gray-400 hover:text-gray-500"><i class="text-3xl fa-brands fa-github-square"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- ./footer -->

    <!-- copyright -->
    <div class="bg-gray-800 py-4">
        <div class="container flex items-center justify-between">
            <p class="text-white">&copy; TailCommerce - All Right Reserved</p>
            <div>
                <img src="assets/images/methods.png" alt="methods" class="h-5">
            </div>
        </div>
    </div>
    <!-- ./copyright -->
    <x-flash-message />
</body>

</html>