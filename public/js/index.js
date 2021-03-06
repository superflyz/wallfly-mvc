$(document).ready(function() {
  $('#realestate-login').hide();

  $.get('realest/names', function(realestates) {
    realestates.forEach(function(e) {
      $('<option value="' + e + '">' + e + '</option>').appendTo('#realestatelist');
    });
  });

  $('#usertypes').change(function(e) {
    if (e.target.value === 'real_estate') {
      // TODO change the email input to dropdown menu
      $('#email-login').hide();
      $('#realestate-login').show();
    } else {
      $('#realestate-login').hide();
      $('#email-login').show();
    }
  });

  $("#login")[0].reset();
  $('#username').val('');
  $('#passwrd').val('');


  $('#signup_form').validate({ // initialize the plugin
    rules: {
      username: {
        required: true,
        minlength: 5,
        alphanumeric: true,
        nowhitespace: true

      },
      password: {
        required: true,
        minlength: 6,
        alphanumeric: true,
        nowhitespace: true
      },
      first_name: {
        required: true,
        minlength: 3
      },

      last_name: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      },
      usertype: {
        required: true
      }
    }
  });


});


function openModal() {
  $('#signup').modal('show');
}

function clearForm() {
  $('#usrname').val('');
  $('#psswrd').val('');
  $('#fname').val('');
  $('#lname').val('');
  $('#email').val('');
}

function newPage() {
  window.location = 'index.php';
}
