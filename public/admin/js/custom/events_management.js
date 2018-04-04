$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=title]').removeAttr('required')
    $('textarea').removeAttr('required')
    $('input[type=file]').removeAttr('required')
    $('input[type=date]').attr("required", 'required')
    // $('input[type=date]').removeAttr('required')

    $('input[name=title]').val(payload.title)
    $('input[name=read_more_url]').val(payload.read_more_url)
    $('input[name=read_more_label]').val(payload.read_more_label)
    $('textarea').val(payload.description)
    $('input[type=date]').val(payload.date)

    $('form').attr('action', base_url + 'admin/events/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=title]').attr('required', 'required')
    $('textarea').attr("required", 'required')
    $('input[type=file]').attr("required", 'required')
    $('input[type=date]').attr("required", 'required')

    $('form').attr('action', base_url + 'admin/events/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    let p = prompt("Are you sure you want to delete this? Type DELETE to continue", "");
    if (p === 'DELETE') {
      const id = $(this).data('id')

      invokeForm(base_url + 'admin/events/delete', {id: id});
    }
  })

})
