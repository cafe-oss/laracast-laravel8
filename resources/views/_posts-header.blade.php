<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Laravel From Scratch</span> News
    </h1>

    {{-- <h2 class="inline-flex mt-2">By Lary Laracore <img src="/images/lary-head.svg"
                                                       alt="Head of Lary the mascot"></h2>

    <p class="text-sm mt-14">
        Another year. Another update. We're refreshing the popular Laravel series with new content.
        I'm going to keep you guys up to speed with what's going on! --}}
    {{-- </p> --}}

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl">


                

                <x-dropdown>
                    <x-slot name="trigger">
                        <button 
                        class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left lg:inline-flex">
                            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Category' }} 
                    
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
                            href="/categories/{{ $category->slug }}" 
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
                
        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="#">
                <input type="text" name="search" placeholder="Find something" value="{{request('search')}}"
                       class="bg-transparent placeholder-black font-semibold text-sm">
            </form>
        </div>
    </div>
</header>