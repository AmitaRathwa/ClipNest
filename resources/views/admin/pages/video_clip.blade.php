<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Movie Category Management</title>

    @include('admin.includes.header_link')

    <style>

        body {
            overflow-x: hidden;
        }

        table.dataTable {
            width: 100% !important;
        }

    </style>

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    @include('admin.includes.admin_sidebar')

    <!-- Main Content -->
    <div class="flex-1 xl:ml-72 p-6">

        <!-- Top Navbar -->
        <div class="bg-white shadow rounded-2xl p-5 flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold text-gray-700">
                    Movie Category Management
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Manage movie categories easily
                </p>

            </div>

           <a href="{{ route('logout') }}"
   class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg">
    Logout
</a>

        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow mt-6 p-6">

            <!-- Tabs -->
            <div class="flex border-b mb-6">

                <button
                    class="tab-btn text-fuchsia-600 border-b-2 border-fuchsia-600 px-5 py-3 font-semibold"
                    data-tab="list-tab">

                    Category List

                </button>

                <button
                    class="tab-btn text-gray-600 px-5 py-3 font-semibold"
                    data-tab="add-tab">

                    Add New Movie

                </button>

            </div>

            <!-- Category List -->
            <div id="list-tab" class="tab-content">

                <div class="overflow-x-auto">

                    <table id="cliptbl" class="display w-full">

                        <thead>

                        <tr>

                            <th>Sr.No</th>
                            <th>Category type</th>
                            <th>Movie name</th>
                            <th>Thumbneil</th>
                            <th>video clip link</th>
                            <th>action</th>

                        </tr>

                        </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>

            <!-- Add Category -->
            <div id="add-tab" class="tab-content hidden">
<form id="addmovie" class="space-y-5" enctype="multipart/form-data">

    @csrf
<input type="hidden" id="movie_id" name="movie_id">
    <!-- Movie Type Dropdown -->
    <div>

        <label class="block text-sm font-semibold mb-2 text-gray-700">
            Movie Type
        </label>

        <select
            id="category_id"
            name="category_id"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

            <option value="">Select Movie Type</option>

            @foreach($categories as $category)
                <option value="{{ $category->cat_id }}">
                    {{ $category->category_name }}
                </option>
            @endforeach

        </select>

    </div>

    <!-- Movie Name -->
    <div>

        <label class="block text-sm font-semibold mb-2 text-gray-700">
            Movie Name
        </label>

        <input
            type="text"
            placeholder="Enter movie name"
            id="movie_name"
            name="movie_name"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

    </div>

    <!-- Thumbnail -->
    <div>

        <label class="block text-sm font-semibold mb-2 text-gray-700">
            Thumbnail
        </label>

        <input
            type="file"
            id="thumbnail"
            name="thumbnail"
            accept="image/*"
            class="w-full border border-gray-300 rounded-lg px-4 py-3">
<div id="oldThumbnailPreview" class="mt-2"></div>
    </div>

    <!-- Video -->
    <div>

        <label class="block text-sm font-semibold mb-2 text-gray-700">
            Video File
        </label>

        <input
            type="file"
            id="video"
            name="video"
            accept="video/*"
            class="w-full border border-gray-300 rounded-lg px-4 py-3">
<div id="oldVideoPreview" class="mt-2"></div>
    </div>

    <!-- Submit -->
    <div>

        <button
            type="submit"  id="submitBtn"
            class="bg-fuchsia-500 hover:bg-fuchsia-600 text-white px-6 py-3 rounded-lg font-semibold">

            Save Movie

        </button>

    </div>

</form>

                <div id="successMsg" class="text-green-600 mt-3"></div>

            </div>

        </div>

    </div>

</div>

@include('admin.includes.admin_footer_links')



<script>

