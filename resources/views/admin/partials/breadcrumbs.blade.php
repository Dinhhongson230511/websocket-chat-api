@php
    if (isset($object)) {
        $breadcrumbs = Breadcrumbs::generate($page, $object);
    } else {
        $breadcrumbs = Breadcrumbs::generate($page);
    }
@endphp
<div class="header-divider"></div>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                    <span>{{ $breadcrumb->title }}</span>
                </li>
            @endforeach
        </ol>
    </nav>
</div>
