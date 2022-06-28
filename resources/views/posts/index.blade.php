<x-layout-section5>

    @include('posts._header') 

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        {{-- pass the $posts[0] to post-featured-card view so use this :post="$post[0]", in this file we route and pass the Post data --}}
        {{-- and inside the corresponding view(post-featured-card) add this at top @prop(["post"]) --}}

        {{-- this will avoid an error message if the post table is empty --}}
        {{-- WAYS to check if null = $posts->count() > 1 OR $posts->isNotEmpty() or isset($posts)--}}
        @if (isset($posts))
            {{-- posts[0] or posts->first() --}}
            <x-post-featured-card :post="$posts->first()"/>

            <div class="lg:grid lg:grid-cols-6">
                {{-- we need to bypass the $posts[0] --}}
                @foreach ($posts->skip(1) as $post)

                    {{-- gamit ni siya para info sa mga loop pero dapat sa loop  --}}
                    {{-- @dd($loop) --}}
                    {{-- <x-post-card :post="$post"  --}}
                    {{-- add if statement that determine which post should have grid col-span2 and col-span3 --}}
                    <x-post-card :post="$post" class="{{$loop->iteration < 3 ?  'col-span-3' : 'col-span-2'}}"/>
                @endforeach
                
            </div>
        @else
            <p class="text-center"></p>
        @endif

        {{-- <div class="lg:grid lg:grid-cols-3">
            <x-post-card />
            <x-post-card />
            <x-post-card /> 
        </div> --}}
    </main>
</x-layout-section5>
        