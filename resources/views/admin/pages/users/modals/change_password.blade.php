<div class="modal fade" id="change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.user.change_password', $user->id) }}"
            class="auth__container--form">
            @method('PATCH')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">{{ __('admin/users.change_password') }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-body">
                            @include('admin.components.input.input_password', [
                                'label' => __('auth.new_password.input.new_password'),
                                'inputId' => 'passwordConfirm',
                                'inputName' => 'password_confirmed',
                                'inputType' => 'password',
                                'inputValue' => old('password_confirmed'),
                                'requiredLabel' => true,
                            ])
                            @include('admin.components.input.input_password', [
                                'label' => __('auth.new_password.input.password_confirm'),
                                'inputId' => 'newPassword',
                                'inputName' => 'new_password',
                                'inputType' => 'password',
                                'inputValue' => old('new_password'),
                                'inputSuggestionText' => __('auth.new_password.suggestion'),
                                'inputSuggestionClass' => 'suggest-password',
                                'requiredLabel' => true,
                            ])
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">@lang('admin/users.btn_change_password')</button>
                </div>
            </div>
        </form>
    </div>
</div>
