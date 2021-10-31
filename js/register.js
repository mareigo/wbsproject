'use strict';

var settings = {
  errorElement: 'span',
  errorClass: 'alert',
  validClass: 'pass',
  errorPlacement: function(error, element) {
    $(element).parent().before(error);
  },
  normalizer: function(value) {
    return $.trim(value);
  },
  highlight: function(element, errorClass, validClass) {
    $(element).addClass('fail').removeClass(validClass);
  },
  unhighlight: function(element, errorClass, validClass) {
    $(element).removeClass('fail').addClass(validClass);
  },
  submitHandler: function() {
    alert('Formular wird gesendet');
  },
  rules: {
    vorname: {
      pattern: /^[a-zäöüß\-.,()'"\s]+$/i, 
    },
    nachname: {
      pattern: /^[a-zäöüß\-.,()'"\s]+$/i, 
    },
    email: {
      email: true,
    },
    password: {
      minlength: 6,
    },
    'conf-password': {
      equalTo: '#password',
    },
  },
  messages: {
    vorname: {
      required: 'Bitte geben Sie Ihren Vornamen ein.',
      pattern: 'Nur Buchstaben und Interpunktion erlaubt',
    },
    nachname: {
      required: 'Bitte geben Sie Ihren Nachnamen ein.',
      pattern: 'Nur Buchstaben und Interpunktion erlaubt',
    },

  },
};

$(function($) {
  $('form').eq(0).validate(settings); 
  $('form').eq(0).find('input').prop('required', 'required');
  $('input:text').on('blur', function() {
      $(this).val($.trim($(this).val()));
    });  
  
});


$('form').eq(0).noValidate = true;
