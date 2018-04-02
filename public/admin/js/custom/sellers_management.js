$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=title]').val(payload.title)
    $('textarea').val(payload.description)
    $('input[type=date]').val(payload.date)

    $('form').attr('action', base_url + 'sellers/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form


    $('form').attr('action', base_url + 'sellers/add')
    $('.modal').modal()

    $('#chk_broker').prop("checked", true);

    appendToDynamicPanel();
    setupDynamicPart();
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    let p = prompt("Are you sure you want to delete this? Type DELETE to continue", "");
    if (p === 'DELETE') {
      const id = $(this).data('id')

      invokeForm(base_url + 'sellers/delete', {id: id});
    }
  })

})
// DAT FUNCITON NAME DOE! BRUH
function setupDynamicPart() {
  $('input[name="real_estate_record_type"]').on('click', function(){
      appendToDynamicPanel();
  })
}

function appendToDynamicPanel() {
  let checkedVal = $('input[name=real_estate_record_type]:checked').val();
  let thingToAppend = generateBrokerAgentPanel(checkedVal);
  appendToEl($('#real_estate_record_dynamic'), thingToAppend);
}

function generateBrokerAgentPanel(t) {
  c = '';
  switch (t) {
    case 'Agent':
    c = generateAgentPanel();
    break;

    case 'Broker':
    default:
    c = generateBrokerPanel();
    break;
  }

  return c;
}

function generateBrokerPanel() {
  return `
  <div class="row">
  <div class="form-group col-md-6">
  <label >Realty firm</label>
  <input type="text" class="form-control" name="realty_firm" placeholder="Realty firm">
  </div>
  <div class="form-group col-md-6">
  <label ># of Agents</label>
  <input type="text" class="form-control" name="num_of_agents" placeholder="# of agents">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-md-6">
  <label >TIN No.</label>
  <input type="text" class="form-control" name="tin_num" placeholder="TIN No.">
  </div>
  <div class="form-group col-md-6">
  <label >Team Leader (if applicable)</label>
  <input type="text" class="form-control" name="team_leader" placeholder="Team Leader (if applicable)">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-md-6">
  <label >PRC Reg. No.</label>
  <input type="text" class="form-control" name="prc_reg_num" placeholder="PRC Reg. No.">
  </div>
  <div class="form-group col-md-6">
  <label >HLURB Cert. of registration</label>
  <input type="text" class="form-control" name="hlurb_cert" placeholder="HLURB Cert. of registration">
  </div>
  </div>
  `;
}

function generateAgentPanel() {
  return `
  <div class="row">
  <div class="form-group col-md-6">
  <label >Affiliated Realty Firm</label>
  <input type="text" class="form-control" name="affiliated_realty_firm" placeholder="Affiliated Realty Firm">
  </div>
  <div class="form-group col-md-6">
  <label >Affiliated Broker</label>
  <input type="text" class="form-control" name="affiliated_broker" placeholder="Affiliated Broker">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-md-6">
  <label >TIN No.</label>
  <input type="text" class="form-control" name="tin_num" placeholder="TIN No.">
  </div>
  </div>
  `;
}
