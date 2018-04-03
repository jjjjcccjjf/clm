$(document).ready(function() {

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=title]').attr('required', 'required')
    $('textarea[name=iframe_code]').attr('required', 'required')
    $('textarea[name=description]').attr('required', 'required')

    $('input[name=title]').val(payload.title)
    $('textarea[name=iframe_code]').val(payload.iframe_code)
    $('textarea[name=description]').val(payload.description)

    $('form').attr('action', base_url + 'admin/about/update/' + payload.id)
    $('.modal').modal()
  })

})
