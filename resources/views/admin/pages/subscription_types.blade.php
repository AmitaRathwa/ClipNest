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
                        subcription plan
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Manage plans categories easily
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

                    <button class="tab-btn text-fuchsia-600 border-b-2 border-fuchsia-600 px-5 py-3 font-semibold"
                        data-tab="list-tab">

                        Subscription plan List

                    </button>

                    <button class="tab-btn text-gray-600 px-5 py-3 font-semibold" data-tab="add-tab">

                        Add subscription plan

                    </button>

                </div>

                <!-- Category List -->
                <div id="list-tab" class="tab-content">

                    <div class="overflow-x-auto">

                        <table id="subscriptiontbl" class="display w-full">

                            <thead>
                                <tr>

                                    <th>Sr.No</th>
                                    <th>Subscription Plan</th>
                                    <th>Months</th>
                                    <th>Price</th>
                                    <th>Discount</th>
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

                    <form id="subscription" class="space-y-5">

                        @csrf
                <input type="hidden" id="sub_id" name="sub_id">
                        <!-- Subscription Plan -->
                        <div>

                            <label class="block text-sm font-semibold mb-2 text-gray-700">

                                Subscription Plan

                            </label>

                            <input type="text" placeholder="Enter subscription plan name" id="sub_plan" name="sub_plan"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                        </div>

                        <!-- Duration -->
                        <div>

                            <label class="block text-sm font-semibold mb-2 text-gray-700">

                                Duration (Months)

                            </label>

                            <input type="number" placeholder="Enter number of months" id="months" name="months" min="1"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                        </div>

                        <!-- Price -->
                        <div>

                            <label class="block text-sm font-semibold mb-2 text-gray-700">

                                Price (₹)

                            </label>

                            <input type="number" placeholder="Enter subscription price" id="price" name="price" min="0"
                                step="0.01"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                        </div>

                        <!-- Discount -->
                        <div>

                            <label class="block text-sm font-semibold mb-2 text-gray-700">

                                Discount (%)

                            </label>

                            <input type="number" placeholder="Optional discount percentage" id="discount"
                                name="discount" min="0" max="100" value="0"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                        </div>

                        <!-- Plan Description -->
                        <div>

                            <label class="block text-sm font-semibold mb-2 text-gray-700">

                                Plan Description

                            </label>

                            <textarea id="description" name="description" rows="4"
                                placeholder="Enter plan benefits and details"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none"></textarea>

                        </div>



                        <!-- Status -->
                        <div>

                            <label class="block text-sm font-semibold mb-2 text-gray-700">

                                Plan Status

                            </label>

                            <select id="plan_status" name="plan_status"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                                <option value="0">Active</option>

                                <option value="1">Inactive</option>

                            </select>

                        </div>

                        <!-- Submit Button -->
                        <div>

                            <button type="submit" id="submitBtn"
                                class="bg-fuchsia-500 hover:bg-fuchsia-600 text-white px-6 py-3 rounded-lg font-semibold">

                                Save Subscription Plan

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


    $('#subscriptiontbl').DataTable({

        processing: true,

        serverSide: true,

        ajax: {
            url: "{{ route('subscription_fetch') }}",
            type: "GET"
        },

        columns: [

            { data: 'sr_no', name: 'sr_no' },

            { data: 'sub_plan', name: 'sub_plan' },

            { data: 'months', name: 'months' },

            { data: 'price', name: 'price' },

            { data: 'discount', name: 'discount' },

            { data: 'plan_status', name: 'plan_status', orderable: false, searchable: false },

            { data: 'actions', name: 'actions', orderable: false, searchable: false }

        ]

    });


   
   $('#subscription').submit(function(e){

    e.preventDefault();

    let sub_id = $('#sub_id').val();

    let url = sub_id
    ? "/update_subscription/" + sub_id
    : "{{ route('store_subscription') }}";
    $.ajax({

        url: url,

        type: "POST",

        data: $(this).serialize(),

        success: function(response){

            iziToast.success({

                title: 'Success',

                message: response.message,

                position: 'topRight'

            });

            // Reset Form
            $('#subscription')[0].reset();

            $('#sub_id').val('');

            // Reset Button
            $('#submitBtn').text('Save Subscription Plan');

            // Reload Table
            $('#subscriptiontbl').DataTable().ajax.reload();

            // Open List Tab
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

        error: function(xhr){

            if(xhr.responseJSON.errors){

                $.each(xhr.responseJSON.errors, function(key, value){

                    iziToast.error({

                        title: 'Error',

                        message: value[0],

                        position: 'topRight'

                    });

                });

            }

        }

    });

});

});

</script>
<script>

$(document).on('click', '.editBtn', function () {

    let id = $(this).data('id');

    let plan = $(this).data('plan');

    let months = $(this).data('months');

    let price = $(this).data('price');

    let discount = $(this).data('discount');

    let description = $(this).data('description');

    let status = $(this).data('status');

    // Open Form Tab
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
    $('#sub_id').val(id);

    $('#sub_plan').val(plan);

    $('#months').val(months);

    $('#price').val(price);

    $('#discount').val(discount);

    $('#description').val(description);

    $('#plan_status').val(status);

    // Change Button Text
    $('#submitBtn').text('Update Subscription');

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

        id: 'question',

        zindex: 999,

        title: 'Confirm',

        message: 'Are you sure you want to delete this subscription plan?',

        position: 'center',

        buttons: [

            ['<button><b>YES</b></button>', function (instance, toast) {

                $.ajax({

                    url: "/delete_subscription/" + id,

                    type: "POST",

                    data: {

                        _token: "{{ csrf_token() }}"

                    },

                    success: function(response){

                        if(response.success){

                            iziToast.success({

                                title: 'Success',

                                message: response.message,

                                position: 'topRight'

                            });

                            // Reload Table
                            $('#subscriptiontbl').DataTable().ajax.reload();

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
</body>

</html>
