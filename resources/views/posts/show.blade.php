<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Show</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->body }}</p>
                <p>{{ $post->created_at->format('d/m/Y H:i a') }}</p>
                <p>Autor: {{ $post->author->name }}</p>
                @auth
                    @if(auth()->user()->isAdmin())
                        <p>Approved by: {{ $post->getApproverName() }}</p>
                        <p>Date Approved: {{ $post->approved_at }}</p>
                        @if(!$post->isApprove())
                            <form method="POST" action="{{ route('posts.approve', $post) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Approve post</button>
                            </form>
                            <br>
                        @endif
                    @endif
                @endauth
                <a href ="{{ route('posts.index') }}">Regresar</a>
            </div>
        </div>
    </div>
</body>
</html>
