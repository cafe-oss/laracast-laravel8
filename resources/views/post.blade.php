<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My BLog</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
        <link rel="stylesheet" href="/app.css">
        {{-- <script src="/app.js"></script> --}}
        {{-- <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style> --}}
    </head>
    <body>
        <article>
            <article>
                <h1><?= $post->title; ?></h1>
                <?= $post->body; ?>
             </article>
        </article>

        <a href="/">Go Back</a>

    </body>
</html>
