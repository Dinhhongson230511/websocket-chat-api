@extends('admin.layout.index')

@section('title', __('admin/users.title'))

@section('content')
    <div class="mx-auto">
        @component('admin.components.card.common')
            <div class="d-flex justify-content-end">
                <button
                    data-bs-toggle="modal"
                    data-bs-target="#change-password"
                    type="button" class="btn btn-primary me-3"
                >
                    @lang('admin/users.change_password')
                </button>
                <button
                    data-bs-toggle="modal"
                    data-bs-target="#modalId{{ $user->id }}"
                    type="button" class="btn btn-primary me-3"
                >
                    @lang('admin/common.edit')
                </button>
            </div>
            @component('admin.components.card.collapse', [
                'srcIcon' => asset('/assets/images/icon/avatar.svg'),
                'title' => __('admin/users.my_account'),
            ])
                @if($user->avatar)
                    <div class="user-avatar">
                        <img src="{{ $user->avatar }}" alt="">
                    </div>
                @endif
                <div class="row">
                    @can('company')
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
                    @endcan
                    @can('store')
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
                    @endcan
                    <div class="col-6">
                        @component('admin.components.input.input_base', [
                            'label' => __('admin/users.last_name'),
                            'type' => 'text',
                            'placeholder' => __('admin/users.last_name'),
                            'boxLabelClass' => 'mb-2',
                            'disabled' => true,
                            'inputValue' => old('last_name', $user->last_name),
                        ])
                        @endcomponent
                    </div>
                    <div class="col-6">
                        @component('admin.components.input.input_base', [
                            'label' => __('admin/users.first_name'),
                            'type' => 'text',
                            'placeholder' => __('admin/users.first_name'),
                            'boxLabelClass' => 'mb-2',
                            'inputValue' => old('first_name', $user->first_name),
                            'disabled' => true,
                        ])
                        @endcomponent
                    </div>
                    <div class="col-6">
                        @component('admin.components.input.input_base', [
                            'label' => __('admin/users.furigana_last_name'),
                            'type' => 'text',
                            'placeholder' => __('admin/users.furigana_last_name'),
                            'boxLabelClass' => 'mb-2',
                            'disabled' => true,
                            'inputValue' => old('furigana_last_name', $user->furigana_last_name),
                        ])
                        @endcomponent
                    </div>
                    <div class="col-6">
                        @component('admin.components.input.input_base', [
                            'label' => __('admin/users.furigana_first_name'),
                            'type' => 'text',
                            'placeholder' => __('admin/users.furigana_first_name'),
                            'boxLabelClass' => 'mb-2',
                            'inputValue' => old('furigana_first_name', $user->furigana_first_name),
                            'disabled' => true,
                        ])
                        @endcomponent
                    </div>
                    <div class="col-6">
                        @component('admin.components.input.input_base', [
                            'label' => __('admin/users.tel'),
                            'type' => 'text',
                            'placeholder' => __('admin/users.tel'),
                            'boxLabelClass' => 'mb-2',
                            'disabled' => true,
                            'inputValue' => old('tel', $user->tel),
                        ])
                        @endcomponent
                    </div>
                    <div class="col-6">
                        @component('admin.components.input.input_base', [
                            'label' => __('admin/users.fax'),
                            'type' => 'text',
                            'placeholder' => __('admin/users.fax'),
                            'boxLabelClass' => 'mb-2',
                            'inputValue' => old('fax', $user->fax),
                            'disabled' => true
                        ])
                        @endcomponent
                    </div>
                    <div class="col-6">
                        @component('admin.components.input.input_base', [
                            'label' => __('admin/users.email'),
                            'type' => 'text',
                            'placeholder' => __('admin/users.email'),
                            'boxLabelClass' => 'mb-2',
                            'inputValue' => old('email ', $user->email ),
                            'disabled' => true
                        ])
                        @endcomponent
                    </div>
                    @include('admin.pages.users.modals.change_password', ['user' => $user])
                    @include('admin.pages.users.modals.edit', ['user' => $user])
                </div>
            @endcomponent
        @endcomponent
    </div>
@endsection

@push('js')
    @vite(['resources/js/admin/auth/custom.js']);
@endpush
