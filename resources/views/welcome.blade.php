{{-- option 1 layout --}}
@extends('layout1')
@section('content')
    <?php foreach($posts as $post): ?>
        <article>
            <h1><a href= "/posts/<?= $post->slug; ?>" ><?= $post->title; ?> </a></h1>
            
            <p>
                By <a href="/authors/{{$post->author->username }}">{{$post->author->name}}</a>, 
                <a href="/categories/{{$post->category->slug}}">{{$post->category->name }}</a>
            </p>
            <?= $post->excerpt; ?>
        </article>
        
    <?php endforeach; ?>
@endsection

{{-- <x-layout2>
    ..
</x-layout2> --}}

