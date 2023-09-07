$(function() {
  $('.eyes_password').click(function() {
    const passwordField = $(this).siblings('input');
    const passwordFieldType = passwordField.attr('type');
    const newFieldType = passwordFieldType === 'password' ? 'text' : 'password';
    const newImageSrc = passwordFieldType === 'password' ? showEye : closeEye;
    passwordField.attr('type', newFieldType);
    $(this).attr('src', newImageSrc);
  });
});
