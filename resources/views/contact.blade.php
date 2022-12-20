<x-layout>
    <div class="contain py-16">
        @auth
            <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100">
                <h2 class="text-2xl uppercase font-medium mb-1">Feedback</h2>
                <form action="/user/authenticate" method="POST" autocomplete="off">
                    @csrf
                    <div class="space-y-2">
                        <div>
                            <label for="subject" class="text-gray-600 mb-2 block">Chủ đề</label>
                            <input type="text" name="subject" id="subject" value=""
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                                placeholder="Đặt hàng">
                        </div>
                        <div>
                            <label for="feedback" class="text-gray-600 mb-2 block">Nội dung</label>
                            <textarea type="feedback" name="feedback" id="feedback"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                                placeholder="Giao hàng nhanh! Sản phẩm chất lượng"></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <!--   -->
                        <button type="submit"
                            class="block w-full py-2 text-center text-white border border-amber-500 rounded bg-amber-500 hover:bg-transparent hover:text-amber-500 transition uppercase font-roboto font-medium">Gửi Feedback</button>
                    </div>
                </form>
            </div>
        @else
            <div class="max-w-lg mx-auto shadow border px-6 py-7 rounded overflow-hidden bg-amber-100 relative">
                <img class="p-24" src="https://img.freepik.com/free-vector/oops-explosion-vector_53876-17099.jpg?w=2000" alt="">
                <h2 class="text-2xl text-center absolute top-3/4 text-gray-600">Bạn phải đăng nhập mới thực hiện được chức năng này</h2>
            </div>
        @endauth

    </div>
</x-layout>
