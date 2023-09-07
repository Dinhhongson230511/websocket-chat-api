$(document).ready(function () {
  checkFoodTye();
  handleSelectAllStore();
  $('select[name="food_type_id"]').on('change', function () {
    checkFoodTye();
  });
  $('.datetimepicker').datetimepicker({
    timepicker: false,
    format: "Y/m/d",
  });
  $('.timepicker').datetimepicker({
    datepicker: false,
    format: "H:i",
  });
  $('#allStores').on('change', function () {
    handleSelectAllStore(this.checked);
  })
});

function checkFoodTye() {
  var selectedValue = $('select[name="food_type_id"]').val();
  var foodTypeMainCourse = $('#foodTypeMainCourse').val();
  if (selectedValue !== foodTypeMainCourse) {
    $('.style-food-1').addClass('hidden');
  } else {
    $('.style-food-1').removeClass('hidden');
  }
}

function handleSelectAllStore(checked) {
  checked = checked === undefined ? $('#allStores').is(':checked') : checked;
  $('#storeId').prop('disabled', checked)
  if (checked) {
    $('#storeId').val([]).trigger('change');
  }
}
