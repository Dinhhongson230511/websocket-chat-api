<div class="mx-auto">
    <h3 class="text-2xl font-bold mb-4 mt-5">@lang('admin/store.sidebar')</h3>

   <div class="flex px-5 p mb-4">
        <form method="GET">
            <div class="row">
                    <div class="col-3">
                        @component('admin.components.input.select2', [
                            'selectName' => 'store_name',
                            'boxLabelClass' => 'mb-2',
                            'options' => $listStoreForSearch,
                            'selectValue' => Request::query('store_name'),
                            'optionNameDefault' => __('admin/store.search_store_name_placeholder'),
                        ])
                        @endcomponent
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary mt-3">
                            @lang('admin/common.search')
                        </button>
                        <a class="btn btn-secondary mt-3" href="{{ route('admin.company.store.list', ['company' => $company->id]) }}">
                            @lang('admin/common.clear')
                        </a>
                    </div>
            </div>
        </form>
    </div>

    <!-- Use the table component -->
    @component('admin.components.table.single', ['pagination' => $stores])
        <thead>
            <tr>
                <th class="px-4 py-2">@lang('admin/store.label.no')</th>
                <th class="px-4 py-2">@lang('admin/store.label.store_name')</th>
                <th class="px-4 py-2">@lang('admin/store.label.area')</th>
                <th class="px-4 py-2">@lang('admin/store.label.reservation_list')</th>
                <th class="px-4 py-2">@lang('admin/store.label.store_detail')</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stores as $key => $store)
                <tr>
                    <td class="border px-4 py-2">{{ $key + $stores->firstItem() }}</td>
                    <td class="border px-4 py-2">
                        <div class="text-name">{{ $store->name }}</div>
                    </td>
                    <td class="border px-4 py-2">{{ $store->prefectures->name }}</td>
                    <td class="border px-4 py-2">
                        <a type="button" class="btn btn-primary">
                            @lang('admin/store.btn.reservation_list')
                        </a>
                    </td>
                    <td class="border px-4 py-2">
                        <a type="button" class="btn btn-primary" href="{{ route('admin.company.store.detail', ['company' => $company->id, 'store' => $store->id, 'status' => 'detail' ]) }}">
                            @lang('admin/store.table.btn.detail')
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">@lang('admin/common.no_data_available')</td>
                </tr>
            @endforelse
        </tbody>
    @endcomponent
</div>
