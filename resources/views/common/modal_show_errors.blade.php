@if(session()->has('modalId') && count($errors) > 0)
    @push('js')
        <script type="text/javascript">
            $(function() {
                const modal = @js(session()->get('modalId'));
                $(modal).modal('show');

                $(".btn-close").click(function () {
                    $(modal).modal('hide');
                });
            });
        </script>
    @endpush
    @php session()->forget(['modalId']); @endphp
@endif
