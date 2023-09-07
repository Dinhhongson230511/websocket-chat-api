@extends('admin.layout.index')

@push('css')
    @vite(['resources/sass/admin/pages/auth/style.scss'])
@endpush

@section('content')
    <div class="auth__container">
        <form method="POST" action="{{ route('admin.login.action') }}" class="auth__container--form">
            @csrf
            <img class="logo" src="{{ asset('assets/images/logo.png') }}" alt="logo">
            <div class="title">@lang('auth.login.title')</div>
            <div class="form-content">
                <div class="form-body">
                    @include('admin.components.input.input_email', [
                        'inputId' => 'email',
                        'inputName' => 'email',
                        'placeholder' => 'example@example.com',
                        'inputMaxLength' => '60',
                        'inputValue' => old('email')

                    ])
                    @include('admin.components.input.input_password', [
                        'label' => __('auth.login.input.password'),
                        'inputId' => 'password',
                        'inputName' => 'password',
                        'inputType' => 'password',
                        'inputValue' => old('password')
                    ])
                    <div class="row-item">
                        <div class="input-checkbox">
                            <input type="checkbox" id="remember" aria-label="Checkbox input" name="remember_token">
                            <label for="remember" role="button">@lang('auth.login.button.remember_token')</label>
                        </div>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-submit">@lang('auth.login.button.submit')</button>
                    <a href="{{ route('admin.password.forgot') }}" class="link-forgot-password">@lang('auth.login.button.reset_password')</a>
                </div>
            </div>
        </form>
    </div>
@endsection
