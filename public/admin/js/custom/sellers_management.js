$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=full_name]').val(payload.full_name)
    $('input[name=birth_date]').val(payload.birth_date)

    $('select[name=gender] option')
    .filter(function () { return $(this).html() == payload.gender; })
    .prop('selected', true);

    $('select[name=civil_status] option')
    .filter(function () { return $(this).html() == payload.civil_status; })
    .prop('selected', true);

    $('input[name=home_address]').val(payload.home_address)
    $('input[name=office_address]').val(payload.office_address)
    $('input[name=mobile_num]').val(payload.mobile_num)
    $('input[name=office_fax]').val(payload.office_fax)
    $('input[name=home_num]').val(payload.home_num)
    $('input[name=email]').val(payload.email)
    $("input[name=real_estate_record_type][value=" + payload.real_estate_record_type + "]").prop('checked', true);

    let json_payload = JSON.parse(payload.real_estate_record_payload);

    appendToDynamicPanel(payload.real_estate_record_type, json_payload);
    setupDynamicPart(payload.real_estate_record_type, json_payload);

    $('form').attr('action', base_url + 'admin/sellers/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form


    $('form').attr('action', base_url + 'admin/sellers/add')
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

      invokeForm(base_url + 'admin/sellers/delete', {id: id});
    }
  })

})
// DAT FUNCITON NAME DOE! BRUH
function setupDynamicPart(real_estate_record_type, json_payload) {

  $('input[name="real_estate_record_type"]').on('click', function(){
    appendToDynamicPanel(real_estate_record_type, json_payload);
  })

}

function appendToDynamicPanel(real_estate_record_type, json_payload) {
  let checkedVal = $('input[name=real_estate_record_type]:checked').val();
  let thingToAppend = generateBrokerAgentPanel(checkedVal);
  appendToEl($('#real_estate_record_dynamic'), thingToAppend);

  ///////////// This block is mainly for the Update ///////////
  try {
    if (real_estate_record_type === 'Broker') {
      initBrokerValues(json_payload);
    } else if (real_estate_record_type === 'Agent'){
      initAgentValues(json_payload);
    }

  } catch (e) {
    console.error(e.message());
  }
  ///////////// This block is mainly for the Update ///////////
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
  <input type="text" class="form-control" name="realty_firm" placeholder="Realty firm" required="required">
  </div>
  <div class="form-group col-md-6">
  <label ># of Agents</label>
  <input type="number" min="0" class="form-control" name="num_of_agents" placeholder="# of agents" required="required">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-md-6">
  <label >TIN No.</label>
  <input type="text" class="form-control" name="tin_num" placeholder="TIN No." required="required">
  </div>
  <div class="form-group col-md-6">
  <label >Team Leader (if applicable)</label>
  <input type="text" class="form-control" name="team_leader" placeholder="Team Leader (if applicable)">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-md-6">
  <label >PRC Reg. No.</label>
  <input type="text" class="form-control" name="prc_reg_num" placeholder="PRC Reg. No." required="required">
  </div>
  <div class="form-group col-md-6">
  <label >HLURB Cert. of registration</label>
  <input type="text" class="form-control" name="hlurb_cert" placeholder="HLURB Cert. of registration" required="required">
  </div>
  </div>
  `;
}

function generateAgentPanel() {
  return `
  <div class="row">
  <div class="form-group col-md-6">
  <label >Affiliated Realty Firm</label>
  <input type="text" class="form-control" name="affiliated_realty_firm" placeholder="Affiliated Realty Firm" required="required">
  </div>
  <div class="form-group col-md-6">
  <label >Affiliated Broker</label>
  <input type="text" class="form-control" name="affiliated_broker" placeholder="Affiliated Broker" required="required">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-md-6">
  <label >TIN No.</label>
  <input type="text" class="form-control" name="tin_num" placeholder="TIN No." required="required">
  </div>
  </div>
  `;
}

function initBrokerValues(payload) {
  $('input[name=realty_firm]').val(payload.realty_firm)
  $('input[name=num_of_agents]').val(payload.num_of_agents)
  $('input[name=tin_num]').val(payload.tin_num)
  $('input[name=team_leader]').val(payload.team_leader)
  $('input[name=prc_reg_num]').val(payload.prc_reg_num)
  $('input[name=hlurb_cert]').val(payload.hlurb_cert)
}

function initAgentValues(payload) {
  $('input[name=tin_num]').val(payload.tin_num)
  $('input[name=affiliated_broker]').val(payload.affiliated_broker)
  $('input[name=affiliated_realty_firm]').val(payload.affiliated_realty_firm)
}
