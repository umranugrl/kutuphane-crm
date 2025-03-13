<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="{{ route('admin.index') }}"><img src="{{ asset('images/logo.jpg') }}"
                    alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('admin.index') }}"><img
                    src="{{ asset('images/logo-mini.svg') }}" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">

            

            <li class="nav-item dropdown mr-4">
                <a href="{{ route('notifications.index') }}" class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                    id="notificationDropdown"  >
                    <i class="mdi mdi-bell mx-0"></i>
                    @if (Auth::user()->unreadNotifications->count() > 0)
                        <span class="count ml-2">{{ Auth::user()->unreadNotifications->count() }}</span>
                    @endif
                </a>
                
            </li>

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    @if (Auth::user()->profile_image)
                        <img src="{{ asset(Auth::user()->profile_image) }}" alt="profile" />
                    @else
                        <img src="{{ asset('images/faces/face.jpg') }}" alt="profile" />
                    @endif
                    <span class="nav-profile-name">{{ Auth::user()->name ?? 'Admin' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="mdi mdi-settings text-primary"></i>
                        @lang('profile.profile')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout text-primary"></i>
                        @lang('auth.logout')
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->
