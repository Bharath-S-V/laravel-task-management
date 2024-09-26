<header class="d-flex justify-content-between align-items-center py-3 custom-header">
    <div class="d-flex align-items-center">
        <button class="btn btn-light d-lg-none me-3" id="sidebarToggle" style="color:black">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
            </svg>
        </button>
        <div class="welcome-text">
            <h1 class="h3 mb-0">Welcome!</h1>
            <small class="text-muted">Admin</small>
        </div>
    </div>
    <div class="header-notifications d-lg-flex d-md-flex align-items-center">
        <div class="notifications me-4 d-flex align-items-center d-none d-md-flex">
            <div class="icon-wrapper me-3 dropdown">
                <button type="button" class="btn position-relative" id="notificationBtn" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 11v.01M8 11v.01m8-.01v.01M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-5l-5 3v-3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3z" />
                    </svg>
                    <span id="notificationBadge"
                        class="badge bg-warning position-absolute top-0 start-150 translate-middle">0</span>
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationBtn" id="notificationDropdown">
                    <li>
                        <h6 class="dropdown-header">Notifications</h6>
                    </li>
                    <li id="notificationItems">
                        <!-- Notifications will be injected here -->
                    </li>
                </ul>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#notificationBtn').on('click', function() {
                        $.ajax({
                            url: '{{ route('admin.notifications') }}',
                            method: 'GET',
                            success: function(data) {
                                $('#notificationItems').empty(); // Clear existing notifications
                                $('#notificationBadge').text(data.length); // Update notification count

                                if (data.length === 0) {
                                    $('#notificationItems').append(
                                        '<li class="dropdown-item">No new notifications</li>');
                                } else {
                                    data.forEach(function(notification) {
                                        $('#notificationItems').append(`
                                <a class="dropdown-item" href="#!">${notification.message}</a>
                            `);
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error: ", status, error); // Log error details
                                $('#notificationItems').append(
                                    '<li class="dropdown-item">Error loading notifications</li>');
                            }
                        });
                    });
                });
            </script>


            <div class="icon-wrapper">
                <button type="button" class="btn position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
                        <path fill="black"
                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742c-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                    </svg>
                    <span class="badge bg-primary position-absolute top-0 start-150 translate-middle">2</span>
                </button>
            </div>
        </div>
        <div class="profile">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <circle cx="12" cy="8" r="5" fill="black" />
                    <path d="M20 21a8 8 0 1 0-16 0" />
                    <path fill="black" d="M12 13a8 8 0 0 0-8 8h16a8 8 0 0 0-8-8" />
                </g>
            </svg>
        </div>
    </div>
</header>
