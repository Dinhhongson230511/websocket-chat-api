const customLabel = document.getElementById('customLabel');
$('#files').on('change', function() {
  var fileName = $(this).val().split('\\').pop();
  $('#customLabel').text(fileName ? fileName : customLabel.textContentt);
});
