$(function() {
  var selector = $('#assignmode');
  $('#assignExistingForm').hide();
  $('#submit2').prop('disabled', true);

  selector.change(function(e) {
    var selection = $(this).val();
    if (selection === 'existing') {
      $('#assignNewForm').hide();
      $('#assignExistingForm').show();
    } else if (selection === 'new') {
      $('#assignExistingForm').hide();
      $('#assignNewForm').show();
    }
  });

  $('#email2').keyup(function() {
    var email = $(this).val();

    var url = '/wallfly-mvc/public/api/tenantcheck/' + email;
    $.get(url, function(response) {
      if (response.available) {
        $('#tenantError').html('Account does not exist!');
        $('#submit2').prop('disabled', true);
      } else {
        $('#tenantError').html('');
        $('#submit2').prop('disabled', false);
      }
    });
  });

});