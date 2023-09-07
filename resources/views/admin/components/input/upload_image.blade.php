@push('css')
    @vite(['resources/sass/common/image_upload.scss'])
@endpush

<div class="upload__box" id="{{ $id }}">
    <div class="upload__img-wrap">
        @if(isset($imageUrls) && count($imageUrls))
            @foreach($imageUrls as $url)
                @php
                    $imageUrl = $url['url'] ?? '';
                @endphp
                <div class="upload__img-box">
                    <div style="background-image: url('{{ $imageUrl }}')" class="img-bg"></div>
                </div>
            @endforeach
        @endif
    </div>

    @if(!isset($disabled) || !$disabled)
        <div class="upload__btn-box">
            <label class="upload__btn">
                <p>✙</p>
                <input @disabled(isset($disabled) && $disabled) name="{{ $name }}" type="file" multiple data-max_length="{{ $maxLength ?? 1 }}"
                    class="upload__inputfile">
            </label>
        </div>
    @endif
</div>

@if (isset($attribute))
    <div class="upload__btn-error error_message my-2" style="display: none;">
        @lang('validation.invalid_size_file', [
            'attribute' => $attribute,
        ])
    </div>
@endif

@push('js')
    <script>
        $(document).ready(function () {
            initializeImageUpload("{{ $id }}");
        });

        function initializeImageUpload(containerId) {
            var container = $('#' + containerId);
            var maxLength = parseInt(container.find('.upload__inputfile').data('max_length'));
            var imgWrap = container.find('.upload__img-wrap');
            var imgArray = [];
            var uploadBtn = container.find('.upload__btn');
            var uploadError = container.siblings('.upload__btn-error');

            container.on('change', '.upload__inputfile', function (e) {
                uploadError.hide();
                const selectedFiles = e.target.files;
                var remainingSlots = maxLength - imgArray.length;
                var filesToUpload = Array.from(selectedFiles).slice(0, Math.min(remainingSlots, selectedFiles.length));

                if (imgArray.length + filesToUpload.length > maxLength) {
                    filesToUpload = filesToUpload.slice(0, maxLength - imgArray.length);
                }

                filesToUpload.forEach(function (file) {
                    if (file.size > 10 * 1024 * 1024) {
                        uploadError.show();
                        return;
                    }
                    imgArray.push(file);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var html = `
                            <div class='upload__img-box'>
                                <div style='background-image: url(${e.target.result})' data-number='${imgWrap.find(".upload__img-close").length}' data-file='${file.name}' class='img-bg'>
                                    <div class='upload__img-close'></div>
                                </div>
                            </div>
                        `;
                        imgWrap.append(html);

                        if (imgArray.length === maxLength) uploadBtn.hide();
                        else uploadBtn.show();
                    };
                    reader.readAsDataURL(file);
                });
            });

            container.on('click', ".upload__img-close", function () {
                var file = $(this).parent().data("file");
                imgArray = imgArray.filter(img => img.name !== file);
                $(this).parent().parent().remove();
                updateFileInput(container, file);
                if (imgArray.length < maxLength) uploadBtn.show();
            });
        }

        function updateFileInput(container, fileToRemove) {
            var fileInput = container.find('.upload__inputfile')[0]; // Assuming only one file input
            var updatedFiles = new DataTransfer();
            Array.from(fileInput.files).forEach(file => {
                if (file.name !== fileToRemove) {
                    updatedFiles.items.add(file);
                }
            });
            fileInput.files = updatedFiles.files;
        }
    </script>
@endpush
