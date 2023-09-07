@extends('admin.layout.index')

@push('css')
    @vite(['resources/sass/admin/pages/auth/style.scss'])
@endpush

@section('content')
    <div class="auth__container">
        <form class="auth__container--form" method="POST"
            action="{{ route('admin.password.update', ['token' => request()->query('token')]) }}">
            @csrf
            <img class="logo" src="{{ asset('assets/images/logo.png') }}" alt="logo">
            <div class="title">@lang('auth.reset_password.title')</div>
            <div class="form-content">
                <div class="form-body">
                    @include('admin.components.input.input_password', [
                        'label' => __('auth.new_password.input.new_password'),
                        'inputId' => 'newPassword',
                        'inputName' => 'new_password',
                        'inputType' => 'password',
                        'inputValue' => old('new_password'),
                        'inputSuggestionText' => __('auth.new_password.suggestion'),
                        'inputSuggestionClass' => 'suggest-password'
                    ])
                    @include('admin.components.input.input_password', [
                        'label' => __('auth.new_password.input.password_confirm'),
                        'inputId' => 'passwordConfirm',
                        'inputName' => 'password_confirmed',
                        'inputType' => 'password',
                        'inputValue' => old('password_confirmed'),
                    ])
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-submit">@lang('auth.reset_password.button.submit')</button>
                    <a href="{{ route('admin.login.form') }}" class="link-back">@lang('auth.common.btn_back')</a>
                </div>
            </div>
        </form>
    </div>
@endsection

