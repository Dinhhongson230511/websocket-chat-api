$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
  });

  $('.card_custom--title').on('click', function () {
    $(this).toggleClass('border-radius');
    $(this).find('.card_custom--title-right').toggleClass('transform-rotate-180');
    $(this).siblings('.card_custom--content').toggleClass('d-none');
  })

  $('.btn-save').on('click', function () {
    $('.modal').show();
  });

  flatpickr(".start_date");
  flatpickr(".end_date");

  $('.datetimepicker').datetimepicker({
    timepicker: false,
    format: "Y/m/d",
  });

  $('.timepicker').datetimepicker({
    datepicker: false,
    step: 30,
    format: "H:i",
  });
  $('.eyes_password').click(function() {
    const passwordField = $(this).siblings('input');
    const passwordFieldType = passwordField.attr('type');
    const newFieldType = passwordFieldType === 'password' ? 'text' : 'password';
    const newImageSrc = passwordFieldType === 'password' ? showEye : closeEye;
    passwordField.attr('type', newFieldType);
    $(this).attr('src', newImageSrc);
  });
  $('input[type=number]').on('keypress', function (event) {
    const { which } = event;
    const keyCodeNumberStart = 48; // 0
    const keyCodeNumberEnd = 57; // 9
    const keyCodeNumberNumpadStart = 96; // Numpad 0
    const keyCodeNumberNumpadEnd = 105; // Numpad 9
    // 48 -> 57 : 0 -> 9
    // 96 -> 105 : 0 -> 9 (Enable Num Lock)
    if (!((which >= keyCodeNumberStart && which <= keyCodeNumberEnd)
      || (which >= keyCodeNumberNumpadStart && which <= keyCodeNumberNumpadEnd)))
    {
      event.preventDefault();
    }
  });
  $('input[type=number]').on('input', function (event) {
    const { target } = event;
    const { value } = target;
    if (+value === 0) {
      $(this).val('');
    }
  });
});
