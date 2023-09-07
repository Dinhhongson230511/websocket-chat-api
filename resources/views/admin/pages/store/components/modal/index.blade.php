<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="auth__container--form">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">@lang('admin/store.modal.title')</h2>
                    <button type="button" class="btn-close" id="btnCloseMapModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input id="pac-input" class="controls" type="text" placeholder="Search Box" />
                    <div id="map"></div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="submitLatLog" class="btn btn-primary" data-bs-dismiss="modal">@lang('admin/store.btn.get_lat_lng')</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('const.api_key_map') }}&callback=initMap&libraries=places&v=weekly&language=ja" async></script>
    <script>
        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            // 13 is key of enter key
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        let lat, lng;
        let map, myMarker, searchBox, geocoder, infoWindow;
        let oldValue = "";

        function initMap() {
            const area = {
                lat: 35.68294120549073,
                lng: 139.76687997680727,
            }

            map = new google.maps.Map(document.getElementById("map"), {
                center: area,
                zoom: 16,
                mapTypeId: "roadmap",
            });

            const input = document.getElementById("pac-input");

            searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            geocoder = new google.maps.Geocoder;
            myMarker = new google.maps.Marker({
                position: area,
                draggable: true,
                map: map,
            })

            infoWindow = new google.maps.InfoWindow();
            google.maps.event.addListener(myMarker, 'dragend', function(e) {
                map.setCenter(this.getPosition()); // Set map center to marker position
                lat = this.getPosition().lat();
                lng = this.getPosition().lng();
                geocoder.geocode({
                    'latLng': e.latLng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var address_components = results[0].address_components;
                            let components = extractFromAdress(address_components);
                            const prefecture = components.administrative_area_level_1;
                            const area = components.locality;
                            const subArea = components.sublocality;
                            const postCode = (components?.postal_code ?? "");

                            const addressComponents = [
                                components?.sublocality_level_2,
                                components?.sublocality_level_3,
                                components?.sublocality_level_4,
                                components?.premise,
                                components?.subpremise
                            ];

                            const addressLine = addressComponents.filter(Boolean).join('');
                            oldValue = addressLine;
                            $('#pac-input').val(prefecture + area + subArea + addressLine);
                            setDataPostCode(prefecture, area, subArea, addressLine, postCode);
                            setAndOpenTitle(results[0]);
                        }
                    }
                });
            });
        }

        window.initMap = initMap;

        $('#submitLatLog').on('click', function(e) {
            e.preventDefault();
            $('#longitudeField').val(lng);
            $('#latitudeField').val(lat);
            $('#mapModal').modal('hide');
        })

        function setLocationCoordinates(myMarker, lat, lng) {
            var latlng = new google.maps.LatLng(lat, lng);
            myMarker.setPosition(latlng);
        }

        const setDataPostCode = (prefecture = '', area = '', subArea = '', addressLine = '', postCode = '') => {
            $('input[name="prefecture"]').val(prefecture);
            $('input[name="address_lines"]').val(addressLine);
            $('input[name="area"]').val(area);
            $('input[name="sub_area"]').val(subArea);
            $('input[name="post_code"]').val(postCode);
        }

        const extractFromAdress = (address_components) => {
            let components = {};
            $.each(address_components, function(k, v1) {
                $.each(v1.types, function(k2, v2) {
                    components[v2] = v1.long_name
                });
            });

            return components;
        }

        const setAndOpenTitle = (item) => {
            myMarker.setTitle(item.formatted_address);
            myMarker.addListener("click", () => {
                infoWindow.close();
                infoWindow.setContent(myMarker.getTitle());
                infoWindow.open(myMarker.getMap(), myMarker);
            });
        }

        $(function() {
            $('#buttonMapModal').on('click', function (e) {
                if ($(this).hasClass('is-disabled')) {
                    e.preventDefault();
                } else {
                    const prefectureName = $('input[name="prefecture"]').val();
                    const areaName = $('input[name="area"]').val();
                    const subAreaName = $('input[name="sub_area"]').val();
                    const addressLine = $('input[name="address_lines"]').val();
                    const textAddress = prefectureName + areaName + subAreaName + addressLine;
                    $('#pac-input').val(textAddress);
                    const latInput = $('input[name="lat"]').val();
                    const lngInput = $('input[name="long"]').val();
                    let latlng = new google.maps.LatLng(latInput, lngInput);

                    let objectSearch;
                    if (oldValue === addressLine && (!!lat && !!lng)) {
                        objectSearch = { 'latLng': latlng };
                    } else {
                        objectSearch = { 'address': textAddress };
                    }

                    geocoder.geocode(objectSearch, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            $('#mapModal').modal("show");
                            lat = results[0].geometry.location.lat();
                            lng = results[0].geometry.location.lng();
                            map.setCenter({
                                lat: +lat,
                                lng: +lng,
                            });
                            setLocationCoordinates(myMarker, lat, lng);
                            let components = extractFromAdress(results[0].address_components);

                            const prefecture = components?.administrative_area_level_1;
                            const area = components?.locality;
                            const subArea = components?.sublocality;

                            const addressComponents = [
                                components?.sublocality_level_2,
                                components?.sublocality_level_3,
                                components?.sublocality_level_4,
                                components?.premise,
                                components?.subpremise
                            ];

                            const addressLine = addressComponents.filter(Boolean).join('');
                            const postCode = (components?.postal_code ?? "");
                            oldValue = addressLine;
                            setDataPostCode(prefecture, area, subArea, addressLine, postCode);
                            setAndOpenTitle(results[0]);
                        } else {
                            alert(notFoundAddress);
                        }
                    })
                }
            });
        })
    </script>
@endpush
