<nav class="sidebar col-lg-2 col-md-3 col-sm-12 d-lg-block bg-light">
    <div class="position-sticky">
        <div class="d-flex justify-content-between align-items-center p-3">
            <div class="logo">
                Logo
            </div>
            <button class="btn btn-light d-lg-none close-sidebar" id="closeSidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                </svg>
            </button>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('user.dashboard') }}" style="
    padding: 9px;
">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="black"
                            d="M6 19h3v-6h6v6h3v-9l-6-4.5L6 10zm-2 2V9l8-6l8 6v12h-7v-6h-2v6zm8-8.75" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.task') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="black"
                            d="M12 22c.8 0 1.6-.1 2.3-.3c-.4-.5-.8-1.1-1-1.8c-.4.1-.9.1-1.3.1c-4.4 0-8-3.6-8-8s3.6-8 8-8c.8 0 1.5.1 2.2.3l1.6-1.6C14.6 2.3 13.3 2 12 2C6.5 2 2 6.5 2 12s4.5 10 10 10M6.5 11.5l1.4-1.4l3.1 3.1l8.6-8.6L21 6L11 16zM19 14l-1.26 2.75L15 18l2.74 1.26L19 22l1.25-2.74L23 18l-2.75-1.25z" />
                    </svg>
                    Tasks
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 14 14">
                            <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                d="M9.5 10.5v2a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1v-11a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v2M6.5 7h7m-2-2l2 2l-2 2" />
                        </svg>
                        Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
</nav>
