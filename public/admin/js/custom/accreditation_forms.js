$(document).ready(function() {

  initEvents();

  function initEvents(){
    $('.btn').unbind();

    $('.btn-delete').on('click', function(){
      if (confirm("Are you sure you want to delete this?")) {
        const id = $(this).data('id')
        invokeForm(base_url + 'admin/accreditation_forms/delete', {id: id});
      }
    })

    $('.btn-mark').on('click', function(){
      // if (confirm("Are you sure you want to mark this item as completed?")) {

        $(this).attr('disabled', 'disabled');
        const id = $(this).data('id')

        ajaxMark(id, 1, $(this))
      // }
    })

    $('.btn-unmark').on('click', function(){
      // if (confirm("Are you sure you want to unmark this item?")) {

        $(this).attr('disabled', 'disabled');
        const id = $(this).data('id')

        ajaxMark(id, 0, $(this))
      // }
    })

  }

  function ajaxMark(id, value, el){
    var type = '';

    if (value) {
      type = 'unmark';
    } else {
      type = 'mark';
    }

    $.ajax({
      url: base_url + 'admin/accreditation_forms/mark',
      type: 'POST',
      data: {id: id, value: value},
      success: function (res, textStatus, xhr) {
        if(xhr.status == 200 && res.code == 'ok'){
          // alert(res.message)

          el.after(createMarkBtn(id, type));
          initEvents();
          el.remove();
        }else{
          alert(res.message);
          el.removeAttr('disabled');
        }
      },
      error: function(err){
        console.error(err);
      }
    });
  }

  function createMarkBtn(id, type){

    if (type == 'mark') {
      var btn_content = 'Unmarked <i class="fa fa-times"></i>';
      var color = 'warning';
    }else {
      var btn_content = 'Completed <i class="fa fa-check"></i>';
      var color = 'success';
    }

    return `<button type='button' data-id='${id}'
    class='btn btn-${type} btn-${color} btn-xs'>${btn_content}</button>`;
  }

})
