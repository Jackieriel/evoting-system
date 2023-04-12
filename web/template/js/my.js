$(document).ready(function () {
  $('#image-file-input').change(function () {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#image-preview').attr('src', e.target.result).show();
    };
    reader.readAsDataURL($(this)[0].files[0]);
  });
});



