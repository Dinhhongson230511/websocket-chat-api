const handleCheckedSubCategories = (value, checked = true) => {
  $.each(value?.sub_categories, function (key, val) {
    if (checked) {
      $('#child' + val?.id).on('click', function () {
        $('.sub-child-' + val?.id).toggleClass('d-none');
      });
    }

    if ($(`#checkSubCategory${val?.id}`).is(':checked')) {
      $.each(val.dishes, function (key, valDish) {
        $(`#dish${valDish?.id}`).prop('checked', true);
      });
    }
    $(`#checkSubCategory${val?.id}`).on('change', function () {
      if ($(this).is(':checked')) {
        $.each(val.dishes, function (key, valDish) {
          $(`#dish${valDish?.id}`).prop('checked', true);
        });
      } else {
        $.each(val.dishes, function (key, valDish) {
          $(`#dish${valDish?.id}`).prop('checked', false);
        });
      }
    })
  })
}

const handleBusinessHours = () => {
  const numberItem = $('.business_hours--item:last').attr('data-item');
  let rowCount = 0;
  if (numberItem) rowCount = parseInt(numberItem) + 1;
  $(document).on('click', '.btn-plus', function () {
    $('.btn-sub').removeClass('d-none');
    $('.btn-plus').addClass('d-none');
    const html = `
      <div class="business_hours--item d-flex align-items-center mt-2" data-item="${rowCount}">
        <div class="dateTime">
          <input type="text" class="timepicker form-control w-100" name="business_hours[${rowCount}][start_time]">
          <img src="${imageTime}" alt="time24">
        </div>
        <div class="align-middle mx-3">~</div>
        <div class="dateTime">
          <input type="text" class="timepicker form-control w-100" name="business_hours[${rowCount}][end_time]">
          <img src="${imageTime}" alt="time24">
        </div>
        <div class="btn ms-3 btn-sub d-none">-</div>
        <div class="btn btn-primary ms-3 btn-plus">+</div>
      </div>
    `;
    $('.business_hours').append(html);
    $('.timepicker').datetimepicker({
      datepicker: false,
      step: 30,
      format: "H:i",
    });
    rowCount++;
  });
  $(document).on('click', '.btn-sub', function () {
    if ($('.business_hours .business_hours--item').length > 1) {
      $(this).parent().remove();
    }
  });
}

const setDataPostCode = (prefecture = '', area = '', subArea = '') => {
  $('input[name="prefecture"]').val(prefecture);
  $('input[name="area"]').val(area);
  $('input[name="sub_area"]').val(subArea);
}

$(function () {
  $('#addressLine').change(function () {
    const addressLine = $(this).val();
    $('#buttonMapModal').data('address-line', addressLine);
  });

  $.each(categories, function (key, value) {
    $('.parent-' + value?.id).on('click', function () {
      $('.child-' + value?.id).toggleClass('d-none');
      handleCheckedSubCategories(value, true);
    });

    $('#category' + value?.id).on('click', function () {
      if ($(this).is(':checked')) {
        $.each(value?.sub_categories, function (key, val) {
          $('.parent-' + value?.id).next().find('#checkSubCategory' + val?.id).prop('checked', true);
        });
      } else {
        $.each(value?.sub_categories, function (key, val) {
          $('.parent-' + value?.id).next().find('#checkSubCategory' + val?.id).prop('checked', false);
        });
      }
    })
  });

  $('#btnSearchPostCode').on('click', function (e) {
    e.preventDefault();
    const postCode = $('#inputPostCodeId').val();
    var xhr = new XMLHttpRequest();

    var url = `https://maps.googleapis.com/maps/api/geocode/json?key=${apiKey}&components=postal_code:${postCode}&language=ja`;

    xhr.open("GET", url);

    xhr.onload = function () {
      if (xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);

        if (response.status == "OK") {
          var address = response.results[0];

          let components = {};
          $.each(address.address_components, function(k, v1) {
              $.each(v1.types, function(k2, v2) {
                  components[v2] = v1.long_name
              });
          });

          const prefecture = components?.administrative_area_level_1;
          const area = components?.locality;
          const subArea = components?.sublocality;

          $('input[name="address_lines"]').val("");

          setDataPostCode(prefecture, area, subArea)
          document.getElementById("result").innerHTML = "";
        } else {
          document.getElementById("result").innerHTML = mgsNotFound;
          setDataPostCode();
        }
      } else {
        document.getElementById("result").innerHTML = apiGGError;
        setDataPostCode();
      }
    };

    xhr.send();
  });

  $('#addressLine').on('change', function (e) {
    $('#buttonMapModal').removeClass('is-disabled');
    if (!e.target.value) $('#buttonMapModal').addClass('is-disabled');
  })

  $('#btnCloseMapModal').on('click', function (e) {
    $('#mapModal').modal("hide");
  })
  handleBusinessHours();
})
