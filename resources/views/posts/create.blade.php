<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aprendible - {{ $title ?? '' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Default meta description' }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <form >
    <div class="container">
    <div class="card">
        <div class="card-header">
           View Create Post
        </div>
        <div class="card-body">
          <h5 class="card-title">Create Post</h5>
          <p class="card-text">
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Write text here" required>
            </div>
            <div class="form-group">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" class="form-control" placeholder="Write body test here" required></textarea>
            </div>
        </p>
          <button type="submit" class="btn btn-primary">Save post</button>
          <button type="reset" class="btn btn-warning">Clear</button>
        </div>
      </div>
    </div>
    </form>
</body>
</html>



