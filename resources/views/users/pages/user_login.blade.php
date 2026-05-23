<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login - Video App</title>

    @include('users.include.user_header_link')

    <!-- iziToast -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

    <style>

        .login-section{
            padding: 180px 0px 100px 0px;
        }

        .login-card{
            background: #0171f9;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
        }

        .login-card h6{
            color: #ffffff;
            font-size: 16px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .login-card h2{
            color: #ffffff;
            font-size: 45px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .login-card p{
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

        .login-btn{
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

        .login-btn:hover{
            background: #d94b55;
        }

        .register-link{
            color: #ffffff;
            margin-top: 20px;
            text-align: center;
        }

        .register-link a{
            color: #ffcccb;
            font-weight: 600;
        }

        .text-danger{
            color: #ffb3b3;
            text-align: left;
            display: block;
            margin-top: -15px;
            margin-bottom: 15px;
            padding-left: 10px;
        }

    </style>

</head>

<body>

<!-- Header -->
<header class="header-area header-sticky">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <nav class="main-nav">

                    <a href="{{ url('/') }}"
                       class="logo">

                        <img
                             alt=""
                             style="width: 158px;">

                    </a>

                    <ul class="nav">

                        <li>
                            <a href="{{ url('/') }}">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('login') }}"
                               class="active">
                                Login
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('register') }}">
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

<!-- Login Section -->
<div class="login-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="login-card text-center">

                    <h6>Welcome Back</h6>

                    <h2>LOGIN NOW</h2>

                    <p>
                        Login and continue watching amazing videos.
                    </p>

                    <form id="loginForm">

                        @csrf

                        <!-- Email -->
                        <input type="email"
                               name="email"
                               class="custom-input"
                               placeholder="Enter Email">

                        <span class="text-danger error_email"></span>

                        <!-- Password -->
                        <input type="password"
                               name="password"
                               class="custom-input"
                               placeholder="Enter Password">

                        <span class="text-danger error_password"></span>

                        <!-- Button -->
                        <button type="submit"
                                class="login-btn">

                            Login

                        </button>

                    </form>

                    <!-- Register Link -->
                    <div class="register-link">

                        Don't have an account?

                        <a href="{{ route('register') }}">
                            Register
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('users.include.user_footer_link')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

<script>

$("#loginForm").submit(function(e){

    e.preventDefault();

    $(".text-danger").html('');

    $.ajax({

        url: "{{ route('login.check') }}",

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

                $("#loginForm")[0].reset();

                setTimeout(function(){

                    window.location.href = "{{ route('dashboard') }}";

                }, 2000);

            }else{

                iziToast.error({

                    title: 'Error',

                    message: response.message,

                    position: 'topRight',

                    timeout: 3000

                });

            }

        },

        error: function(xhr){

            let errors = xhr.responseJSON.errors;

            $.each(errors, function(key, value){

                $(".error_" + key).html(value[0]);

            });

        }

    });

});

</script>

</body>
</html>
