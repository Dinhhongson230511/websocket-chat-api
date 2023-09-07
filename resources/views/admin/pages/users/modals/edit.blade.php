<div class="modal fade" id="modalId{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.user.updateProfile', $user->id) }}"
            enctype="multipart/form-data"
            class="auth__container--form">
            @method('PATCH')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">{{ __('admin/users.edit_profile') }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload()"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @component('admin.components.card.collapse', [
                            'srcIcon' => asset('/assets/images/icon/person.svg'),
                            'title' => __('admin/common.card_title.manager'),
                        ])
                            @if($user->avatar)
                                <div class="user-avatar">
                                    <img src="{{ $user->avatar }}" alt="">
                                </div>
                            @endif
                            <div>
                                <label for="files" class="btn-label" id="customLabel">{{ __('admin/users.btn_upload_image') }}</label>
                                <input id="files" name="avatar" style="display: none;" type="file">
                            </div>
                            @can('company')
                                <div class="row">
                                    <div class="col-6">
                                        @component('admin.components.input.input_base', [
                                            'label' => __('admin/company.company_name'),
                                            'type' => 'text',
                                            'boxLabelClass' => 'mb-2',
                                            'inputValue' => $user?->company?->name,
                                            'disabled' => true,
                                        ])
                                        @endcomponent
                                    </div>
                                    <div class="col-6">
                                        @component('admin.components.input.input_base', [
                                            'label' => __('admin/users.authority'),
                                            'type' => 'text',
                                            'boxLabelClass' => 'mb-2',
                                            'inputValue' => __('admin/users.role_name_company'),
                                            'disabled' => true,
                                        ])
                                        @endcomponent
                                    </div>
                                </div>
                            @endcan
                            @can('store')
                                <div class="row">
                                    <div class="col-6">
                                        @component('admin.components.input.input_base', [
                                            'label' => __('admin/company.company_name'),
                                            'type' => 'text',
                                            'boxLabelClass' => 'mb-2',
                                            'inputValue' => $user?->store?->name,
                                            'disabled' => true,
                                        ])
                                        @endcomponent
                                    </div>
                                    <div class="col-6">
                                        @component('admin.components.input.input_base', [
                                            'label' => __('admin/users.authority'),
                                            'type' => 'text',
                                            'boxLabelClass' => 'mb-2',
                                            'inputValue' => __('admin/users.role_name_store'),
                                            'disabled' => true,
                                        ])
                                        @endcomponent
                                    </div>
                                </div>
                            @endcan
                            <div class="row">
                                <div class="col-6">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.last_name'),
                                        'type' => 'text',
                                        'inputName' => 'last_name',
                                        'placeholder' => __('admin/users.last_name'),
                                        'inputValue' => old('last_name', $user->last_name),
                                        'boxLabelClass' => 'mb-2',
                                        'requiredLabel' => true,
                                    ])
                                    @endcomponent
                                </div>
                                <div class="col-6">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.first_name'),
                                        'type' => 'text',
                                        'inputName' => 'first_name',
                                        'placeholder' => __('admin/users.first_name'),
                                        'inputValue' => old('first_name', $user?->first_name),
                                        'boxLabelClass' => 'mb-2',
                                        'requiredLabel' => true,
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.furigana_last_name'),
                                        'type' => 'text',
                                        'inputName' => 'furigana_last_name',
                                        'placeholder' => __('admin/users.furigana_last_name'),
                                        'inputValue' => old('furigana_last_name', $user?->furigana_last_name),
                                        'boxLabelClass' => 'mb-2',
                                        'requiredLabel' => true,
                                    ])
                                    @endcomponent
                                </div>
                                <div class="col-6">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.furigana_first_name'),
                                        'type' => 'text',
                                        'inputName' => 'furigana_first_name',
                                        'placeholder' => __('admin/users.furigana_first_name'),
                                        'inputValue' => old('furigana_first_name', $user?->furigana_first_name),
                                        'boxLabelClass' => 'mb-2',
                                        'requiredLabel' => true,
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.tel'),
                                        'type' => 'text',
                                        'inputName' => 'tel',
                                        'placeholder' => __('admin/users.tel'),
                                        'inputValue' => old('tel', $user?->tel),
                                        'boxLabelClass' => 'mb-2',                                    ])
                                    @endcomponent
                                </div>
                                <div class="col-6">
                                    @component('admin.components.input.input_base', [
                                        'label' => __('admin/users.fax'),
                                        'type' => 'text',
                                        'inputName' => 'fax',
                                        'placeholder' => __('admin/users.fax'),
                                        'inputValue' => old('fax', $user?->fax),
                                        'boxLabelClass' => 'mb-2',
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                            <div class="row">
                                @include('admin.components.input.input_base', [
                                    'label' => __('admin/users.email'),
                                    'inputName' => 'email',
                                    'placeholder' => __('admin/users.email'),
                                    'inputMaxLength' => '255',
                                    'inputValue' => old('email', $user->email),
                                    'disabled' => true,
                                ])
                            </div>
                        @endcomponent
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">@lang('admin/common.save')</button>
                </div>
            </div>
        </form>
    </div>
</div>
