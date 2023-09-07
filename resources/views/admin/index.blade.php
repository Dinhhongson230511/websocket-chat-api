@extends('admin.layout.index')

@section('title', __('admin/admin.page.list.title'))

@section('content')
    <div class="mx-auto">
        <h3 class="text-2xl font-bold mb-4">@lang('admin/admin.page.list.title')</h3>
        <div class="d-flex justify-content-end mb-4">
            <button data-bs-toggle="modal" data-bs-target="#create-user" type="button" class="btn btn-primary me-3">
                @lang('admin/admin.page.list.create')
            </button>
        </div>
        @include('admin.pages.users.components.list', [
            'users' => $users,
        ])

        @include('admin.pages.users.modals.create', [
            'action' => route('admin.store'),
        ])
    </div>
@endsection

@push('js')
    @vite(['resources/js/admin/users/index.js']);
@endpush
