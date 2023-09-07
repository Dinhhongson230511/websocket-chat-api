@extends('admin.layout.index')

@push('css')
    @vite(['resources/sass/admin/pages/auth/style.scss'])
@endpush

@section('content')
    <div class="auth__container">
        <form class="auth__container--form"  method="POST" action="{{ route('admin.password.email.send') }}">
            @csrf
            <img class="logo" src="{{ asset('assets/images/logo.png') }}" alt="logo">
            <div class="title">@lang('auth.reset_password.title')</div>
            <div class="form-content">
                <div class="form-body">
                    @include('admin.components.input.input_email', [
                        'inputId' => 'email',
                        'inputName' => 'email',
                        'placeholder' => 'example@example.com',
                        'inputMaxLength' => '60',
                        'inputValue' => old('email')
                    ])
                </div>
                <div class="form-footer">
                    <span class="text-reset-pass">@lang('auth.reset_password.descriptions')</span>
                    <button type="submit" class="btn btn-submit">@lang('auth.reset_password.button.submit')</button>
                    <a href="{{ route('admin.login.form') }}" class="link-back">@lang('auth.common.btn_back')</a>
                </div>
            </div>
        </form>
    </div>
@endsection
