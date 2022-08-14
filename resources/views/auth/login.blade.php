<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container center">
        <div class="mt-3 text-center">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="card-header"><h5>Account Login</h5></div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">User</h5>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Login</button>
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>
</html>
