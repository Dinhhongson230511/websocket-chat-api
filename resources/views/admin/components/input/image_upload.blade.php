@push('css')
    @vite(['resources/sass/admin/image_upload.scss'])
@endpush

<div class="upload__box" id="{{$id}}">
    <div class="upload__img-wrap"></div>
    <div class="upload__btn-box">
        <label class="upload__btn">
            <p>✙</p>
            <input name="{{ $name }}" type="file" multiple data-max_length="{{ $maxLength ?? 1 }}"
                   class="upload__inputfile">
        </label>
    </div>
    @error($name ?? '')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @php
        $imagesErrors = $errors->get(str_replace('[]', '.*', $name));
    @endphp

    @if (!empty($imagesErrors))
        @foreach ($imagesErrors as $error)
            <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $error[0] }}</strong>
        </span>
        @endforeach
    @endif
</div>

@push('js')
    <script>
        $(document).ready(function () {
            var containerId = "{{ $id }}";
            var container = $('#' + containerId);
            container.each(function () {
                initializeImageUpload($(this));
            });
        });

        function initializeImageUpload(container) {
            var maxLength = parseInt(container.find('.upload__inputfile').attr('data-max_length'));
            var imgWrap = "";
            var imgArray = [];
            container.find('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    const selectedFiles = e.target.files;
                    if (selectedFiles.length > maxLength) {
                        const limitedFiles = Array.from(selectedFiles).slice(0, maxLength);
                        const dataTransfer = new DataTransfer();
                        limitedFiles.forEach(file => {
                            dataTransfer.items.add(file);
                        });
                        e.target.files = dataTransfer.files;
                    }
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    imgWrap.html(null);
                    imgArray = [];
                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function (f) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var html = "<div class='upload__img-box'>" +
                                        "<div style='background-image: url(" + e.target.result + ")' data-number='" +
                                        $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'>" +
                                        "<div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });
            container.on('click', ".upload__img-close", function () {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
                updateFileInput(container, file);
            });
        }

        function updateFileInput(container, fileToRemove) {
            var fileInput = container.find('.upload__inputfile')[0]; // Assuming only one file input
            var updatedFiles = new DataTransfer();
            for (var i = 0; i < fileInput.files.length; i++) {
                if (fileInput.files[i].name !== fileToRemove) {
                    updatedFiles.items.add(fileInput.files[i]);
                }
            }
            fileInput.files = updatedFiles.files;
        }
    </script>
@endpush
