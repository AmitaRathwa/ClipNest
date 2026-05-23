<aside
    class="fixed inset-y-0 left-0 z-50 w-72 bg-white shadow-xl rounded-r-2xl overflow-y-auto">

    <!-- Logo -->
    <div class="px-6 py-5 border-b">

        <a href="#" class="flex items-center space-x-3">

            {{-- <img
                src="./assets/img/logo-ct.png"
                class="w-10 h-10"
                alt="main_logo" /> --}}

            <span class="text-xl font-bold text-gray-700">
               🎬 ClipNest
            </span>

        </a>

    </div>

    <!-- Menu -->
    <div class="py-4">

        <ul class="space-y-2">

            <!-- Dashboard -->
            <li>

                <a
                    href="#"
                    class="flex items-center mx-4 px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg">

                    <div class="mr-3">
                        <i class="fas fa-home"></i>
                    </div>

                    <span class="font-medium">
                        Dashboard
                    </span>

                </a>

            </li>

            <!-- Tables -->
            <li>

                <a
                    href="{{ route('add_subcription') }}"
                    class="flex items-center mx-4 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-100 transition">

                    <div class="mr-3">
                        <i class="fas fa-table"></i>
                    </div>

                    <span>
                        Subscribe Plans
                    </span>

                </a>

            </li>

            <!-- Billing -->
            <li>

                <a
                    href="{{ route("addcategory") }}"
                    class="flex items-center mx-4 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-100 transition">

                    <div class="mr-3">
                        <i class="fas fa-credit-card"></i>
                    </div>

                    <span>
                        Add Movie Category
                    </span>

                </a>

            </li>

            <!-- Virtual Reality -->
            <li>

                <a
                    href="{{ route("add_video") }}"
                    class="flex items-center mx-4 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-100 transition">

                    <div class="mr-3">
                        <i class="fas fa-cube"></i>
                    </div>

                    <span>
                       Add New Videos
                    </span>

                </a>

            </li>



            <!-- Heading -->
            {{-- <li class="px-6 pt-6">

                <h6 class="text-xs uppercase text-gray-400 font-bold">
                    Account Pages
                </h6>

            </li>


            <li>

                <a
                    href="#"
                    class="flex items-center mx-4 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-100 transition">

                    <div class="mr-3">
                        <i class="fas fa-user"></i>
                    </div>

                    <span>
                        Profile
                    </span>

                </a>

            </li>


            <li>

                <a
                    href="#"
                    class="flex items-center mx-4 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-100 transition">

                    <div class="mr-3">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>

                    <span>
                        Sign In
                    </span>

                </a>

            </li>


            <li>

                <a
                    href="#"
                    class="flex items-center mx-4 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-100 transition">

                    <div class="mr-3">
                        <i class="fas fa-user-plus"></i>
                    </div>

                    <span>
                        Sign Up
                    </span>

                </a>

            </li> --}}

        </ul>

    </div>

</aside>
