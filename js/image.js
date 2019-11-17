$('.input-img').on('change', function(e){
  var file = this.files[0];
  var img = $('.icon');
  var fileReader = new FileReader();
  console.log(file);
  fileReader.onload = function(event){
    img.attr('src', event.target.result).show();
  }
  fileReader.readAsDataURL(file);
});
