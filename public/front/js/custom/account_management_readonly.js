$(document).ready(function() {

  // GENDEr
  $('.gender option')
  .filter(function () { return $(this).html() == gender_r; })
  .prop('selected', true);

  // CIVIL STATUS
  $('.civil_status option')
  .filter(function () { return $(this).html() == civil_status_r; })
  .prop('selected', true);

  // REAL ESTATE RECORD TPYE
  $("input[name='real_estate_record_type_r'][value=" + real_estate_record_type_r + "]").prop('checked', true);

  appendToDynamicPanel_r(real_estate_record_type_r, json_payload_r);
  setupDynamicPart_r(real_estate_record_type_r, json_payload_r);

});

// DAT FUNCITON NAME DOE! BRUH
function setupDynamicPart_r(real_estate_record_type, json_payload) {

  $('input[name="real_estate_record_type_r"]').on('click', function(){
    appendToDynamicPanel_r(real_estate_record_type, json_payload);
  })

}

function appendToDynamicPanel_r(real_estate_record_type, json_payload) {
  let checkedVal = $('input[name="real_estate_record_type_r"]:checked').val();
  let thingToAppend = generateBrokerAgentPanel_r(checkedVal);
  appendToEl($('#real_estate_record_dynamic_readonly'), thingToAppend);

  ///////////// This block is mainly for the Update ///////////
  try {
    if (real_estate_record_type === 'Broker') {
      initBrokerValues_r(json_payload);
    } else if (real_estate_record_type === 'Agent'){
      initAgentValues_r(json_payload);
    }

  } catch (e) {
    console.error(e.message);
  }
  ///////////// This block is mainly for the Update ///////////
}

function generateBrokerAgentPanel_r(t) {
  c = '';
  switch (t) {
    case 'Agent':
    c = generateAgentPanel_r();
    break;

    case 'Broker':
    default:
    c = generateBrokerPanel_r();
    break;
  }

  return c;
}

function generateBrokerPanel_r() {
  return `
  <ul>
  <li>
  <label>Realty Firm</label>
  <input readonly type="text" class="realty_firm" placeholder="Realty firm" required="required">
  </li>
  <li>
  <label># of Agents</label>
  <input readonly type="number" class="num_of_agents" min="0" placeholder="# of agents" required="required">
  </li>
  <li>
  <label>TIN No.</label>
  <input readonly type="text" class="tin_num" placeholder="TIN No." required="required">
  </li>
  <li>
  <label>Team Leader <span>(if applicable)</span></label>
  <input readonly type="text" class="team_leader" placeholder="Team Leader (if applicable)">
  </li>
  <li>
  <label>PRC Reg. No.</label>
  <input readonly type="text" class="prc_reg_num" placeholder="PRC Reg. No." required="required">
  </li>
  <li>
  <label>HLURB Cert. of Registration</label>
  <input readonly type="text" class="hlurb_cert" placeholder="HLURB Cert. of registration" required="required">
  </li>
  </ul>`;
}

function generateAgentPanel_r() {
  return `
  <ul>
  <li>
  <label>Affiliated Realty Firm</label>
  <input readonly type="text" class="affiliated_realty_firm" placeholder="Affiliated Realty Firm" required="required">
  </li>
  <li>
  <label>Affiliated Broker</label>
  <input readonly type="text" class="affiliated_broker" placeholder="Affiliated Broker" required="required">
  </li>
  <li>
  <label>TIN No.</label>
  <input readonly type="text" class="tin_num" placeholder="TIN No." required="required">
  </li>
  </ul>
  `;
}

function initBrokerValues_r(payload) {
  console.log(payload);
  $('.realty_firm').val(payload.realty_firm)
  $('.num_of_agents').val(payload.num_of_agents)
  $('.tin_num').val(payload.tin_num)
  $('.team_leader').val(payload.team_leader)
  $('.prc_reg_num').val(payload.prc_reg_num)
  $('.hlurb_cert').val(payload.hlurb_cert)
}

function initAgentValues_r(payload) {
  $('.tin_num').val(payload.tin_num)
  $('.affiliated_broker').val(payload.affiliated_broker)
  $('.affiliated_realty_firm').val(payload.affiliated_realty_firm)
}
