<x-layout>
    @include('partials._banner')
    @include('partials._features')
    <x-category :categories="$categories" />
{{--     <x-products /> --}}
</x-layout> 