@component('admin.components.card.collapse', [
    'srcIcon' => asset('/assets/images/icon/person.svg'),
    'title' => __('admin/store.card.user.title'),
])
    {{-- avatar: 写真選択 --}}
    <div class="row">
        <div class="col-2">
            <div class="mb-2 d-flex ">
                <p class=" mb-0">@lang('admin/store.card.user.input.avatar')</p>
            </div>
            @include('admin.components.input.upload_image', [
                'maxLength' => 1,
                'name' => 'avatar',
                'id' => 'avatar',
                'attribute' => __('admin/store.card.user.input.avatar')
            ])
        </div>
        <div class="col-10">
            <div class="row">
                <div class="col-6">
                    {{-- last_name: 姓 --}}
                    @include('admin.components.input.input_base', [
                        'label' => __('admin/store.card.user.input.last_name'),
                        'inputType' => 'text',
                        'inputName' => 'last_name',
                        'placeholder' => __('admin/store.card.user.placeholder.last_name'),
                        'boxLabelClass' => 'mb-2',
                        'requiredLabel' => true,
                        'inputValue' => old('last_name'),
                    ])
                </div>
                <div class="col-6">
                    {{-- first_name: 名  --}}
                    @include('admin.components.input.input_base', [
                        'label' => __('admin/store.card.user.input.first_name'),
                        'inputType' => 'text',
                        'inputName' => 'first_name',
                        'placeholder' => __('admin/store.card.user.placeholder.last_name'),
                        'boxLabelClass' => 'mb-2',
                        'requiredLabel' => true,
                        'inputValue' => old('first_name'),
                    ])
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    {{-- furigana_last_name: 姓フリガナ --}}
                    @include('admin.components.input.input_base', [
                        'label' => __('admin/store.card.user.input.furigana_last_name'),
                        'inputType' => 'text',
                        'inputName' => 'furigana_last_name',
                        'placeholder' => __('admin/store.card.user.placeholder.furigana_last_name'),
                        'boxLabelClass' => 'mb-2',
                        'requiredLabel' => true,
                        'inputValue' => old('furigana_last_name'),
                    ])
                </div>
                <div class="col-6">
                    {{-- furigana_first_name: 名フリガナ --}}
                    @include('admin.components.input.input_base', [
                        'label' => __('admin/store.card.user.input.furigana_first_name'),
                        'inputType' => 'text',
                        'inputName' => 'furigana_first_name',
                        'placeholder' => __('admin/store.card.user.placeholder.furigana_first_name'),
                        'boxLabelClass' => 'mb-2',
                        'requiredLabel' => true,
                        'inputValue' => old('furigana_first_name'),
                    ])
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            {{-- TEL --}}
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.user.input.tel'),
                'inputType' => 'number',
                'inputName' => 'user_tel',
                'placeholder' => __('admin/store.card.user.placeholder.tel'),
                'boxLabelClass' => 'mb-2',
                'inputValue' => old('user_tel'),
            ])
        </div>
        <div class="col-6">
            {{-- FAX --}}
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.user.input.fax'),
                'inputType' => 'number',
                'inputName' => 'user_fax',
                'placeholder' => __('admin/store.card.user.placeholder.fax'),
                'boxLabelClass' => 'mb-2',
                'inputValue' => old('user_fax'),
            ])
        </div>
    </div>
    @include('admin.components.input.input_base', [
        'label' => __('admin/store.card.user.input.email'),
        'type' => 'text',
        'inputName' => 'user_email',
        'placeholder' => __('admin/store.card.user.placeholder.email'),
        'boxLabelClass' => 'mb-2',
        'requiredLabel' => true,
        'inputValue' => old('user_email'),
    ])
@endcomponent
