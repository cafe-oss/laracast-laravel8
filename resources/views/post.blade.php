{{-- option 1 layout --}}
@extends('layout1')
@section('content')
    <article>
        <article>
            <h1>
                {{-- <'?=  ?> (removed the single quote and it will be equivalent to { !! !!})--}}
                {{-- @dd($post) --}}
                {{$post->title}}
            </h1>
                <p>
                    <a href="/authors/{{$post->author->username }}"> {{$post->author->name }} </a>
                </p>
                <p>
                    <a href="/categories/{{$post->category->slug}}"> {{$post->category->name }} </a>
                </p>

                <div>
                    <p>
                        {{$post->body }}
                    </p>
                </div>

            </article>
    </article>
    

    <a href="/">Go Back</a>
    @endsection

{{-- option two layout called blade components --}}
{{-- <x-layout2>
    ..
</x-layout2> --}}