$(document).ready(function () {

    // Tabs
    $('.tab-btn').click(function () {

        let tab = $(this).data('tab');

        // Hide all tab contents
        $('.tab-content').addClass('hidden');

        // Show selected tab
        $('#' + tab).removeClass('hidden');

        // Reset all tab button styles
        $('.tab-btn')
            .removeClass('text-fuchsia-600 border-b-2 border-fuchsia-600')
            .addClass('text-gray-600');

        // Active tab button style
        $(this)
            .removeClass('text-gray-600')
            .addClass('text-fuchsia-600 border-b-2 border-fuchsia-600');

    });

});

</script>
<script>

$(document).ready(function () {



    let table = $('#cliptbl').DataTable({

        processing: true,
        serverSide: true,

        ajax: {
            url: "{{ route('video_fetch') }}",
            type: "GET"
        },

        columns: [

            { data: 'sr_no', name: 'sr_no' },

            { data: 'category_name', name: 'category_name' },

            { data: 'movie_name', name: 'movie_name' },

            { data: 'thumbnail', name: 'thumbnail', orderable: false, searchable: false },

            { data: 'video_link', name: 'video_link', orderable: false, searchable: false },

            { data: 'actions', name: 'actions', orderable: false, searchable: false }

        ]

    });



    $(document).on('click', '.editBtn', function () {

        let id = $(this).data('id');

        let category = $(this).data('category');

        let name = $(this).data('name');

        let thumbnail = $(this).data('thumbnail');

        let video = $(this).data('video');

        // Open Add Tab
        $('.tab-content').addClass('hidden');

        $('#add-tab').removeClass('hidden');

        // Active Tab
        $('.tab-btn')
            .removeClass('text-fuchsia-600 border-b-2 border-fuchsia-600')
            .addClass('text-gray-600');

        $('[data-tab="add-tab"]')
            .removeClass('text-gray-600')
            .addClass('text-fuchsia-600 border-b-2 border-fuchsia-600');

        // Fill Form
        $('#movie_id').val(id);

        $('#category_id').val(category);

        $('#movie_name').val(name);

        // Thumbnail Preview
        $('#oldThumbnailPreview').html(`
            <img src="/uploads/thumbnails/${thumbnail}"
                 width="120"
                 class="rounded border">
        `);

        // Video Preview
        $('#oldVideoPreview').html(`
            <video width="250" controls class="rounded border">
                <source src="/uploads/videos/${video}" type="video/mp4">
            </video>
        `);

        // Button Text
        $('#submitBtn').text('Update Movie');

    });


   

    $('#addmovie').submit(function (e) {

        e.preventDefault();

        let formData = new FormData(this);

        let movie_id = $('#movie_id').val();

        let url = movie_id
            ? "/update_video/" + movie_id
            : "{{ route('store_video') }}";

        $.ajax({

            url: url,

            type: "POST",

            data: formData,

            processData: false,

            contentType: false,

            success: function (response) {

                iziToast.success({
                    title: 'Success',
                    message: response.message,
                    position: 'topRight'
                });

                // Reset Form
                $('#addmovie')[0].reset();

                $('#movie_id').val('');

                $('#submitBtn').text('Save Movie');

                // Remove Preview
                $('#oldThumbnailPreview').html('');

                $('#oldVideoPreview').html('');

                // Reload Table
                table.ajax.reload();

                // Redirect to List Tab
                $('.tab-content').addClass('hidden');

                $('#list-tab').removeClass('hidden');

                // Active Tab
                $('.tab-btn')
                    .removeClass('text-fuchsia-600 border-b-2 border-fuchsia-600')
                    .addClass('text-gray-600');

                $('[data-tab="list-tab"]')
                    .removeClass('text-gray-600')
                    .addClass('text-fuchsia-600 border-b-2 border-fuchsia-600');

            },

            error: function (xhr) {

                if (xhr.responseJSON.errors) {

                    $.each(xhr.responseJSON.errors, function (key, value) {

                        iziToast.error({
                            title: 'Error',
                            message: value[0],
                            position: 'topRight'
                        });

                    });

                } else {

                    iziToast.error({
                        title: 'Error',
                        message: 'Something went wrong!',
                        position: 'topRight'
                    });

                }
            }

        });

    });






});

</script>
<script>

