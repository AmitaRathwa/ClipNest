<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Lugx Gaming - Shop Page</title>
    @include('users.include.user_header_link')

<style>
     .watch-btn{
            border:none;
            background:#ee626b;
            color:#fff;
            padding:10px 20px;
            border-radius:25px;
        }

        .video-modal{
            display:none;
            position:fixed;
            left:0;
            top:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.8);
            z-index:99999;
        }

        .video-box{
            width:70%;
            margin:5% auto;
            background:#fff;
            padding:20px;
            border-radius:15px;
            position:relative;
        }

        .video-box video{
            width:100%;
            border-radius:10px;
        }

        .close-btn{
            position:absolute;
            top:5px;
            right:15px;
            font-size:35px;
            cursor:pointer;
            color:#000;
        }

    </style>

    <!--

TemplateMo 589 lugx gaming

https://templatemo.com/tm-589-lugx-gaming

-->
</head>

<body>


    @include('users.include.user_header')
    <!-- ***** Header Area End ***** -->

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Video Category</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > Our categories</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">

            <ul class="trending-filter">

                <li>
                    <a class="{{ request()->segment(1) == 'shop' ? 'is_active' : '' }}" href="{{ route('categories') }}">
                        Show All
                    </a>
                </li>

                @foreach($categories as $category)

                <li>

                    <a href="{{ route('category.videos',$category->cat_id) }}">

                        {{ $category->category_name }}

                    </a>

                </li>

                @endforeach

            </ul>

            <div class="row trending-box">

                @foreach($videos as $video)

                <div class="col-lg-3 col-md-6 mb-4">

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

                            <button class="watch-btn" data-id="{{ $video->movie_id }}" data-video="{{ asset('uploads/videos/'.$video->video) }}">
                                Watch Now
                            </button>

                        </div>

                    </div>

                </div>

                @endforeach
            </div>

<!-- VIDEO MODAL -->

<div id="videoModal" class="video-modal">

    <div class="video-box">

        <span class="close-btn">&times;</span>

        <video id="previewVideo" width="100%" controls autoplay>

            <source src="" type="video/mp4">

        </video>

    </div>

</div>
                @include('users.include.user_footer_link')

                <script>
                    let modal = document.getElementById('videoModal');

                    let previewVideo = document.getElementById('previewVideo');

                    let closeBtn = document.querySelector('.close-btn');

                    let countedVideo = null;



                    document.querySelectorAll('.watch-btn').forEach(button => {

                        button.addEventListener('click', function() {

                            let videoUrl = this.getAttribute('data-video');

                            let videoId = this.getAttribute('data-id');

                            countedVideo = videoId;

                            // SET VIDEO
                            previewVideo.querySelector('source').src = videoUrl;

                            previewVideo.load();

                            // SHOW MODAL
                            modal.style.display = 'block';

                            // PLAY VIDEO
                            previewVideo.play();



                            @if($activePlan)

                            previewVideo.addEventListener(
                                'timeupdate'
                                , countVideoView
                            );

                            return;

                            @endif


                            let alreadyWatched =
                                localStorage.getItem('preview_watched');

                            if (alreadyWatched == 'yes') {

                                @if(session()->has('user_id'))

                                window.location.href =
                                    "{{ route('subscription') }}";

                                @else

                                window.location.href =
                                    "{{ route('user_login') }}";

                                @endif

                                return;
                            }

                            previewVideo.addEventListener(
                                'timeupdate'
                                , countVideoView
                            );

                            previewVideo.addEventListener(
                                'timeupdate'
                                , checkVideoTime
                            );

                        });

                    });

                    function countVideoView() {

                        if (previewVideo.currentTime >= 5) {

                            previewVideo.removeEventListener(
                                'timeupdate'
                                , countVideoView
                            );

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

                    function checkVideoTime() {

                        if (previewVideo.currentTime >= 10) {

                            previewVideo.pause();

                            modal.style.display = 'none';

                            localStorage.setItem(
                                'preview_watched'
                                , 'yes'
                            );

                            alert(
                                'Please Subscribe To Watch Full Video'
                            );

                            @if(session() -> has('user_id'))

                            window.location.href =
                                "{{ route('subscription') }}";

                            @else

                            window.location.href =
                                "{{ route('user_login') }}";

                            @endif

                        }

                    }


                    closeBtn.onclick = function() {

                        modal.style.display = 'none';

                        previewVideo.pause();

                    }

                    window.onclick = function(event) {

                        if (event.target == modal) {

                            modal.style.display = 'none';

                            previewVideo.pause();

                        }

                    }

                </script>
</body>
</html>
