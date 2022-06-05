{{-- option 1 layout --}}
@extends('layout1')
@section('content')
    <article>
        <article>
            <h1><?= $post->title; ?></h1>
            <?= $post->body; ?>
            </article>
    </article>

    <a href="/">Go Back</a>
    @endsection

{{-- option two layout called blade components --}}
{{-- <x-layout2>
    ..
</x-layout2> --}}

