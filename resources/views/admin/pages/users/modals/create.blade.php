@props([
    'action' => route('admin.user.create'),
])
<div class="modal fade" id="create-user" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ $action }}"
            class="auth__container--form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">{{ __('admin/users.create_profile') }}</h3>
                    <button type="button" id="btnClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @component('admin.components.card.collapse', [
                            'srcIcon' => asset('/assets/images/icon/person.svg'),
                            'title' => __('admin/common.card_title.manager'),
                        ])
                            <input type="hidden" value="{{ $inputHiddenValue ?? '' }}" name="{{ $inputHiddenName ?? '' }}" />
                            <div class="row">
                                <div class="col-6 input-list">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.last_name'),
                                        'type' => 'text',
                                        'inputName' => 'last_name',
                                        'placeholder' => __('admin/users.last_name'),
                                        'boxLabelClass' => 'mb-2',
                                        'inputValue' => old('last_name'),
                                        'requiredLabel' => true,
                                    ])
                                    @endcomponent
                                </div>
                                <div class="col-6 input-list">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.first_name'),
                                        'type' => 'text',
                                        'inputName' => 'first_name',
                                        'placeholder' => __('admin/users.first_name'),
                                        'boxLabelClass' => 'mb-2',
                                        'inputValue' => old('first_name'),
                                        'requiredLabel' => true,
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 input-list">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.furigana_last_name'),
                                        'type' => 'text',
                                        'inputName' => 'furigana_last_name',
                                        'placeholder' => __('admin/users.furigana_last_name'),
                                        'boxLabelClass' => 'mb-2',
                                        'requiredLabel' => true,
                                        'inputValue' => old('furigana_last_name'),
                                    ])
                                    @endcomponent
                                </div>
                                <div class="col-6 input-list">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.furigana_first_name'),
                                        'type' => 'text',
                                        'inputName' => 'furigana_first_name',
                                        'placeholder' => __('admin/users.furigana_first_name'),
                                        'boxLabelClass' => 'mb-2',
                                        'requiredLabel' => true,
                                        'inputValue' => old('furigana_first_name'),
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 input-list">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.tel'),
                                        'type' => 'text',
                                        'inputName' => 'user_tel',
                                        'placeholder' => __('admin/users.tel'),
                                        'boxLabelClass' => 'mb-2',
                                        'inputValue' => old('user_tel'),
                                    ])
                                    @endcomponent
                                </div>
                                <div class="col-6 input-list">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.fax'),
                                        'type' => 'text',
                                        'inputName' => 'user_fax',
                                        'placeholder' => __('admin/users.fax'),
                                        'boxLabelClass' => 'mb-2',
                                        'inputValue' => old('user_fax'),
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row input-list">
                                @include('admin.components.input.input_base', [
                                    'label' => __('admin/users.email'),
                                    'inputName' => 'email',
                                    'placeholder' => __('admin/users.email'),
                                    'inputMaxLength' => '255',
                                    'requiredLabel' => true,
                                    'inputValue' => old('email'),
                                ])
                            </div>
                        @endcomponent
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">@lang('admin/common.submit')</button>
                </div>
            </div>
        </form>
    </div>
</div>
