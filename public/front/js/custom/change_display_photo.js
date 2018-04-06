$(document).ready(function() {
  $("#change_photo").on('submit', function(e){

    if(confirm("Really change display photo?")){
      return true;
    } else {
      return false;
    }
    
  });
});
