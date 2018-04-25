$(document).ready(function() {

  $("#enable_editing").on('click', function () {
    // GENDEr
    $('select[name=gender] option')
    .filter(function () { return $(this).html() == gender; })
    .prop('selected', true);

    // CIVIL STATUS
    $('select[name=civil_status] option')
    .filter(function () { return $(this).html() == civil_status; })
    .prop('selected', true);

    // REAL ESTATE RECORD TPYE
    $("input[name=real_estate_record_type][value=" + real_estate_record_type + "]").prop('checked', true);


    appendToDynamicPanel(real_estate_record_type, json_payload);
    setupDynamicPart(real_estate_record_type, json_payload);
  });

});

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
  <ul>
  <li>
  <label>Realty Firm</label>
  <input type="text" name="realty_firm" placeholder="Realty firm" required="required">
  </li>
  <li>
  <label># of Agents</label>
  <input type="number" min="0" name="num_of_agents" placeholder="# of agents" required="required">
  </li>
  <li>
  <label>TIN No.</label>
  <input type="text" name="tin_num" placeholder="TIN No." required="required">
  </li>
  <li>
  <label>Team Leader <span>(if applicable)</span></label>
  <input type="text" name="team_leader" placeholder="Team Leader (if applicable)">
  </li>
  <li>
  <label>PRC Reg. No.</label>
  <input type="text" maxlength="7" name="prc_reg_num" placeholder="PRC Reg. No." required="required">
  </li>
  <li>
  <label>HLURB Cert. of Registration</label>
  <input type="text" name="hlurb_cert" placeholder="HLURB Cert. of registration" required="required">
  </li>
  </ul>`;
}

function generateAgentPanel() {
  return `
  <ul>
  <li>
  <label>Affiliated Realty Firm</label>
  <input type="text" name="affiliated_realty_firm" placeholder="Affiliated Realty Firm" required="required">
  </li>
  <li>
  <label>Affiliated Broker</label>
  <input type="text" name="affiliated_broker" placeholder="Affiliated Broker" required="required">
  </li>
  <li>
  <label>TIN No.</label>
  <input type="text" name="tin_num" placeholder="TIN No." required="required">
  </li>
  </ul>
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
