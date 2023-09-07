@extends('admin.layout.index')

@section('title', __('admin/company.title'))

@push('css')
    @vite(['resources/sass/admin/message/_admin-tabpanel.scss'])
@endpush

@section('content')
<div class="container-master">
    <section>
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 col-md-3 col-12">
                <h2 class="mb-2 mb-md-0">@lang('admin/messages.channel')</h2>
            </div>
            <div class="col-lg-7 col-md-9 col-12">
                <div class="d-flex justify-content-start justify-content-md-end ">
                    <form class="m-0"><input type="hidden" value="10">
                        <input name="search" placeholder="{{ __('admin/messages.search_channel_placeholder') }}" value="" class="admin-ipt-search">
                        <button type="submit" class="d-none">@lang('admin/messages.search')</button>
                    </form>
                    <a href="" class="btn btn-primary">@lang('admin/messages.search')</a>
                </div>
            </div>
        </div>
        <hr>
    </section>
    <section class="admin-tabform">
        <div class="item-person bg-white">
            <div class="row">
                <div class="col-lg-2 col-sm-12 pl-lg-5 py-sm-2">
                    <p class="m-0 text-muted">No.</p>
                </div>
                <div class="col-lg-3 col-md-12 d-flex align-items-center py-2 py-lg-0">
                    <div class="item-person-content px-3">
                        <p class="m-0 text-muted">@lang('admin/messages.channel_name').</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 py-sm-2">
                    <p class="m-0 text-muted">@lang('admin/messages.type_channel')</p>
                </div>

                <div class="col-lg-3 col-sm-12 py-sm-2">
                    <p class="m-0 text-muted">@lang('admin/messages.date_created_channel')</p>
                </div>
            </div>
        </div>
        @foreach($channels as $key => $channel)
        <div class="item-person bg-white">
            <div class="row">
                <div class="col-lg-2 col-sm-12 pl-lg-5 py-sm-2">
                    <p data-id="6" class="m-0 text-dark">{{ $key + 1 }}</p>
                </div>
                <div class="col-lg-3 col-md-12 d-flex align-items-center py-2 py-lg-0">
                    <div class="item-person-content px-3">
                        <p data-id="6" class="m-0 text-dark">{{ $channel->display_name }}</p>
                        <!-- <p class="m-0 text-dark"> 2010-10-08</p> -->
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 py-sm-2">
                    <p data-id="6" class="m-0 text-dark d-flex">
                        <span class="ml-2 ">{{ $channel->type }}</span>
                    </p>
                </div>

                <div class="col-lg-3 col-sm-12 py-sm-2">
                    <p data-id="6" class="m-0 text-dark">{{ $channel->created_at }}</p>
                </div>
                <div class="list-btn">
                    <ul>
                        <li>
                            <a href="{{ route('admin.messages.show', $channel->id) }}" class="btn-chat p-1">
                                <svg fill="#fff" viewBox="0 -1 34 34" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>comments</title>
                                        <path d="M25.132 13.165c0-5.165-5.627-9.352-12.566-9.352s-12.566 4.187-12.566 9.352c0 3.104 2.032 5.854 5.16 7.555-0.009 0.027-2.492 4.545-2.492 4.545s7.582-2.892 7.603-2.904c0.744 0.103 1.511 0.155 2.295 0.155 6.939 0 12.566-4.187 12.566-9.351zM34.385 16.087c0-5.164-5.297-9.314-11.031-9.351 8.22 8.188-1.461 16.912-9.351 16.912 0 0 0.877 1.79 7.816 1.79 0.783 0 1.551-0.054 2.295-0.156 0.021 0.014 7.604 2.904 7.604 2.904s-2.484-4.517-2.492-4.544c3.127-1.701 5.159-4.452 5.159-7.555z"></path>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </section>
</div>
@endsection
