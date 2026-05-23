<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>

    {{-- Header Links --}}
    @include('admin.includes.header_link')

</head>

<body class="bg-gradient-to-br from-slate-900 via-fuchsia-900 to-slate-900 min-h-screen flex items-center justify-center">

    <!-- Background Blur Effect -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-fuchsia-500 rounded-full blur-3xl opacity-20"></div>

    <div class="absolute bottom-0 right-0 w-72 h-72 bg-cyan-500 rounded-full blur-3xl opacity-20"></div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md px-6">

        <div class="bg-white/10 backdrop-blur-xl border border-white/20 shadow-2xl rounded-3xl p-8">

            <!-- Logo -->
            <div class="text-center mb-8">

                <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-tr from-fuchsia-500 to-cyan-500 flex items-center justify-center shadow-lg">

                    <i class="fas fa-user-shield text-white text-3xl"></i>

                </div>

                <h2 class="mt-5 text-3xl font-bold text-white">

                    Admin Login

                </h2>

                <p class="text-gray-300 text-sm mt-2">

                    Welcome back! Please login to continue.

                </p>

            </div>

            <!-- Login Form -->
            <form id="loginForm" class="space-y-5">

                <!-- Email -->
                <div>

                    <label class="block text-sm font-semibold text-white mb-2">

                        Email Address

                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">

                            <i class="fas fa-envelope"></i>

                        </span>

                        <input
                            type="email"
                            name="email"
                            placeholder="Enter your email"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                    </div>

                </div>

                <!-- Password -->
                <div>

                    <label class="block text-sm font-semibold text-white mb-2">

                        Password

                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">

                            <i class="fas fa-lock"></i>

                        </span>

                        <input
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                    </div>

                </div>

                <!-- Remember + Forgot -->
                {{-- <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center text-gray-300">

                        <input type="checkbox" class="mr-2 rounded">

                        Remember me

                    </label>

                    <a href="#" class="text-fuchsia-300 hover:text-fuchsia-200">

                        Forgot Password?

                    </a>

                </div> --}}

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full py-3 rounded-xl font-bold text-white bg-gradient-to-r from-fuchsia-500 to-cyan-500 hover:scale-105 transition duration-300 shadow-lg">

                    <i class="fas fa-sign-in-alt mr-2"></i>

                    Login Now

                </button>

            </form>

        </div>

    </div>

    {{-- Footer Links --}}
    @include('admin.includes.admin_footer_links')
<script>

$(document).ready(function () {

    $('#loginForm').submit(function (e) {

        e.preventDefault();

        $.ajax({

            url: "{{ route('admin_login') }}",

            type: "POST",

            data: {

                _token: "{{ csrf_token() }}",

                email: $('input[name=email]').val(),

                password: $('input[name=password]').val()

            },

            success: function (response) {

                if (response.status == true) {

                    iziToast.success({
                        title: 'Success',
                        message: response.message,
                        position: 'topRight'
                    });

                    setTimeout(function () {

                        window.location.href = response.redirect;

                    }, 1000);

                } else {

                    iziToast.error({
                        title: 'Error',
                        message: response.message,
                        position: 'topRight'
                    });
                }
            }
        });
    });

});

</script>
</body>

</html>
