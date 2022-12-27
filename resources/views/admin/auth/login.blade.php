<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/argon.min.css')}}">
    <title>Admin Login</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header  bg-dark">
                        <p class="text-white text-center p-0 m-0">Please Login </p>
                    </div>
                    <div class="card-body">
                        @if(session()->has('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                        <form action="{{url('/admin/login')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Enter Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <input type="submit" value="Login" class="btn btn-dark">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
