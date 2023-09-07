@extends('admin.layout.index')

@section('title', __('admin/store.title'))

@push('css')
    @vite(['resources/sass/admin/pages/store/style.scss']);
@endpush
@section('content')
    @component('admin.components.card.common')
        <form method="POST" action="{{ route('admin.company.store.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.store.components.form.info', [
                'prefectures' => $prefectures,
                'areas' => $areas,
                'subAreas' => $subAreas,
                'categories' => $categories,
            ])

            @include('admin.pages.store.components.form.detail', [
                'roomSeatTypes' => $roomSeatTypes,
                'allergyCompatibilities' => $allergyCompatibilities,
                'dietaryRestrictions' => $dietaryRestrictions,
            ])

            @include('admin.pages.store.components.form.create_user')

            <div class="store__button">
                <button type="button" class="store__button-cancel">{{ __('admin/store.button.cancel') }}</button>
                <button type="submmit" class="store__button-create">{{ __('admin/store.button.create') }}</button>
            </div>
        </form>
    @endcomponent
@endsection

@push('js')
    @vite(['resources/js/admin/Store/index.js']);
@endpush
@section('script')
    <script>
        const url1 = @json(route('admin.company.store.store'));
        const categories = @json($categories);
        const imageTime = @js(asset('assets/images/icon/time24.png'));
        const apiKey = `{{ config('const.api_key_map') }}`;
        const mgsNotFound = `{{ __('admin/store.message.no_content')}}`;
        const apiGGError = `{{ __('admin/store.message.api_gg_error')}}`;
        const notFoundAddress = `{{ __('admin/store.message.not_found_address')}}`;
    </script>
@endsection
