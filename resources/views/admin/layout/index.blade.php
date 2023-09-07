<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.min.css') }}">
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">

    @vite([
        'resources/sass/master.scss',
        'resources/js/master.js',
    ])

    @include('common.toast')
    @include('common.modal_show_errors')
    @stack('css')
</head>

<body>
    @if (Route::is('admin.login.form') ||
        Route::is('admin.password.forgot') ||
        Route::is('admin.password.reset')
    )
        @yield('content')
    @else
        @include('admin.partials.sidebar')
        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
            @include('admin.partials.header')
            <div class="body flex-grow-1 p-3">
                @yield('content')
            </div>
            @include('admin.partials.footer')
        </div>
    @endif
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    @stack('js')
    @yield('script')
    <script>
        const message = @json(__('common.no_result'));
        $.datetimepicker.setLocale('ja');
        $('.select2').select2({
            "language": {
                "noResults": function() {
                    return message;
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        })
        const closeEye = @js(asset('assets/images/icon/close_eye.svg'));
        const showEye = @js(asset('assets/images/icon/show_eye.svg'));
    </script>
</body>

</html>
