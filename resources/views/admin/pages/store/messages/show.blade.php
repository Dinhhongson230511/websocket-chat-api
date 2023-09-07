@extends('admin.layout.index')

@push('css')
    @vite(['resources/sass/admin/message/_chat.scss'])
@endpush

@section('title', __('admin/company.title'))

@section('content')

<div class="messages-wrapper" id="app">
     <div class="row">
        <div class="col-xl-3 col-lg-4 pr-0">
            <!-- <h2 class="py-2 pl-5">Messages</h2> -->
        </div>
        <div class="col-xl-9 col-lg-8 pl-0">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-4 messages-list pr-0">
            <div id="inbox-chat" class="inbox-chat">
                <channel-list></channel-list>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 messages-main px-0">
            <div class="messages-main-heading">
                <div class="row align-items-center">
                    <div class="col-5">
                        <div class="messages-main-heading-title">
                            <h4 class="m-0">{{ $channel->display_name }}</h4>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="messages-main-heading-group">
                        </div>
                    </div>
                </div>
            </div>
            <div class="messages-main-wrapper">
                <message-list
                    :channel="{{ $channel }}" 
                    :url="'{{ route('admin.messages.showMessage', $channel->id) }}'"
                    :url_update_read="'{{ route('admin.messages.updateRead', $channel->id) }}'"
                ></message-list>
            </div>
            <div class="messages-main-type">
                <div class="messages-main-type-ipt">
                    <input type="text" id="message_input" class="write-msg" placeholder="{{ __('admin/messages.input_message_placeholder') }}">
                    <input id="image_upload" type="file" name="images" hidden accept="image/*" multiple />
                    <input id="attachments_upload" name="attachments" hidden type="file" multiple />
                </div>
                <div class="messages-main-type-btn">
                    <ul>
                        <li>
                            <!-- <button id="send_message_btn" style="background:blue;" class="btn btn-primary" type="button">
                                Send
                            </button> -->
                            <div class="btn-send-message" id="send_message_btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none" class="h-4 w-4 m-1 md:m-0" stroke-width="2">
                                    <path d="M.5 1.163A1 1 0 0 1 1.97.28l12.868 6.837a1 1 0 0 1 0 1.766L1.969 15.72A1 1 0 0 1 .5 14.836V10.33a1 1 0 0 1 .816-.983L8.5 8 1.316 6.653A1 1 0 0 1 .5 5.67V1.163Z" fill="currentColor"></path>
                                </svg>
                            </div>

                        </li>
                        <li>
                            <button type="button" id="button_image_upload">
                                <i class="nav-icon cil-image"></i>
                            </button>
                            <button type="button" class="d-none" id="button_image_upload_loadding">
                                <i class="fas fa-spinner fa-spin"></i>
                            </button>
                        </li>
                        <li>
                            <button type="button" id="button_attachments_upload">
                                <i class="nav-icon cil-paperclip"></i>
                            </button>
                            <button type="button" class="d-none" id="button_attachments_upload_loadding">
                                <i class="fas fa-spinner fa-spin"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        window.config = {
            urlLeft: '{!! route('admin.messages.showLeft', $channel->id)!!}',
            authEndpoint: '{{ route('admin.auth.check') }}',
            auth: {
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}",
                }
            },
            channel: '{!! json_encode($channel) !!}',
            pusher: '{{config('broadcasting.connections.pusher.key')}}',
        };

        var urlSendMessage = '{!! route('admin.messages.sendMessage', $channel->id)!!}';
    </script>
    <script src="{{ asset('assets/js/message.js') }}"></script>
    <script src="{{ asset('assets/js/messages.handle.js') }}"></script>
@endpush
