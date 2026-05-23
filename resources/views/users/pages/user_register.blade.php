<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register - Video App</title>

    @include('users.include.user_header_link')

    <style>

        .register-section{
            padding: 180px 0px 100px 0px;
        }

        .register-card{
            background: #0171f9;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
        }

        .register-card h6{
            color: #ffffff;
            font-size: 16px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .register-card h2{
            color: #ffffff;
            font-size: 45px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .register-card p{
            color: #ffffff;
            margin-bottom: 35px;
        }

        .custom-input{
            width: 100%;
            height: 60px;
            border-radius: 40px;
            border: none;
            padding-left: 25px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .custom-input:focus{
            outline: none;
            box-shadow: none;
        }

        .register-btn{
            width: 100%;
            height: 60px;
            border: none;
            border-radius: 40px;
            background: #ee626b;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            transition: 0.3s;
        }

        .register-btn:hover{
            background: #d94b55;
        }

        .login-link{
            color: #ffffff;
            margin-top: 20px;
            text-align: center;
        }

        .login-link a{
            color: #ffcccb;
            font-weight: 600;
        }

        .alert-danger{
            border-radius: 15px;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<!-- Header Start -->
<header class="header-area header-sticky">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <nav class="main-nav">

                    <!-- Logo -->
                    <a href="{{ url('/') }}"
                       class="logo">

                        <img src="{{ asset('assets/images/logo.png') }}"
                             alt="Logo"
                             style="width: 158px;">

                    </a>

                    <!-- Menu -->
                    <ul class="nav">

                        <li>
                            <a href="{{ url('/') }}">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('register') }}"
                               class="active">

                                Register

                            </a>
                        </li>

                    </ul>

                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>

                </nav>

            </div>

        </div>

    </div>

</header>
<!-- Header End -->


<!-- Register Section Start -->
<div class="register-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="register-card text-center">

                    <h6>Create Account</h6>

                    <h2>REGISTER NOW</h2>

                    <p>
                        Join now and start watching amazing videos anytime.
                    </p>

                    <!-- Validation Errors -->
                    @if ($errors->any())

                        <div class="alert alert-danger text-start">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <!-- Register Form -->
                    <form method="POST" id="registerForm">

                        @csrf

                        <!-- Name -->
                        <input type="text"
                               name="name"
                               class="custom-input"
                               placeholder="Enter Name"
                               value="{{ old('name') }}"
                               required>

                        <!-- Email -->
                        <input type="email"
                               name="email"
                               class="custom-input"
                               placeholder="Enter Email"
                               value="{{ old('email') }}"
                               required>

                        <!-- Password -->
                        <input type="password"
                               name="password"
                               class="custom-input"
                               placeholder="Enter Password"
                               required>

                        <!-- Confirm Password -->
                        <input type="password"
                               name="password_confirmation"
                               class="custom-input"
                               placeholder="Confirm Password"
                               required>

                        <!-- Register Button -->
                        <button type="submit"
                                class="register-btn">

                            Register

                        </button>

                    </form>

                    <!-- Login Link -->
                    <div class="login-link">

                        Already have an account?

                        <a href="{{ route('login') }}">
                            Login
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- Register Section End -->


@include('users.include.user_footer_link')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
<script>

$("#registerForm").submit(function(e){

    e.preventDefault();

    $(".text-danger").html('');

    $.ajax({

        url: "{{ route('store_user') }}",

        type: "POST",

        data: $(this).serialize(),

        success: function(response){

            if(response.status == true){

                iziToast.success({

                    title: 'Success',

                    message: response.message,

                    position: 'topRight',

                    timeout: 3000

                });

                $("#registerForm")[0].reset();

                setTimeout(function(){

                    window.location.href = "{{ route('dashboard') }}";

                }, 2000);

            }

        },

        error: function(xhr){

            let errors = xhr.responseJSON.errors;

            $.each(errors, function(key, value){

                $(".error_" + key).html(value[0]);

            });

            iziToast.error({

                title: 'Error',

                message: 'Please fix validation errors',

                position: 'topRight',

                timeout: 3000

            });

        }

    });

});

</script>
</body>
</html>
