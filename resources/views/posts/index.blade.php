<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Index</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        @foreach ($posts as $post)
        <div class="row">
            <div class="col-md-12">
                <div style="display: flex; align-items:baseline">
                        <h3><a href="{{ route('posts.show',$post) }}">{{ $post->title }}</a></h3>
                </div>

            </div>

        </div>
        @endforeach
    </div>
</body>
</html>
