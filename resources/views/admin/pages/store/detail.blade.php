@extends('admin.layout.index')

@section('title', __('admin/store.title'))

@push('css')
    @vite(['resources/sass/admin/pages/store/style.scss']);
@endpush
@section('content')
    @include('admin.partials.back_to_page', [
        'pageName' => __('admin/store.sidebar'),
        'link' => route('admin.company.store.list', ['company' => $company->id]),
    ])
    @component('admin.components.card.common')
        <form method="POST" action="{{ route('admin.company.store.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.store.components.form.info', [
                'prefectures' => $dataDisplayForSelect['prefectures'],
                'areas' => $dataDisplayForSelect['areas'],
                'subAreas' => $dataDisplayForSelect['subAreas'],
                'categories' => $dataDisplayForSelect['categories'],
                'store' => $store
            ])

            @include('admin.pages.store.components.form.detail', [
                'roomSeatTypes' => $dataDisplayForSelect['roomSeatTypes'],
                'allergyCompatibilities' => $dataDisplayForSelect['allergyCompatibilities'],
                'dietaryRestrictions' => $dataDisplayForSelect['dietaryRestrictions'],
                'store' => $store,
                'days' => $dataDisplayForSelect['days'],
            ])
            <h3 class="text-2xl font-bold mb-4 mt-5">@lang('admin/users.create_user_title')</h3>
            @include('admin.pages.users.components.list', [
                'users' => $users,
            ])
        </form>
    @endcomponent
@endsection

@push('js')
    @vite(['resources/js/admin/Store/index.js']);
@endpush
@section('script')
    <script>
        const url1 = @json(route('admin.company.store.store'));
        const categories = @json($dataDisplayForSelect['categories']);
        const imageTime = @js(asset('assets/images/icon/time24.png'));
    </script>
@endsection
