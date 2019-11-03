const MSG01 = '20文字以内で入力してください';
const MSG02 = '半角英数字で入力してください';
const MSG03 = '8~20文字で入力してください';

var win = window;

$(win).on('load', function(){
  $('body').fadeIn(200);
});

$('#name').keyup(function(){
  var form_g = $(this).closest('.form-group');
  if($(this).val().length === 0){
    form_g.removeClass('has-success').addClass('has-error');
    form_g.find('.help-block').text(MSG01);
  }else{
    form_g.removeClass('has-error').addClass('has-success');
    form_g.find('.help-block').text('');
  }
})

$('#id').keyup(function(){
  var form_g = $(this).closest('.form-group');
  if($(this).val().length === 0 || $(this).val().length < 8){
    form_g.removeClass('has-success').addClass('has-error');
    form_g.find('.help-block').text(MSG03);
  }else if(!$(this).val().match(/^[A-Za-z0-9]*$/)){
    form_g.removeClass('has-success').addClass('has-error');
    form_g.find('.help-block').text(MSG02);
  }else{
    form_g.removeClass('has-error').addClass('has-success');
    form_g.find('.help-block').text('');
  }
})

$('#pass').keyup(function(){
  var form_g = $(this).closest('.form-group');
  if($(this).val().length < 8){
    form_g.removeClass('has-success').addClass('has-error');
    form_g.find('.help-block').text(MSG03);
  }else if(!$(this).val().match(/^[a-zA-Z0-9!#$%&()*+,.:;=?@\[\]^_{}-]+$/)){
    form_g.removeClass('has-success').addClass('has-error');
    form_g.find('.help-block').text(MSG02);
  }else{
    form_g.removeClass('has-error').addClass('has-success');
    form_g.find('.help-block').text('');
  }
})
