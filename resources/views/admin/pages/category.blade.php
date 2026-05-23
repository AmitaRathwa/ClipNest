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

                    Add Category

                </button>

            </div>

            <!-- Category List -->
            <div id="list-tab" class="tab-content">

                <div class="overflow-x-auto">

                    <table id="categoryTable" class="display w-full">

                        <thead>

                        <tr>

                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>

                        </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>

            <!-- Add Category -->
            <div id="add-tab" class="tab-content hidden">

                <form id="categoryForm" class="space-y-5">

                    @csrf

                    <!-- Hidden ID -->
                    <input type="hidden" id="cat_id" name="cat_id">

                    <div>

                        <label
                            class="block text-sm font-semibold mb-2 text-gray-700">

                            Category Name

                        </label>

                        <input
                            type="text"
                            placeholder="Enter category name"
                            id="category_name"
                            name="category_name"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                    </div>

                    <div>

                        <button
                            type="submit"
                            class="bg-fuchsia-500 hover:bg-fuchsia-600 text-white px-6 py-3 rounded-lg font-semibold">

                            Save Category

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
function deleteCategory(id) {
    iziToast.question({
        timeout: 20000,
        close: false,
        overlay: true,
        displayMode: 'once',
        title: 'Confirm',
        message: 'Are you sure you want to delete this category?',
        position: 'center',
        buttons: [
            ['<button>Yes</button>', function (instance, toast) {
                $.ajax({
                    url: '/category/delete/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status) {
                            iziToast.success({
                                title: 'Success',
                                message: response.message
                            });

                            // reload table or fetch data again
                            fetchCategories();
                        } else {
                            iziToast.error({
                                title: 'Error',
                                message: response.message
                            });
                        }
                    }
                });

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }, true],

            ['<button>Cancel</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }]
        ]
    });
}
</script>
<script>

$(document).ready(function () {

  //  Initialize DataTable
    var table = $('#categoryTable').DataTable({
       responsive: true
   });

    // Load Categories
    loadCategories();

    // Fetch Categories
    function loadCategories() {

        $.ajax({

            url: "{{ route('category_fetch') }}",
            type: "GET",

            success: function (response) {

                table.clear();

response.data.forEach(function (item, index) {

    table.row.add([

        index + 1, // Sr.No

        item.category_name,

        `
        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
            Active
        </span>
        `,

        `
        <div class="flex gap-2">

            <button
                class="editBtn bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded"
                data-id="${item.cat_id}"
                data-name="${item.category_name}">
                Edit
            </button>

            <button onclick="deleteCategory(${item.cat_id})"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                Delete
            </button>

        </div>
        `
    ]);

});

                table.draw();

            }

        });

    }

 // Store & Update Category
$('#categoryForm').submit(function (e) {

    e.preventDefault();

    let cat_id = $('#cat_id').val();

    let url = '';

    // Check Insert or Update
    if (cat_id == '') {

        // INSERT
        url = "{{ route('category_store') }}";

    } else {

        // UPDATE
        url = "/category/update/" + cat_id;

    }

    $.ajax({

        url: url,
        type: "POST",

        data: {
            category_name: $('#category_name').val(),
            _token: "{{ csrf_token() }}"
        },

        success: function (response) {

            iziToast.success({
                title: 'Success',
                message: response.message
            });

            // Reset form
            $('#categoryForm')[0].reset();

            $('#cat_id').val('');

            // Reload table
            loadCategories();

            // Switch to list tab
            $('.tab-content').addClass('hidden');

            $('#list-tab').removeClass('hidden');

            // Active tab
            $('.tab-btn')
                .removeClass('text-fuchsia-600 border-b-2 border-fuchsia-600')
                .addClass('text-gray-600');

            $('[data-tab="list-tab"]')
                .removeClass('text-gray-600')
                .addClass('text-fuchsia-600 border-b-2 border-fuchsia-600');

        },

        error: function (xhr) {

            console.log(xhr.responseText);

            iziToast.error({
                title: 'Error',
                message: 'Something went wrong'
            });

        }

    });

});
    // Edit Button Click
    $(document).on('click', '.editBtn', function () {

        let id = $(this).data('id');
        let name = $(this).data('name');

        // Fill old data
        $('#cat_id').val(id);
        $('#category_name').val(name);

        // Open form tab
        $('.tab-content').addClass('hidden');
        $('#add-tab').removeClass('hidden');

        // Active tab button
        $('.tab-btn')
            .removeClass('text-fuchsia-600 border-b-2 border-fuchsia-600')
            .addClass('text-gray-600');

        $('[data-tab="add-tab"]')
            .removeClass('text-gray-600')
            .addClass('text-fuchsia-600 border-b-2 border-fuchsia-600');

    });

    // Tabs
    $('.tab-btn').click(function () {

        let tab = $(this).data('tab');

        $('.tab-content').addClass('hidden');

        $('#' + tab).removeClass('hidden');

        $('.tab-btn')
            .removeClass('text-fuchsia-600 border-b-2 border-fuchsia-600')
            .addClass('text-gray-600');

        $(this)
            .removeClass('text-gray-600')
            .addClass('text-fuchsia-600 border-b-2 border-fuchsia-600');

    });

});

</script>

</body>
</html>
