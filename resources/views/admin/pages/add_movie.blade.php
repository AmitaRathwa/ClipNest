<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New Movie</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- DataTables -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

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
                        Add New Videos
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Manage videos  easily
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

                            <tbody>

                                <tr>

                                    <td>1</td>

                                    <td>Action</td>

                                    <td>

                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">

                                            Active

                                        </span>

                                    </td>

                                    <td class="space-x-2">

                                        <button
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">

                                            Edit

                                        </button>

                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                                            Delete

                                        </button>

                                    </td>

                                </tr>

                                <tr>

                                    <td>2</td>

                                    <td>Comedy</td>

                                    <td>

                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">

                                            Active

                                        </span>

                                    </td>

                                    <td class="space-x-2">

                                        <button
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">

                                            Edit

                                        </button>

                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                                            Delete

                                        </button>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

                <!-- Add Category -->
                <div id="add-tab" class="tab-content hidden">

                    <form class="space-y-5">

                        <div>

                            <label
                                class="block text-sm font-semibold mb-2 text-gray-700">

                                Category Name

                            </label>

                            <input
                                type="text"
                                placeholder="Enter category name"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-fuchsia-400 outline-none">

                        </div>

                        <div>

                            <button
                                type="button"
                                class="bg-fuchsia-500 hover:bg-fuchsia-600 text-white px-6 py-3 rounded-lg font-semibold">

                                Save Category

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>

        // DataTable
        $(document).ready(function () {

            $('#categoryTable').DataTable({
                responsive: true
            });

        });

        // Tabs
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {

            button.addEventListener('click', () => {

                // Remove active style
                tabButtons.forEach(btn => {

                    btn.classList.remove(
                        'text-fuchsia-600',
                        'border-b-2',
                        'border-fuchsia-600'
                    );

                    btn.classList.add('text-gray-600');

                });

                // Hide all tabs
                tabContents.forEach(content => {

                    content.classList.add('hidden');

                });

                // Add active style
                button.classList.remove('text-gray-600');

                button.classList.add(
                    'text-fuchsia-600',
                    'border-b-2',
                    'border-fuchsia-600'
                );

                // Show selected tab
                document
                    .getElementById(button.dataset.tab)
                    .classList.remove('hidden');

            });

        });

    </script>

</body>

</html>
