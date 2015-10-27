$(function() {
  var input = $('#ownerEmail');
  var messagebox = $('#ownerMessage');
  var foundbox = $('#ownerFound');

  $('#ownersubmit').prop('disabled', true);

  input.keyup(function(e) {
    var url = '/wallfly-mvc/public/api/owner/' + input.val();
    $.get(url, function(response) {
      if (response.found) {
        $('#ownersubmit').prop('disabled', false);
        foundbox.html(response.owner.firstname);
        messagebox.html('');
      } else {
        messagebox.html('Account with that email address does not exist');
        foundbox.html('');
        $('#ownersubmit').prop('disabled', true);
      }
    });
  });
});