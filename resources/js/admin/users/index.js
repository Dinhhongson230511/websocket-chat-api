$(function() {
  $('#btnClose').on('click', function () {
    const listInputs = $('.input-list input');
    listInputs.each(function() {
      $(this).val('');
      if ($(this).hasClass('is-invalid')) {
        $(this).removeClass('is-invalid');
      }
    });
  })
  $('select[name=store_id]').on('change', function () {
    $('#form-select-store').submit();
  })
});
