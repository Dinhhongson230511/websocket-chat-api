@php
    use \App\Enums\CompanyStatus;
    use \App\Enums\TravelAgencyStatus;
@endphp

<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <div class="sidebar-brand-full">
            {{-- <img src="{{ asset('/assets/svg/logo_footer.svg') }}" width="118" height="46" alt="Logo"> --}}
        </div>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        @can('admin')
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('admin.travel_agencies.list', ['status' => TravelAgencyStatus::APPROVED->value]) }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/common.sidebar.travel_agency_list') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('admin.travel_agencies.list', ['status' => TravelAgencyStatus::REQUEST->value]) }}">
                    <i class="nav-icon cil-check"></i> {{ __('admin/common.sidebar.travel_agency_list_approval') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('admin.companies.list', ['status' => CompanyStatus::APPROVED->value]) }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/common.sidebar.company_list') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('admin.companies.list', ['status' => CompanyStatus::REQUEST->value]) }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/common.sidebar.company_list_approval') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="{{ route('admin.list') }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/common.sidebar.admin_list') }}
                </a>
            </li>
        @endcan
        @can('company')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.company.index') }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/company.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.company.store.create') }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/store.sidebar') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.company.course_registration.create') }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/course_registration.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.messages.show', 0) }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/messages.sidebar') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.company.store.userList') }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/common.sidebar.admin_list') }}
                </a>
            </li>
        @endcan
        @can('store')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.messages.show', 0) }}">
                    <i class="nav-icon cil-user"></i> {{ __('admin/messages.sidebar') }}
                </a>
            </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reservations.list') }}">
                <i class="nav-icon cil-list"></i> {{ __('admin/common.sidebar.reservation_list') }}
            </a>
        </li>
    </ul>
</div>
