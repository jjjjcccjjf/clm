$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=title]').removeAttr('required')
    $('textarea').removeAttr('required')
    $('input[type=file]').removeAttr('required')

    $('input[name=title]').val(payload.title)
    $('textarea').val(payload.description)
    $('form').attr('action', base_url + 'news/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=title]').attr('required', 'required')
    $('textarea').attr("required", 'required')
    $('input[type=file]').attr("required", 'required')

    $('form').attr('action', base_url + 'news/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    let p = prompt("Are you sure you want to delete this? Type DELETE to continue", "");
    if (p === 'DELETE') {
      const id = $(this).data('id')

      invokeForm(base_url + 'news/delete', {id: id});
    }
  })

  $('form').on('submit', function (){

    let p = $('input[name=password]').val()
    let cp = $('input[id=confirm_password]').val()

    if (!(p === cp)) {
      alert('Passwords don\'t match')
      return false
    }

  })

})
