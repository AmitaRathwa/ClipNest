<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <title>{{ $plan->sub_plan }}</title>

    @include('users.include.user_header_link')

</head>

<body>

@include('users.include.user_header')

<div class="page-heading header-text">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <h3>
                    {{ $plan->sub_plan }}
                </h3>

                <span class="breadcrumb">

                    <a href="{{ route('dashboard') }}">
                        Home
                    </a>

                    >

                    Subscription Details

                </span>

            </div>

        </div>

    </div>

</div>

<div class="single-product section">

    <div class="container">

        <div class="row">

            <!-- LEFT IMAGE -->

            <div class="col-lg-6">

                <div class="left-image">

                    <img
                        <img src="{{ $actual_url.'/user/images/subscribe.png' }}"
                        alt=""
                        {{-- class="img-fluid rounded", --}}
                         style="
        width: 100%;
        height: 450px;
        object-fit: cover;
        border-radius: 20px;
    "
                    >

                </div>

            </div>

            <!-- RIGHT CONTENT -->

            <div class="col-lg-6 align-self-center">

                <h4>

                    {{ $plan->sub_plan }}

                </h4>

                <span class="price">

                    ₹{{ $plan->price }}

                </span>

                <p>

                    {{ $plan->description }}

                </p>

                <div class="mt-4">

                    <h6>

                        Plan Duration :
                        <strong>
                            {{ $plan->months }} Month
                        </strong>

                    </h6>

                    @if($plan->discount > 0)

                        <h6>

                            Discount :
                            <strong class="text-success">
                                {{ $plan->discount }}%
                            </strong>

                        </h6>

                    @endif

                </div>

                <!-- PAYMENT BUTTON -->

                <div class="mt-4">

                    {{-- <a
                        href="#"
                        class="btn btn-primary"
                        style="
                            background:#0071f8;
                            border:none;
                            padding:14px 30px;
                            border-radius:30px;
                            font-weight:600;
                        "
                    >

                        Proceed To Payment

                    </a> --}}
                    <button
    type="button"
    class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#paymentModal"
    style="
        background:#0071f8;
        border:none;
        padding:14px 30px;
        border-radius:30px;
        font-weight:600;
    "
>
    Proceed To Payment
</button>

                </div>

            </div>

        </div>

    </div>

</div>

<footer>

    <div class="container">

        <div class="col-lg-12">

            <p>

                Copyright © 2048 LUGX Gaming Company.
                All rights reserved.

            </p>

        </div>

    </div>

</footer>

@include('users.include.user_footer_link')


<!-- PAYMENT MODAL -->

<div
    class="modal fade"
    id="paymentModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content"
             style="border-radius:20px; overflow:hidden;">

            <div class="modal-header"
                 style="background:#0071f8; color:white;">

                <h5 class="modal-title">

                    Complete Payment

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <div class="modal-body text-center p-4">

                <h4 class="mb-3">

                    {{ $plan->sub_plan }}

                </h4>

                <h2 class="text-primary mb-4">

                    ₹{{ $plan->price }}

                </h2>

                <!-- QR IMAGE -->

                <img
                    src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=DemoPayment"
                    alt="QR Code"
                    class="img-fluid mb-3"
                    style="
                        width:250px;
                        border:8px solid #f2f2f2;
                        border-radius:20px;
                    "
                >

                <p class="mb-1">

                    Scan QR using any UPI App

                </p>

                <small class="text-muted">

                    PhonePe / Google Pay / Paytm

                </small>

                <hr>

                <!-- DEMO PAYMENT BUTTON -->

                {{-- <button
                    class="btn btn-success w-100"
                    style="
                        padding:12px;
                        border-radius:30px;
                        font-weight:600;
                    "
                >

                    Demo Razorpay Payment

                </button> --}}
                <a
    href="{{ route('payment.success', $plan->sub_id) }}"
    class="btn btn-success w-100"
    style="
        padding:12px;
        border-radius:30px;
        font-weight:600;
    "
>

    Demo Razorpay Payment

</a>

            </div>

        </div>

    </div>

</div>
</body>
</html>
