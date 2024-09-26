<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 20px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link.active {
            color: #007bff;
        }

        .sidebar .nav-link:hover {
            color: #0056b3;
        }

        .sidebar .nav-link svg {
            margin-right: 4px;
            color: #999;
        }

        .sidebar .nav-link.active svg {
            color: #007bff;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
                height: 100vh;
                position: fixed;
                top: 0;
                left: -100%;
                transition: all 0.3s;
            }

            .sidebar.active {
                left: 0;
            }

            .close-sidebar {
                display: block;
            }
        }

        @media (min-width: 992px) {
            .close-sidebar {
                display: none;
            }
        }

        .sidebar .logo {
            text-align: center;
            padding: 30px 0;
            font-size: 24px;
            font-weight: bold;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .btn-custom {
            background-color: #68c8ee;
            border-color: #68c8ee;
        }

        .btn-custom:hover {
            background-color: #57b0d4;
            border-color: #57b0d4;
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="min-height: 100%">
        <div class="row">

            @include('components.user-nav')


            <!-- Main content -->
            <main class="col-md-12 ms-sm-auto col-lg-10 px-md-4" style="background-color: #f5f4f2;min-height: 100vh;">
                <!-- Header -->
                @include('components.user-header')


                @yield('content')
                <!-- Dashboard Widgets -->

            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const closeSidebar = document.getElementById('closeSidebar');
            const sidebar = document.querySelector('.sidebar');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
            }

            sidebarToggle.addEventListener('click', toggleSidebar);
            closeSidebar.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking outside of it
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggleButton = sidebarToggle.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggleButton && sidebar.classList.contains(
                        'active')) {
                    toggleSidebar();
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const notificationBtn = document.getElementById('notificationBtn');
            const notificationBadge = document.getElementById('notificationBadge');

            notificationBtn.addEventListener('click', function() {
                // Toggle the 'show' class on the dropdown menu
                this.nextElementSibling.classList.toggle('show');

                // Update the badge number (for demonstration purposes)
                let currentNumber = parseInt(notificationBadge.textContent);
                notificationBadge.textContent = currentNumber > 0 ? 0 : 3;
            });

            // Close the dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!notificationBtn.contains(event.target)) {
                    notificationBtn.nextElementSibling.classList.remove('show');
                }
            });
        });
    </script>


</body>

</html>
