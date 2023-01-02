<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M-Commerce</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Padauk:wght@400;700&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('web_assets/css/argon.min.css')}}">
    <link rel="stylesheet" href="{{asset('web_assets/css/style.css')}}">
</head>

<body>
    <!-- header -->
    <style>

    </style>
    <div class="header">
        <div class="w-80">
            <!-- navigation -->
            <div class="nav d-flex justify-content-between pt-3">
                <div class="nav-first d-flex justify-content-between align-items-center">
                    <a href="{{url('/')}}">
                        <img src="{{asset('web_assets/images/logo.png')}}" width="50" alt="">
                    </a>

                    <div class="nav-item-group ml-5">

                        <a href="{{url('/products')}}" class="text-white btn btn btn-outline-warning">Product</a>
                        <a href="" class="text-white btn btn btn-outline-dark">Category</a>
                        <a href="" class="text-white btn btn btn-outline-dark ">Hot Deal</a>
                        <a href="" class="text-white btn btn btn-outline-dark ">About</a>

                        <a href="#" class="btn btn-outline-dark cart-container">

                            <i class="fas text-danger  fa-shopping-basket fs-1"></i>
                            <span class="cart-no bg-danger text-white">10</span>
                        </a>

                    </div>
                </div>
                <div class="d-flex jusity-content-center">
                    <div class=" d-flex justify-content-center align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-dark text-white dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Account
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-center align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-dark text-white dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Language
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">မြန်မာ</a>
                                <a class="dropdown-item" href="#">English</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center p-5">
            <h1 class="text-center text-white">Welcome From M-Commerce</h1>
            <small class="">M-Commerce is Develop by mmcoder.com and for educational purpose...</small>

            <div class="mt-5">
                <a href="" class="btn btn-dark">Login</a>
                <a href="" class="btn btn-outline-dark text-white">Register</a>
            </div>
        </div>
    </div>

    @yield('content')

    <div class="bg-dark p-5 text-center text-white">
        Develop By <a href="https://mmcoder.com" class="text-success">MM-Coder</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="{{asset('web_assets/js/argon.min.js')}}"></script>

</body>

</html>
