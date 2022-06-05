{{-- option 1 layout --}}
@extends('layout1')
@section('content')
    <?php foreach($posts as $post): ?>
        <article>
            <h1><a href= "posts/<?= $post->slug; ?>" ><?= $post->title; ?> </a></h1>
            <?= $post->excerpt; ?>
        </article>
    <?php endforeach; ?>
@endsection

{{-- <x-layout2>
    ..
</x-layout2> --}}

