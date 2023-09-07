<table class="table table-bordered {{ $class ?? '' }}">
    {{ $slot }}
</table>
@if (isset($pagination) && count($pagination))
    {{ $pagination->appends($_GET)->links('admin.components.table.pagination') }}
@endif
