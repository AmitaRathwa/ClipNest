<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <title>Lugx Gaming - Categories</title>

    @include('users.include.user_header_link')

    <style>

        .watch-btn{
            border:none;
            background:#ee626b;
            color:#fff;
            padding:10px 20px;
            border-radius:25px;
            margin-top:10px;
        }

        .watch-btn:hover{
            background:#0071f8;
        }

        .video-modal{
            display:none;
            position:fixed;
            left:0;
            top:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.8);
            z-index:9999;
        }

        .video-box{
            width:70%;
            margin:5% auto;
            background:#fff;
            padding:20px;
            border-radius:10px;
            position:relative;
        }

        .close-btn{
            position:absolute;
            right:20px;
            top:10px;
            font-size:30px;
            cursor:pointer;
        }

    </style>

</head>

<body>

<!-- HEADER -->
{{--
<header class="header-area header-sticky">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <nav class="main-nav">

                    <a href="#" class="logo">

                        <img src="{{ asset('assets/images/logo.png') }}"
                             alt=""
                             style="width: 158px;">

                    </a>

                    <ul class="nav">

                        <li>
                            <a href="{{ route('dashboard') }}">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('categories') }}"
                               class="active">
                                Our Shop
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                Contact
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

</header> --}}
   @include('users.include.user_header')
<!-- PAGE HEADER -->

<div class="page-heading header-text">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <h3>

                    @if(isset($currentCategory))

                        {{ $currentCategory->category_name }}

                    @else

                        Our Shop

                    @endif

                </h3>

                <span class="breadcrumb">

                    <a href="{{ route('categories') }}">
                        Home
                    </a>

                    >

                    @if(isset($currentCategory))

                        {{ $currentCategory->category_name }}

                    @else

                        Our Shop

                    @endif

                </span>

            </div>

        </div>

    </div>

</div>

<!-- CATEGORY FILTER -->

<div class="section trending">

    <div class="container">

        <ul class="trending-filter">

            <li>

                <a
                    href="{{ route('categories') }}"
                    class="{{ request()->segment(1) == 'shop' ? 'is_active' : '' }}"
                >
                    Show All
                </a>

            </li>

            @foreach($categories as $category)

                <li>

                    <a
                        href="{{ route('category.videos',$category->cat_id) }}"
                    >

                        {{ $category->category_name }}

                    </a>

                </li>

            @endforeach

        </ul>

        <!-- VIDEOS -->

        <div class="row trending-box">

            @forelse($videos as $video)

                <div class="col-lg-3 col-md-6 mb-4">

                    <div class="item">

                        <div class="thumb">

                            <img
                                src="{{ asset('uploads/thumbnails/'.$video->thumbnail) }}"
                                alt=""
                            >

                        </div>

                        <div class="down-content">

                            <span class="category">

                                {{ $video->categoryData->category_name ?? '' }}

                            </span>

                            <h4>

                                {{ $video->movie_name }}

                            </h4>

                            <button
                                class="watch-btn"
                                  data-id="{{ $video->movie_id }}"
                                data-video="{{ asset('uploads/videos/'.$video->video) }}"
                            >
                                Watch Now
                            </button>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-lg-12 text-center">

                    <h4>No Videos Found</h4>

                </div>

            @endforelse

        </div>

    </div>

</div>

<!-- VIDEO MODAL -->

<div id="videoModal" class="video-modal">

    <div class="video-box">

        <span class="close-btn">&times;</span>

        <video
            id="previewVideo"
            width="100%"
            controls
            autoplay
        >
            <source src="" type="video/mp4">
        </video>

    </div>

</div>

<!-- FOOTER -->

{{-- <footer>

    <div class="container">

        <div class="col-lg-12">

            <p>

                Copyright © 2048 LUGX Gaming Company.
                All rights reserved.

            </p>

        </div>

    </div>

</footer> --}}

@include('users.include.user_footer_link')

<!-- VIDEO SCRIPT -->


<script>

let modal = document.getElementById('videoModal');

let previewVideo = document.getElementById('previewVideo');

let closeBtn = document.querySelector('.close-btn');

let countedVideo = null;

// WATCH BUTTON CLICK
document.querySelectorAll('.watch-btn').forEach(button => {

    button.addEventListener('click', function(){

        let videoUrl = this.getAttribute('data-video');

        let videoId = this.getAttribute('data-id');

        // SAVE CURRENT VIDEO ID
        countedVideo = videoId;


        @if($activePlan)

            previewVideo.src = videoUrl;

            modal.style.display = 'block';

            previewVideo.play();

            // COUNT VIEW AFTER 5 SECOND WATCH
            previewVideo.addEventListener(
                'timeupdate',
                countVideoView
            );

            return;

        @endif



        let alreadyWatched =
            localStorage.getItem('preview_watched');

        if(alreadyWatched == 'yes'){

            @if(session()->has('user_id'))

                window.location.href =
                    "{{ route('subscription') }}";

            @else

                window.location.href =
                    "{{ route('user_login') }}";

            @endif

            return;
        }


        previewVideo.src = videoUrl;

        modal.style.display = 'block';

        previewVideo.play();

        // COUNT VIEW
        previewVideo.addEventListener(
            'timeupdate',
            countVideoView
        );

        // CHECK 10 SEC PREVIEW
        previewVideo.addEventListener(
            'timeupdate',
            checkVideoTime
        );

    });

});


function countVideoView(){

    // ONLY AFTER 5 SECOND WATCH
    if(previewVideo.currentTime >= 5){

        // REMOVE EVENT SO MULTIPLE TIMES NOT COUNT
        previewVideo.removeEventListener(
            'timeupdate',
            countVideoView
        );

        // API CALL
        fetch('/watch-video/' + countedVideo)

        .then(response => response.json())

        .then(data => {

            console.log('View Count Updated');

        })

        .catch(error => {

            console.log(error);

        });

    }

}


function checkVideoTime(){

    if(previewVideo.currentTime >= 10){

        previewVideo.pause();

        modal.style.display = 'none';

        localStorage.setItem(
            'preview_watched',
            'yes'
        );

        alert(
            'Please Subscribe To Watch Full Video'
        );

        @if(session()->has('user_id'))

            window.location.href =
                "{{ route('subscription') }}";

        @else

            window.location.href =
                "{{ route('user_login') }}";

        @endif

    }

}


closeBtn.onclick = function(){

    modal.style.display = 'none';

    previewVideo.pause();

}

window.onclick = function(event){

    if(event.target == modal){

        modal.style.display = 'none';

        previewVideo.pause();

    }

}

</script>
</body>
</html>
