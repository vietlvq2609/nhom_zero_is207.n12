@if(session()->has('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 1000)" x-show="show" 
    class="fixed bottom-1/2 min-h-[20%] right-1/2 translate-x-2/4 translate-y-2/4 bg-amber-300 w-2/5 px-5 py-2 transition rounded drop-shadow-2xl flex items-center justify-center">
    <p class="text-lg text-gray-900 text-center">
        {{session('message')}}
    </p>
</div>
@endif