<x-dropdown>
    <x-slot name="trigger">
        <button 
        class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left lg:inline-flex">
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }} 
    
        {{-- manage asingle svg --}}
        {{-- <x-down-arrow class="absolute pointer-events-none" style="right: 12px;"/> --}}
        
        {{-- manage multiple svg --}}
        <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>
    
        </button>
    </x-slot>
    
    <x-dropdown-item href="/" :active="request()->routeIs('home')">
        All
    </x-dropdown-item>
    
    @foreach ($categories as $category)

        <x-dropdown-item 
            href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}" 
            {{-- first method --}}
            {{-- :active="isset($currentCategory) && $currentCategory->is($category)"> --}}

            {{-- second method is use the request helper and check if the current url matches the string here then set to true--}}
            {{-- :active="request()->is('*' . $category->slug)"> --}}
            
            {{-- or similar with with this--}}
            :active=" request()->is('categories/' . $category->slug)" >

            {{-- third method is to use the helper and check it routes name (this is only for no wild cards route)--}}
            {{-- :active="request()->routeIs('home')">" --}}
            {{ucwords($category->name)}}
        </x-dropdown-item>
        
    @endforeach
</x-dropdown>