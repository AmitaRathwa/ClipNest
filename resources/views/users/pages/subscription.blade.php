<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Lugx Gaming Shop HTML5 Template</title>
 @include('users.include.user_header_link')

<style>
    .most-played {
    background-color: #f7f7f7;
    padding: 12px 0px;
    border-radius: 150px;
}
.section {
    margin-top: 58px;
}
.main-banner{
    padding: 94px 0px;
}


    </style>

  </head>

<body>


   @include('users.include.user_header')


  <div class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="caption header-text">
            <h6></h6>
            <h2>Subscription Plans</h2>
            {{-- <p>LUGX Gaming is free Bootstrap 5 HTML CSS website template for your gaming websites. You can download and use this layout for commercial purposes. Please tell your friends about TemplateMo.</p> --}}
            <div class="search-input">
              <form id="search" action="#">
                {{-- <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                <button role="button">Search Now</button> --}}
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4 offset-lg-2">
          <div class="right-image">
            <img src="{{ $actual_url.'/user/images/mv.jpg' }}" alt="">
            {{-- <img src="assets/images/banner-image.jpg" alt=""> --}}
            <span class="price">$22</span>
            <span class="offer">-40%</span>
          </div>
        </div>
      </div>
    </div>
  </div>




<div class="section most-played">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2>Add Your Subscription Plans</h2>
                </div>
            </div>

            @forelse($subscriptions as $plan)

                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="item">

                        {{-- <div class="thumb">
                            <img src="{{ asset('assets/images/top-game-01.jpg') }}" alt="">
                        </div> --}}

                        <div class="down-content text-center">

                            <span class="category">
                                {{ $plan->months }} Month Plan
                            </span>

                            <h4>
                                {{ $plan->sub_plan }}
                            </h4>

                            <h5 class="text-danger mb-2">
                                ₹{{ $plan->price }}
                            </h5>

                            @if($plan->discount > 0)
                                <p>
                                    Discount :
                                    <strong>{{ $plan->discount }}%</strong>
                                </p>
                            @endif

                            <p>
                                {{ $plan->description }}
                            </p>

                           <a href="{{ route('payment_page', $plan->sub_id) }}">
                                Explore
                            </a>

                        </div>
                    </div>
                </div>

            @empty

                <div class="col-lg-12 text-center">
                    <h5>No Subscription Plans Available</h5>
                </div>

            @endforelse

        </div>
    </div>
</div>



  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2048 LUGX Gaming Company. All rights reserved. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->


@include('users.include.user_footer_link')

  </body>
</html>
