$(document).ready(function() {

});

function initEventPanel(month, year) {
  let event_panel = requrestEventPanel(month, year)
}

function requrestEventPanel(month, year) {

  $.ajax({
    url: base_url + 'admin/events/eventsPerPeriod/' + month + "/" + year,
    type: 'GET',
    success: function (res, textStatus, xhr) {
      if(xhr.status == 200 && res.code === 'ok'){
        let eventPanel = generateEventPanel(res.data)
        console.log(res.data);
        appendToEl($('.events-list'), eventPanel)
      }else if (xhr.status == 200 && res.code === 'empty'){
        let blank = generateEventPanelBlank()
        appendToEl($('.events-list'), blank)
      }
    },
    // error: function(err){
    //   console.error(err);
    // }
  });
}


function generateEventPanel(data) {
  let eventPanel = "<ul>";
  for (var i = 0; i < data.length; i++) {
    eventPanel += `
    <li>
    <table>
    <tr>
    <td><h3>${data[i].day}</h3></td>
    <td>
    <ul>
    <li>
    <a href="${base_url + 'events' + '/' + data[i].month + '/' + data[i].year}">
    ${data[i].excerpt}</a>
    </li>
    <li>
    <a href="${base_url + 'events' + '/' + data[i].month + '/' + data[i].year}">
    ${data[i].title}</a>
    </li>
    </ul>
    </td>
    </tr>
    </table>
    </li>`;
  }
  eventPanel += "</ul>";

  return eventPanel;
}

function generateEventPanelBlank(){
  return '<p>No events available this month</p>';
}
