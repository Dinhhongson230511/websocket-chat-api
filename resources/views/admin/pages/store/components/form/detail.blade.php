@component('admin.components.card.collapse', [
    'srcIcon' => asset('/assets/images/icon/company.svg'),
    'title' => __('admin/store.card.detail.title'),
])
    {{-- thumbnal: サムネイル --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="mb-2 d-flex ">
                <p class=" mb-0">@lang('admin/store.card.detail.images.thumbnail')</p>
            </div>
            @include('admin.components.input.upload_image', [
                'maxLength' => 1,
                'name' => 'thumbnail',
                'id' => 'thumbnail',
                'attribute' => __('admin/store.card.detail.images.thumbnail'),
                'imageUrls' => isset($loadRelationDataStore) && count($loadRelationDataStore['storeImageTypes']['thumbnails']) ? $loadRelationDataStore['storeImageTypes']['thumbnails'] : [],
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    {{-- exterior: 外観の画像 --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="mb-2 d-flex ">
                <p class=" mb-0">@lang('admin/store.card.detail.images.exterior')</p>
            </div>
            @include('admin.components.input.upload_image', [
                'maxLength' => 5,
                'name' => 'exterior_images[]',
                'id' => 'exteriorImage',
                'attribute' => __('admin/store.card.detail.images.exterior'),
                'imageUrls' => isset($loadRelationDataStore) && count($loadRelationDataStore['storeImageTypes']['exteriors']) ? $loadRelationDataStore['storeImageTypes']['exteriors'] : [],
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    {{-- interior: 内観の画像 --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="mb-2 d-flex ">
                <p class=" mb-0">@lang('admin/store.card.detail.images.interior')</p>
            </div>
            @include('admin.components.input.upload_image', [
                'maxLength' => 5,
                'name' => 'interior_images[]',
                'id' => 'interiorImages',
                'attribute' => __('admin/store.card.detail.images.interior'),
                'imageUrls' => isset($loadRelationDataStore) && count($loadRelationDataStore['storeImageTypes']['interiors']) ? $loadRelationDataStore['storeImageTypes']['interiors'] : [],
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    {{-- cooking: 料理の画像 --}}
    <div class="row">
        <div class="col-12">
            <div class="mb-2 d-flex ">
                <p class=" mb-0">@lang('admin/store.card.detail.images.cooking')</p>
            </div>
            @include('admin.components.input.upload_image', [
                'maxLength' => 5,
                'name' => 'cooking_images[]',
                'id' => 'cookingImages',
                'attribute' => __('admin/store.card.detail.images.cooking'),
                'imageUrls' => isset($loadRelationDataStore) && count($loadRelationDataStore['storeImageTypes']['cookImages']) ? $loadRelationDataStore['storeImageTypes']['cookImages'] : [],
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    {{-- max_people: 団体受け入れ最大人数 --}}
    <div class="row mt-2">
        <div class="col-12">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.max_people'),
                'inputType' => 'number',
                'inputName' => 'max_people',
                'placeholder' => __('admin/store.card.info.placeholder.max_people'),
                'boxLabelClass' => 'mb-2',
                'requiredLabel' => true,
                'inputValue' => old('max_people', $store->max_people ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    {{-- roomSeatTypes - 個室＆席タイプ  --}}
    @include('admin.components.input.select_multiple2', [
        'class' => 'col-12 mb-2',
        'label' => __('admin/store.card.info.content.room_seat_type'),
        'options' => $roomSeatTypes,
        'name' => 'room_seat_type[]',
        'valueSelect' => $loadRelationDataStore['roomSeatTypesStore'] ?? [],
        'disabled' => Request::query('status') === 'detail' ? true : false,
    ])

    {{-- smoking_policy: 喫煙 --}}
    <div class="form_input_radio">
        <div class="form_input_radio--title">
            <div class="mt-2 d-flex">
                <p class="m-0">{{ __('admin/store.card.info.content.smoking_policy') }}</p>
                <div class="required-text">*</div>
            </div>
            @error('smoking_policy')
                <div class="error_message" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="form_input_radio--content">
            @include('admin.components.input.input_radio', [
                'inputId' => 'smoking',
                'inputName' => 'smoking_policy',
                'value' => __('admin/store.card.info.radio.smoking_policy.smoking'),
                'inputLabel' => __('admin/store.card.info.radio.smoking_policy.smoking'),
                'checked' => isset($store) && $store->smoking_policy == \App\Enums\StoreSmockingType::SMOCKING->value || Request::query('status') != 'detail' ? true : false,
                'oldValueChecked' => old('smoking_policy') ==__('admin/store.card.info.radio.smoking_policy.smoking'),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
            @include('admin.components.input.input_radio', [
                'classSubContent' => 'd-flex align-items-end',
                'inputId' => 'noSmoking',
                'inputName' => 'smoking_policy',
                'value' => __('admin/store.card.info.radio.smoking_policy.no_smoking'),
                'inputLabel' => __('admin/store.card.info.radio.smoking_policy.no_smoking'),
                'oldValueChecked' => old('smoking_policy') == __('admin/store.card.info.radio.smoking_policy.no_smoking'),
                'checked' => isset($store) && $store->smoking_policy == \App\Enums\StoreSmockingType::NO_SMOCKING->value ? true : false,
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
            @include('admin.components.input.input_radio', [
                'classSubContent' => 'd-flex align-items-end',
                'inputId' => 'areaSmoking',
                'inputName' => 'smoking_policy',
                'value' => __('admin/store.card.info.radio.smoking_policy.area_smoking'),
                'inputLabel' => __('admin/store.card.info.radio.smoking_policy.area_smoking'),
                'oldValueChecked' => old('smoking_policy') == __('admin/store.card.info.radio.smoking_policy.area_smoking'),
                'checked' => isset($store) && $store->smoking_policy == \App\Enums\StoreSmockingType::AREA_SMOCKING->value ? true : false,
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    {{-- parking: 駐車場 --}}
    <div class="form_input_radio">
        <div class="form_input_radio--title">
            <div class="mt-2 d-flex">
                <p class="m-0">{{ __('admin/store.card.info.content.parking') }}</p>
                <div class="required-text">*</div>
            </div>
            @error('parking')
                <div class="error_message" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
        <div class="form_input_radio--content">
            @include('admin.components.input.input_radio', [
                'inputId' => 'parkingYes',
                'inputName' => 'parking',
                'value' => __('admin/store.card.info.radio.yes'),
                'inputLabel' => __('admin/store.card.info.radio.yes'),
                'checked' => true,
                'oldValueChecked' => old('parking') == __('admin/store.card.info.radio.yes'),
                'checked' => isset($store) && $store->parking == \App\Enums\StoreParkingType::PARKING->value || Request::query('status') != 'detail' ? true : false,
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
            @include('admin.components.input.input_radio', [
                'classSubContent' => 'd-flex align-items-end',
                'inputId' => 'noParking',
                'inputName' => 'parking',
                'value' => __('admin/store.card.info.radio.no'),
                'inputLabel' => __('admin/store.card.info.radio.no'),
                'oldValueChecked' => old('parking') == __('admin/store.card.info.radio.no'),
                'checked' => isset($store) && $store->parking == \App\Enums\StoreParkingType::NO_PARKING->value ? true : false,
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    {{-- parking_remarks: 駐車場備考 --}}
    <div class="row">
        <div class="col-12">
            @include('admin.components.input.textarea', [
                'label' => __('admin/store.card.info.content.parking_remarks'),
                'inputName' => 'parking_remarks',
                'placeholder' => __('admin/store.card.info.placeholder.parking_remarks'),
                'inputValue' => old('parking_remarks', $store->parking_remarks ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    {{-- boarding_place: 乗降場所 --}}
    <div class="row">
        <div class="col-12">
            @component('admin.components.input.textarea', [
                'label' => __('admin/store.card.info.content.boarding_place'),
                'inputName' => 'boarding_place',
                'placeholder' => __('admin/store.card.info.placeholder.boarding_place'),
                'inputValue' => old('boarding_place', $store->boarding_place ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            {{-- allergy_compantibilities: アレルギー対応 --}}
            @include('admin.components.input.select_multiple2', [
                'class' => 'col-12 mb-2',
                'label' => __('admin/store.card.info.content.allergy_friendly'),
                'options' => $allergyCompatibilities,
                'name' => 'allergy_compatibilities[]',
                'valueSelect' => $loadRelationDataStore['storeAllergyCompatibilities'] ?? [],
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
        <div class="col-6">
            {{-- dietary_restrictions: 食事制限  --}}
            @include('admin.components.input.select_multiple2', [
                'class' => 'col-12 mb-2',
                'label' => __('admin/store.card.info.content.dietary_restrictions'),
                'options' => $dietaryRestrictions,
                'name' => 'dietary_restrictions[]',
                'valueSelect' => $loadRelationDataStore['storeDietaryRestrictions'] ?? [],
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

   {{-- layout_diagrams - レイアウト図 --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="mb-2 d-flex ">
                <p class=" mb-0">@lang('admin/store.card.detail.images.layout')</p>
            </div>
            @include('admin.components.input.upload_image', [
                'maxLength' => 3,
                'name' => 'layout_diagrams[]',
                'id' => 'layoutDiagrams',
                'attribute' => __('admin/store.card.detail.images.layout'),
                'imageUrls' => isset($loadRelationDataStore) && count($loadRelationDataStore['storeImageTypes']['layoutImages']) ? $loadRelationDataStore['storeImageTypes']['layoutImages'] : [],
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <label for="idCP" role="button">{{ __('admin/store.card.detail.cp') }}</label>
            <input {{ Request::query('status') === 'detail' ? 'disabled' : '' }} type="checkbox" role="button" id="idCP" name="cp" value="有り" {{ old('cp', $store->cp ?? '') ? 'checked' : '' }} >
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @component('admin.components.input.checkbox_multiple', [
                'label' => __('admin/store.card.info.content.available_days'),
                'name' => 'day_ids[]',
                'checkboxes' => $days,
                'checkBoxValues' => old('day_ids', $loadRelationDataStore['storeHolidays'] ?? []),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
            @endcomponent
        </div>
    </div>
@endcomponent
