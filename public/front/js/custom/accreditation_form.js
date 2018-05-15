$(document).ready(function () {

  $("#accreditation_form").submit(function(e){

    var form_data = new FormData($(this)[0]);

    $('#acc_btn').attr('disabled', 'disabled');
    $('#acc_btn').val('Trying to submit...');

    $.ajax({
      url: base_url + 'login/accreditation_form',
      type: 'POST',
      data: form_data,
      success: function (res, textStatus, xhr) {
        if(xhr.status == 200 && res.code === 'ok'){
          $('#acc_btn').after('<h3 style="color:gold">'+ res.message +'</h3>')
          $('#acc_btn').remove();
        } else if (xhr.status === 200 && res.code === 'fail') {
          alert(res.message)
          $('#acc_btn').removeAttr('disabled');
          $('#acc_btn').val('SUBMIT');
        }
      },
      error: function(err){
        console.error(err);
      },
      cache: false,
      contentType: false,
      processData: false
    });

    e.preventDefault();
  });

})
