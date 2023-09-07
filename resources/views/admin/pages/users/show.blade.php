@extends('admin.layout.index')

@section('title', __('admin/users.show_data.title'))

@section('breadcrumbs')
    @include('admin.partials.breadcrumbs', [
        'page' => 'admin.users.show'
    ])
@endsection

@section('content')
    {{-- todo --}}
@endsection
