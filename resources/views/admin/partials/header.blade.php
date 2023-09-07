<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="icon icon-lg cil-menu"></i>
        </button>
        <b class="me-auto">@yield('title')</b>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <img class="avatar-img" src="{{ auth()->user()->avatar_url }}" alt="avatar">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-2">
                    <a class="dropdown-item" href="{{ route('admin.user.profile') }}">
                        <i class="icon me-2 cil-user"></i>{{ __('admin/common.header.button.profile') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="icon me-2 cil-account-logout"></i>{{ __('admin/common.header.button.logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
    @yield('breadcrumbs')
</header>
