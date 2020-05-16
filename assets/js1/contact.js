$(document).ready(function() {
  (function($) {
    'use strict';

    jQuery.validator.addMethod(
      'answercheck',
      function(value, element) {
        return this.optional(element) || /^\bcat\b$/.test(value);
      },
      'type the correct answer -_-'
    );

    // validate contactForm form
    $(function() {
      $('#contactForm').validate({
        rules: {
          username: {
            required: true,
            minlength: 5
          },

          passport: {
            required: true
          },
          password: {
            required: true,
            minlength: 5
          },
          passwordconf: {
            required: true,
            minlength: 5
          }
        },
        messages: {
          username: {
            required: "come on, you have a username, don't you?",
            minlength: 'your username must consist of at least 5 characters'
          },

          passport: {
            required: 'please upload your passport '
          },

          password: {
            required: 'come on, How will you login without a password?',
            minlength: 'your password must be up to  5 characters'
          },
          passwordconf: {
            required: 'Please, confirm your password again',
            minlength: 'your password must match the above password'
          }
        }
      });
    });
    //function for logging in
    $(function() {
      $('#loginForm').validate({
        rules: {
          username: {
            required: true,
            minlength: 5
          },

          password: {
            required: true,
            minlength: 5
          }
        },
        messages: {
          username: {
            required: "come on, you registered with  a username, didn't you?",
            minlength: 'your username must consist of at least 5 characters'
          },

          password: {
            required:
              "unfortunately,  you can't be logged in without a password",
            minlength: 'your password must be up to  5 characters'
          }
        }
      });
    });
  })(jQuery);
});
