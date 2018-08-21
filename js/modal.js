$(document).ready(function () {

  // Sign in modal -> Forgot password and Register button actions

  $('#forget-pass-modal-btn').click(function () {
    $('#signInModalContent').fadeOut('fast', function () {
      $('#forgotPassModalContent').fadeIn('fast');
    });
  });

  $('#sign-up-modal-btn').click(function () {
    $('#signInModalContent').fadeOut('fast', function () {
      $('#signUpModalContent').fadeIn('fast');
    });
  });

  // Forgot password -> Login button action

  $('#sign-in-modal-btn2').click(function () {
    $('#forgotPassModalContent').fadeOut('fast', function () {
      $('#signInModalContent').fadeIn('fast');
    });
  });

  // Sign up modal -> Login button action

  $('#sign-in-modal-btn').click(function () {
    $('#signUpModalContent').fadeOut('fast', function () {
      $('#signInModalContent').fadeIn('fast');
    });
  });

});

