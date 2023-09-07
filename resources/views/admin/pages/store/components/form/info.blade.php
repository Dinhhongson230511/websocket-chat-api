@component('admin.components.card.collapse', [
    'srcIcon' => asset('/assets/images/icon/company.svg'),
    'title' => __('admin/store.card.info.title'),
])
    <div class="row">
        <div class="col-6">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.name'),
                'inputType' => 'text',
                'inputName' => 'name',
                'placeholder' => __('admin/store.card.info.placeholder.name'),
                'boxLabelClass' => 'mb-2',
                'requiredLabel' => true,
                'inputValue' => old('name', $store->name ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
        <div class="col-6">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.furigana'),
                'inputType' => 'text',
                'inputName' => 'furigana',
                'placeholder' => __('admin/store.card.info.placeholder.furigana'),
                'boxLabelClass' => 'mb-2',
                'requiredLabel' => true,
                'inputValue' => old('furigana', $store->furigana ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.tel'),
                'inputType' => isset($store) ? 'text' : 'number',
                'inputName' => 'tel',
                'placeholder' => __('admin/store.card.info.placeholder.tel'),
                'boxLabelClass' => 'mb-2',
                'requiredLabel' => true,
                'inputValue' => old('tel', $store->tel ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
        <div class="col-6">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.fax'),
                'inputType' => isset($store) ? 'text' : 'number',
                'inputName' => 'fax',
                'placeholder' => __('admin/store.card.info.placeholder.fax'),
                'boxLabelClass' => 'mb-2',
                'requiredLabel' => true,
                'inputValue' => old('fax', $store->fax ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>
    <div class="row">
        @include('admin.components.input.input_base', [
            'label' => __('admin/store.card.info.content.email'),
            'inputType' => 'text',
            'inputName' => 'email',
            'placeholder' => __('admin/store.card.info.placeholder.email'),
            'boxLabelClass' => 'mb-2',
            'requiredLabel' => true,
            'inputValue' => old('email', $store->email ?? ''),
            'disabled' => Request::query('status') === 'detail' ? true : false,
        ])
    </div>
    <div class="row">
        <div class="col-12">
            @include('admin.components.input.input_postcode', [
                'label' => __('admin/store.card.info.content.post_code'),
                'inputType' => 'text',
                'inputName' => 'post_code',
                'id' => 'inputPostCodeId',
                'placeholder' => __('admin/store.card.info.placeholder.post_code'),
                'boxLabelClass' => 'mb-2',
                'postCodeClass' => [
                    'parent' => 'post-code',
                    'label' => 'post-code__label',
                ],
                'requiredLabel' => true,
                'btnLabel' => __('admin/store.card.info.content.btn_search_postcode'),
                'btnId' => 'btnSearchPostCode',
                'inputValue' => old('post_code', $store->post_code ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
        <div class="result invalid-post-code" id="result"></div>
    </div>
    <div class="row">
        <div class="col-4">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.prefecture'),
                'inputType' => 'text',
                'inputName' => 'prefecture',
                'id' => 'prefectureId',
                'placeholder' => __('admin/store.card.info.placeholder.prefecture'),
                'boxLabelClass' => 'mb-2',
                'requiredLabel' => true,
                'inputValue' => old('prefecture', $store->prefecture ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
        <div class="col-4">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.area'),
                'inputType' => 'text',
                'inputName' => 'area',
                'id' => 'areaId',
                'placeholder' => __('admin/store.card.info.placeholder.area'),
                'boxLabelClass' => 'mb-2',
                'requiredLabel' => true,
                'inputValue' => old('area', $store->area ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
        <div class="col-4">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.locality'),
                'inputType' => 'text',
                'inputName' => 'sub_area',
                'id' => 'subAreaId',
                'placeholder' => __('admin/store.card.info.placeholder.locality'),
                'boxLabelClass' => 'mb-2',
                'requiredLabel' => true,
                'inputValue' => old('sub_area', $store->sub_area ?? ''),
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
    </div>
    <div class="row">
        @include('admin.components.input.input_base', [
            'label' => __('admin/store.card.info.content.address_lines'),
            'inputType' => 'text',
            'inputId' => 'addressLine',
            'inputName' => 'address_lines',
            'placeholder' => __('admin/store.card.info.content.address_lines'),
            'boxLabelClass' => 'mb-2',
            'requiredLabel' => true,
            'inputValue' => old('address_lines', $store->address_lines ?? ''),
            'disabled' => Request::query('status') === 'detail' ? true : false,
        ])
    </div>
    <div class="row">
        <div class="col-5">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.lat'),
                'inputType' => 'text',
                'inputName' => 'lat',
                'inputId' => 'latitudeField',
                'placeholder' => __('admin/store.card.info.content.lat'),
                'boxLabelClass' => 'mb-2',
                'inputValue' => old('lat', $store->lat ?? ''),
                'requiredLabel' => true,
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
        <div class="col-5">
            @include('admin.components.input.input_base', [
                'label' => __('admin/store.card.info.content.long'),
                'inputType' => 'text',
                'inputName' => 'long',
                'inputId' => 'longitudeField',
                'placeholder' => __('admin/store.card.info.content.long'),
                'boxLabelClass' => 'mb-2',
                'inputValue' => old('long', $store->long ?? ''),
                'requiredLabel' => true,
                'disabled' => Request::query('status') === 'detail' ? true : false,
            ])
        </div>
        <div class="col-2 d-flex align-items-end">
            <a class="btn-modal-map my-2 is-disabled" id="buttonMapModal">
                {{ __('admin/store.btn.map') }}
            </a>
        </div>
        @include('admin.pages.store.components.modal.index')
    </div>
    <div class="col-12">
        @component('admin.components.input.multiple_select', [
            'selectId' => 'genre',
            'selectName' => 'genre',
            'label' => __('admin/course_registration.genre'),
            'optionGroups' =>  $categories,
            'selectedValues' => old('genre', $loadRelationDataStore['storeSubCategories'] ?? []),
            'requiredLabel' => true,
            'multiple' => true,
            'maximumSelectionLength' => 3,
            'disabled' => Request::query('status') === 'detail' ? true : false,
        ])
        @endcomponent
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="d-flex">
                <p class="m-0">{{ __('admin/store.card.info.content.business_hours') }}</p>
                <div class="required-text">*</div>
            </div>
            @error('business_hours')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @php
                $businessHoursIndex = 0;
            @endphp
            <div class="business_hours mt-2">
                @if (old('business_hours'))
                    @foreach (old('business_hours') as $key => $businessHours)
                        <div class="business_hours--item  mb-2 d-flex align-items-center"
                            data-item="{{ $businessHoursIndex }}">
                            <div class="dateTime">
                                <input type="text" class="timepicker form-control w-100"
                                    name="business_hours[{{ $businessHoursIndex }}][start_time]"
                                    value="{{ $businessHours['start_time'] }}">
                                <img src="{{ asset('assets/images/icon/time24.svg') }}" alt="time24">
                            </div>
                            <div class="align-middle mx-3">~</div>
                            <div class="dateTime">
                                <input type="text" class="timepicker form-control w-100"
                                    name="business_hours[{{ $businessHoursIndex }}][end_time]"
                                    value="{{ $businessHours['end_time'] }}">
                                <img src="{{ asset('assets/images/icon/time24.svg') }}" alt="time24">
                            </div>
                            @if ($businessHoursIndex + 1 == count(old('business_hours')))
                                <div class="btn ms-3 btn-sub d-none">-</div>
                                <div class="btn btn-primary ms-3 btn-plus">+</div>
                            @else
                                <div class="btn ms-3 btn-sub">-</div>
                            @endif
                        </div>
                        @php $businessHoursIndex++; @endphp
                    @endforeach
                @else
                    @if(isset($store) && Request::query('status'))
                        @foreach($store->businessHours as $businessHour)
                            <div class="business_hours--item d-flex align-items-center mt-2" data-item="{{ $businessHoursIndex }}">
                                <div class="dateTime">
                                    <input type="text" class="timepicker form-control w-100"
                                        value="{{ $businessHour->start_time }}"
                                        {{ Request::query('status') === 'edit' || Request::query('status') === 'create' ? '' : 'disabled' }}
                                    >
                                    <img src="{{ asset('assets/images/icon/time24.png') }}" alt="time24">
                                </div>
                                <div class="align-middle mx-3">~</div>
                                <div class="dateTime">
                                    <input type="text" class="timepicker form-control w-100"
                                        value="{{ $businessHour->end_time }}"
                                        {{ Request::query('status') === 'edit' || Request::query('status') === 'create' ? '' : 'disabled' }}
                                    >
                                    <img src="{{ asset('assets/images/icon/time24.png') }}" alt="time24">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="business_hours--item d-flex align-items-center" data-item="{{ $businessHoursIndex }}">
                            <div class="dateTime">
                                <input type="text" class="timepicker form-control w-100"
                                    name="business_hours[0][start_time]"
                                >
                                <img src="{{ asset('assets/images/icon/time24.png') }}" alt="time24">
                            </div>
                            <div class="align-middle mx-3">~</div>
                            <div class="dateTime">
                                <input type="text" class="timepicker form-control w-100"
                                    name="business_hours[0][end_time]"
                                >
                                <img src="{{ asset('assets/images/icon/time24.png') }}" alt="time24">
                            </div>
                            <div class="btn ms-3 btn-sub d-none">-</div>
                            <div class="btn btn-primary ms-3 btn-plus">+</div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endcomponent
