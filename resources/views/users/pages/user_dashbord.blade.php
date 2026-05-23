<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Lugx Gaming Shop HTML5 Template</title>
    @include('users.include.user_header_link')

    <style>
        .watch-btn{
            border:none;
            background:#ee626b;
            color:#fff;
            padding:10px 20px;
            border-radius:25px;
        }

        .video-modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
        }

        .video-box {
            width: 70%;
            margin: 5% auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
        }
    </style>
    <!--

TemplateMo 589 lugx gaming

https://templatemo.com/tm-589-lugx-gaming

-->
</head>

<body>


    @include('users.include.user_header')


    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">

                    <div class="caption header-text">

                        <h6>
                            Unlimited Entertainment
                        </h6>

                        <h2>
                            WATCH MOVIES, VIDEOS
                        </h2>

                        <p>
                            Stream the latest movies,
                            , trending web series, action videos,
                            comedy shows and premium entertainment anytime anywhere.
                            Enjoy HD quality streaming with unlimited access.
                        </p>

                        <div class="search-input">

                            <form id="search" action="{{ route('categories') }}">

                                {{-- <input type="text" placeholder="Search Movies, Series, Categories..."
                                    id="searchText" name="search" />

                                <button role="button">

                                    Search Now

                                </button> --}}

                            </form>

                        </div>

                    </div>

                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="right-image">
                        <img src="{{ $actual_url.'/user/images/mv.jpg' }}" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="section trending">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Trending</h6>
                        <h2>Trending Videos</h2>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="shop.html">View All</a>
                    </div>
                </div>

                <div class="row">

                    @foreach($videos as $video)

                    <div class="col-lg-3 col-md-6 mb-4">

                        <div class="item shadow rounded-lg overflow-hidden">

                            <div class="thumb relative">

                                <a href="{{ asset('uploads/videos/'.$video->video) }}" target="_blank">

                                    <img src="{{ asset('uploads/thumbnails/'.$video->thumbnail) }}"
                                        alt="{{ $video->movie_name }}" class="w-full h-48 object-cover rounded-lg">

                                </a>

                            </div>

                            <div class="down-content p-3">

                                <h4 class="text-lg font-semibold mt-1">
                                    {{ $video->movie_name }}
                                </h4>

                                <p class="text-gray-600 text-sm mt-1 line-clamp-2">
                                    {{ $video->category_name }}
                                </p>

                                {{-- <a href="{{ asset('uploads/videos/'.$video->video) }}" target="_blank">
                                    Watch Now
                                </a> --}}
                                <button class="watch-btn" data-id="{{ $video->movie_id }}"
                                    data-video="{{ asset('uploads/videos/'.$video->video) }}">
                                    Watch Now
                                </button>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>
        </div>
    </div>


    </div>
    </div>
    </div>

    <div class="section most-played">

        <div class="container">

            <div class="row">

                <div class="col-lg-6">

                    <div class="section-heading">

                        <h6>TOP VIDEOS</h6>

                        <h2>Most Played</h2>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="main-button">

                        <a href="{{ route('categories') }}">
                            View All
                        </a>

                    </div>

                </div>

                @foreach($mostPlayed as $video)

                <div class="col-lg-2 col-md-6 col-sm-6">

                    <div class="item">

                        <div class="thumb">

                            <img src="{{ asset('uploads/thumbnails/'.$video->thumbnail) }}" alt="">

                        </div>

                        <div class="down-content">

                            <span class="category">

                                {{ $video->categoryData->category_name ?? '' }}

                            </span>

                            <h4>

                                {{ $video->movie_name }}

                            </h4>

                            <small>

                                {{ $video->views }} Views

                            </small>

                            <br>

                            <button class="watch-btn mt-2" data-id="{{ $video->movie_id }}"
                                data-video="{{ asset('uploads/videos/'.$video->video) }}">
                                Watch
                            </button>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>

    <div class="section categories">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 text-center">

                <div class="section-heading">

                    <h6>Categories</h6>

                    <h2>Top Categories</h2>

                </div>

            </div>


            @foreach($topCategories as $category)

            <div class="col-lg col-sm-6 col-xs-12 mb-4">

                <div class="item">

                    <h4>

                        {{ $category->category_name }}

                    </h4>

                    <div class="thumb">

                        <a href="{{ route('category.videos',$category->cat_id) }}">

                            <img
                                src="{{ asset('uploads/thumbnails/'.$category->latest_thumbnail) }}"
                                alt="{{ $category->category_name }}"
                                style="
                                    height:220px;
                                    object-fit:cover;
                                    width:100%;
                                    border-radius:15px;
                                "
                            >

                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>




    <!-- Video Modal -->

    <div id="videoModal" class="video-modal">

        <div class="video-box">

            <span class="close-btn">&times;</span>

            <video id="previewVideo" width="100%" controls autoplay>
                <source src="" type="video/mp4">
            </video>

        </div>

    </div>

    <footer>
        <div class="container">
            <div class="col-lg-12">
                <p>Copyright © 2048 LUGX Gaming Company. All rights reserved. &nbsp;&nbsp; <a rel="nofollow"
                        href="https://templatemo.com" target="_blank">Design: TemplateMo</a></p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->


    @include('users.include.user_footer_link')
    
    <script>

let modal = document.getElementById('videoModal');

let previewVideo = document.getElementById('previewVideo');

let closeBtn = document.querySelector('.close-btn');


// WATCH BUTTON CLICK

document.querySelectorAll('.watch-btn').forEach(button => {

    button.addEventListener('click', function () {

        let videoUrl = this.getAttribute('data-video');

        let videoId = this.getAttribute('data-id');



        // ADD VIEW COUNT

        fetch('/watch-video/' + videoId)
        .then(response => response.json())
        .then(data => {

            console.log('View Added');

            console.log(data);

        })
        .catch(error => {

            console.log('Error:', error);

        });



        @if($activePlan)

            // SUBSCRIBED USER

            previewVideo.src = videoUrl;

            modal.style.display = 'block';

            previewVideo.load();

            previewVideo.play();

        @else

            // NON SUBSCRIBED USER

            let alreadyWatched =
                localStorage.getItem('preview_watched');


            // IF ALREADY USED FREE PREVIEW

            if(alreadyWatched == 'yes'){

                alert('Please Login Or Buy Subscription');


                @if(session()->has('user_id'))

                    window.location.href =
                        "{{ route('subscription') }}";

                @else

                    window.location.href =
                        "{{ route('user_login') }}";

                @endif

                return;

            }


            // START FREE PREVIEW

            previewVideo.src = videoUrl;

            modal.style.display = 'block';

            previewVideo.load();

            previewVideo.play();


            // REMOVE OLD EVENT

            previewVideo.removeEventListener(
                'timeupdate',
                checkVideoTime
            );


            // ADD EVENT AGAIN

            previewVideo.addEventListener(
                'timeupdate',
                checkVideoTime
            );

        @endif

    });

});




// FREE PREVIEW LIMIT

function checkVideoTime(){

    if(previewVideo.currentTime >= 10){

        previewVideo.pause();

        modal.style.display = 'none';


        // SAVE PREVIEW USED

        localStorage.setItem(
            'preview_watched',
            'yes'
        );


        alert(
            'Free Preview Finished'
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




// CLOSE BUTTON

closeBtn.onclick = function(){

    modal.style.display = 'none';

    previewVideo.pause();

}




// CLICK OUTSIDE MODAL

window.onclick = function(event){

    if(event.target == modal){

        modal.style.display = 'none';

        previewVideo.pause();

    }

}

</script></body>

</html>
