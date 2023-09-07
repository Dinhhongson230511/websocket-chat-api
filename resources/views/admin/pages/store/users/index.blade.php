@extends('admin.layout.index')

@section('title', __('admin/admin.page.list.title'))

@section('content')
    <div class="mx-auto">
        <h3 class="text-2xl font-bold mb-4">@lang('admin/admin.page.list.title')</h3>
        <div class="flex mb-4">
            <form method="GET" id="form-select-store">
                <div class="row">
                    <div class="col-3">
                        @include('admin.components.input.select', [
                            'selectName' => 'store_id',
                            'boxLabelClass' => 'mb-2',
                            'options' => $stores,
                            'selectValue' => old('store_id', Request::query('store_id') ?? ''),
                            'optionNameDefault' => __('admin/course_registration.all_stores'),
                        ])
                    </div>
                    <div class="col-2">
                        <button data-bs-toggle="modal"
                                data-bs-target="#create-user"
                                type="button"
                                class="btn btn-primary mt-3"
                                {{ !Request::query('store_id') ? 'disabled' : '' }}>
                            @lang('admin/admin.page.list.create')
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @include('admin.pages.users.components.list', [
            'users' => $users,
            'storeColumn' => true,
        ])
        @include('admin.pages.users.modals.create', [
            'action' => route('admin.company.store.createUser'),
            'inputHiddenValue' => Request::query('store_id'),
            'inputHiddenName' => 'store_id',
        ])
    </div>
@endsection

@push('js')
    @vite(['resources/js/admin/users/index.js']);
@endpush
