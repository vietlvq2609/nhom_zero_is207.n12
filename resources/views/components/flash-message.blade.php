@if(session()->has('message'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" 
    class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-primary border brightness-80 text-white px-48 py-3">
    <p>
        {{session('message')}}
    </p>
</div>
@endif