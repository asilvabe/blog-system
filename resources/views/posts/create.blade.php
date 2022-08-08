<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
    <div class="container">
    <div class="card text-dark bg-light mb-3" style="width: 18rem;">
        @if(session('status'))
        <div class="card-header">
          {{ session('status') }}
        </div>
        @endif
        <div class="card-body " >
          <h5 class="card-title">Create Post</h5>
          <p class="card-text col-md-4">
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Write text here" value="{{old('title')}}">
                @error('title')
                    <small class="alert-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" class="form-control" placeholder="Write body test here" >{{old('body')}}</textarea>
                @error('body')
                <small class="alert-danger">{{$message}}</small>
                @enderror
            </div>

          <button type="submit" class="btn btn-primary">Save post</button>
          <input  type="reset" class="btn btn-warning" value="Reset" />

      </div>
    </div>
    </form>
</body>
</html>



