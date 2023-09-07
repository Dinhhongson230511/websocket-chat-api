@props([
    'hasAction' => false,
    'storeColumn' => false,
])
<!-- Use the table component -->
@component('admin.components.table.single', ['pagination' => $users])
    <thead>
        <tr>
            <th class="px-4 py-2">@lang('admin/users.no')</th>
            @if($storeColumn)
                <th class="px-4 py-2">@lang('admin/users.store_name')</th>
            @endif
            <th class="px-4 py-2">@lang('admin/users.last_name')</th>
            <th class="px-4 py-2">@lang('admin/users.first_name')</th>
            <th class="px-4 py-2">@lang('admin/users.furigana_last_name')</th>
            <th class="px-4 py-2">@lang('admin/users.furigana_first_name')</th>
            <th class="px-4 py-2">@lang('admin/users.tel')</th>
            <th class="px-4 py-2">@lang('admin/users.fax')</th>
            <th class="px-4 py-2">@lang('admin/users.email')</th>
            @if($hasAction)
                <th class="px-4 py-2">{{ __('admin/users.action.edit') }}</th>
                <th class="px-4 py-2">{{ __('admin/users.action.delete') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $key => $user)
            <tr>
                <td class="border px-4 py-2">{{ $key + 1 }}</td>
                @if($storeColumn)
                    <td class="border px-4 py-2">{{ $user->store->name }}</td>
                @endif
                <td class="border px-4 py-2">{{ $user->last_name }}</td>
                <td class="border px-4 py-2">{{ $user->first_name }}</td>
                <td class="border px-4 py-2">{{ $user->furigana_last_name }}</td>
                <td class="border px-4 py-2">{{ $user->furigana_first_name }}</td>
                <td class="border px-4 py-2">{{ $user->tel }}</td>
                <td class="border px-4 py-2">{{ $user->fax }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                @if($hasAction)
                    <td class="border px-4 py-2">
                        <a href="javascript:void(0)"></a>
                    </td>
                    <td class="border px-4 py-2">
                        <a href="javascript:void(0)"></a>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="9" class="border px-4 py-2 text-center">@lang('admin/common.no_data_available')</td>
            </tr>
        @endforelse
    </tbody>
@endcomponent

