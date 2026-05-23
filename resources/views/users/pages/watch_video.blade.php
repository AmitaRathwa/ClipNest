{{-- @extends('layouts.app') <!-- or your main layout --> --}}

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <h2 class="mb-3 text-center">{{ $video->title }}</h2>

      <div class="mb-4">
        <video width="100%" height="auto" controls>
          <source src="{{ asset('dist/upload_videos/' . $video->video_file) }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>

      <p class="text-gray-700">{{ $video->description }}</p>

      <a href="{{ route('user_homepage') }}" class="btn btn-secondary mt-3">← Back to Dashboard</a>

    </div>
  </div>
</div>
@endsection
