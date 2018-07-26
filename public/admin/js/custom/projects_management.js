$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=title]').removeAttr('required')
    $('input[name=address]').removeAttr('required')
    $('input[name=total_land_area]').removeAttr('required')
    $('input[name=phases]').removeAttr('required')
    $('input[name=status]').removeAttr('required')
    $('input[type=file]').removeAttr('required')

    $('input[name=title]').val(payload.title)
    $('input[name=address]').val(payload.address)
    $('input[name=total_land_area]').val(payload.total_land_area)
    $('input[name=phases]').val(payload.phases)
    $('input[name=status]').val(payload.status)

    $('form').attr('action', base_url + 'admin/projects/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=title]').attr('required', 'required')
    // $('input[name=address]').attr('required', 'required') // unrequire these shits
    // $('input[name=total_land_area]').attr('required', 'required')
    // $('input[name=phases]').attr('required', 'required')
    // $('input[name=status]').attr('required', 'required')
    $('input[type=file]').attr("required", 'required')

    $('form').attr('action', base_url + 'admin/projects/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    if (confirm("Are you sure you want to delete this?")) {
      const id = $(this).data('id')

      invokeForm(base_url + 'admin/projects/delete', {id: id});
    }
  })

})
