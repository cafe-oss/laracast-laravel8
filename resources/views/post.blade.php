{{-- option 1 layout --}}
@extends('layout1')
@section('content')
    <article>
        <article>
            <h1>
                {{-- <'?=  ?> (removed the single quote and it will be equivalent to { !! !!})--}}
                <?= $post->title; ?>
            </h1>
                <p>
                    {{$post->body }}
                </p>
            </article>
    </article>

    <a href="/">Go Back</a>
    @endsection

{{-- option two layout called blade components --}}
{{-- <x-layout2>
    ..
</x-layout2> --}}

