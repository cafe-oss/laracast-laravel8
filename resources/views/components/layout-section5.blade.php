<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    html{
        scroll-behavior: smooth;
    }

    .clamp{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .clamp.one-line{
        -webkit-line-clamp: 1;
    }
</style>
<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
    
                {{-- if you are not a guest then --}}
                @auth
                    <x-dropdown>
                        <x-slot name="trigger">
                            <img src="https://i.pravatar.cc/60?u={{ auth()->user()->id }}" alt="" width="60" height="60" class="rounded-xl mr-6">
                            {{-- <span class="text-xs font-bold uppercase"> {{ auth()->user()->name }}</span> --}}
                        </x-slot>

                        {{-- solution 1 for authorization admin, using @if --}}
                        {{-- @if (auth()->user()->can('admin'))
                            <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')">
                                Dashboard
                            </x-dropdown-item>

                            <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">
                                New Post
                            </x-dropdown-item>
                        @endif --}}

                        {{-- solution 2 using the @can directive--}}
                        @can('admin')
                            <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')">
                                Dashboard
                            </x-dropdown-item>

                            <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">
                                New Post
                            </x-dropdown-item>
                        @endcan

                        {{-- solution 3, making own blade directive --}}
                        {{-- @admin
                            <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')">
                                Dashboard
                            </x-dropdown-item>

                            <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">
                                New Post
                            </x-dropdown-item>
                        @endadmin --}}

                        <x-dropdown-item href="/" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">
                            Log Out
                        </x-dropdown-item>

                        <form id="logout-form" action="/logout" method="POST" class="hidden">
                            @csrf
                        </form>

                    </x-dropdown>

                    {{-- <form action="/logout" method="POST" class="text-xs font-semibold text-blue-500 ml-6">
                        <button type="submit" class="text-xs font-bold uppercase">Log Out</button>
                        @csrf
                    </form> --}}

                {{-- if you are a guest --}}
                @else
                    <a href="/register" class="text-xs font-bold uppercase">Register</a>

                    <a href="/login" class="ml-6 text-xs font-bold uppercase">Login</a>
                @endauth
                

                <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>
            </div>
        </nav>

        {{-- dili ni mugana kay kani na file naa sulod sa components folder tas ang ge tawag nako NA _POSTS-HEADER kay naa gawas ani na folder
            okay ra ang getawag kay naa sulod sa folder tas naa sa gawas ang nag tawag --}}
        {{-- <x-_posts-header /> --}}
        {{-- ang solution ani kay @inlcude--}}
        {{-- @include('_posts-header') --}}


        {{$slot}}

        <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
            <h5 class="text-3xl">Stay in touch with the latest posts</h5>
            <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="/newsletter" class="lg:flex text-sm">
                        @csrf
                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input name="email" id="email" type="text" placeholder="Your email address"
                                   class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                            @error('email')
                                <span class="text-xs text-red-500"> {{ $message }}</span>
                                
                            @enderror
                        </div>

                        <button type="submit"
                                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                        >
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer>

        <x-flash />
    </section>
</body>
