$(document).ready(function() {

  $("#imagemakanan").change(function(){
    updatePlaceholder(this);
  });

  $("#imageprofil").change(function(){
    updatePlaceholder1(this);
  });



  // file upload
  function updatePlaceholder(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#imagemakanan').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  function updatePlaceholder1(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#imageprofil').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

});