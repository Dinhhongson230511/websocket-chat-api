@if (session()->has('message'))
    @php
        $success = \App\Enums\ResponseStatus::SUCCESS->value;
    @endphp

    @push('js')
        <script>
            $(function() {
                toastr.options.timeOut = 3000;
                const status = @js(session()->get('status'));
                const message = @js(session()->get('message'));
                toastr.options.closeButton = true;
                if (typeof window.performance != 'undefined' && window.performance.navigation.type !== 2) {
                    if (status == @js($success)) toastr.success(message);
                    else toastr.error(message);
                }
            })
        </script>
    @endpush

    @php session()->forget(['status', 'message']); @endphp
@endif
