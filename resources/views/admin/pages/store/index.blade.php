@extends('admin.layout.index')

@section('title', __('admin/company.title'))

@section('content')
    @include('admin.pages.store.components.list', [
        'stores' => $stores,
    ])
@endsection
