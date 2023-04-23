jQuery(document).ready(function($) {
  $('#fetch-camper-data').click(function() {
    $.ajax({
      url: dpCamper.ajaxurl,
      type: 'post',
      data: {
        action: 'dp_fetch_camper_data',
        nonce: dpCamper.nonce
      },
      success: function(response) {
        alert(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error: ' + textStatus + ' - ' + errorThrown);
      }
    });
  });
});