$(document).on('click', '.deleteBtn', function () {

    let id = $(this).data('id');

    iziToast.question({

        timeout: 20000,

        close: false,

        overlay: true,

        displayMode: 'once',

        id: 'delete-question',

        zindex: 999,

        title: 'Confirm',

        message: 'Are you sure you want to delete this movie?',

        position: 'center',

        buttons: [

            ['<button><b>YES</b></button>', function (instance, toast) {

                $.ajax({

                    url: '/delete_video/' + id,

                    type: 'POST',

                    data: {
                        _token: '{{ csrf_token() }}'
                    },

                    success: function (response) {

                        if (response.success) {

                            iziToast.success({

                                title: 'Success',

                                message: response.message,

                                position: 'topRight'

                            });

                            // Reload DataTable
                            $('#cliptbl').DataTable().ajax.reload();

                        } else {

                            iziToast.error({

                                title: 'Error',

                                message: response.message,

                                position: 'topRight'

                            });

                        }

                    }

                });

                instance.hide({

                    transitionOut: 'fadeOut'

                }, toast);

            }, true],

            ['<button>NO</button>', function (instance, toast) {

                instance.hide({

                    transitionOut: 'fadeOut'

                }, toast);

            }]

        ]

    });

});

</script>

{{-- <script>
$(document).ready(function () {

    $('#addmovie').submit(function (e) {

        e.preventDefault();

        let formData = new FormData(this);
let movie_id = $('#movie_id').val();

let url = movie_id
    ? '/update_video/' + movie_id
    : "{{ route('store_video') }}";

    $.ajax({
            // url: "{{ route('store_video') }}",
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {

                iziToast.success({
                    title: 'Success',
                    message: response.message,
                    position: 'topRight'
                });

                $('#addmovie')[0].reset();
            },

            error: function (xhr) {

                // Validation Errors
                if (xhr.responseJSON.errors) {

                    $.each(xhr.responseJSON.errors, function (key, value) {

                        iziToast.error({
                            title: 'Error',
                            message: value[0],
                            position: 'topRight'
                        });

                    });

                } else {

                    iziToast.error({
                        title: 'Error',
                        message: 'Something went wrong!',
                        position: 'topRight'
                    });

                }
            }
        });

    });

});
$('#cliptbl').DataTable({

    processing: true,
    serverSide: true,

    ajax: {
        url: "{{ route('video_fetch') }}",
        type: "GET"
    },

    columns: [

        { data: 'sr_no', name: 'sr_no' },

        { data: 'category_name', name: 'category_name' },

        { data: 'movie_name', name: 'movie_name' },

        { data: 'thumbnail', name: 'thumbnail', orderable: false, searchable: false },

        { data: 'video_link', name: 'video_link', orderable: false, searchable: false },

        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ]
});

$(document).on('click', '.editBtn', function () {

    let id = $(this).data('id');
    let category = $(this).data('category');
    let name = $(this).data('name');
    let thumbnail = $(this).data('thumbnail');
    let video = $(this).data('video');

    // Open form tab
    $('.tab-content').addClass('hidden');
    $('#add-tab').removeClass('hidden');

    // Active tab
    $('.tab-btn')
        .removeClass('text-fuchsia-600 border-b-2 border-fuchsia-600')
        .addClass('text-gray-600');

    $('[data-tab="add-tab"]')
        .removeClass('text-gray-600')
        .addClass('text-fuchsia-600 border-b-2 border-fuchsia-600');

    // Fill Values
    $('#movie_id').val(id);

    $('#category_id').val(category);

    $('#movie_name').val(name);

    // Thumbnail Preview
    $('#oldThumbnailPreview').html(`
        <img src="/uploads/thumbnails/${thumbnail}"
             width="120"
             class="rounded border">
    `);

    // Video Preview
    $('#oldVideoPreview').html(`
        <video width="250" controls class="rounded border">
            <source src="/uploads/videos/${video}" type="video/mp4">
        </video>
    `);

    // Change Button Text
    $('#submitBtn').text('Update Movie');

});

</script> --}}

</body>
</html>
