var e;e=function(e){return e.extend(e.validator.messages,{required:"Angi en verdi.",remote:"Ugyldig verdi.",email:"Angi en gyldig epostadresse.",url:"Angi en gyldig URL.",date:"Angi en gyldig dato.",dateISO:"Angi en gyldig dato (&ARING;&ARING;&ARING;&ARING;-MM-DD).",number:"Angi et gyldig tall.",digits:"Skriv kun tall.",equalTo:"Skriv samme verdi igjen.",maxlength:e.validator.format("Maksimalt {0} tegn."),minlength:e.validator.format("Minimum {0} tegn."),rangelength:e.validator.format("Angi minimum {0} og maksimum {1} tegn."),range:e.validator.format("Angi en verdi mellom {0} og {1}."),max:e.validator.format("Angi en verdi som er mindre eller lik {0}."),min:e.validator.format("Angi en verdi som er st&oslash;rre eller lik {0}."),step:e.validator.format("Angi en verdi ganger {0}."),creditcard:"Angi et gyldig kredittkortnummer."}),e},"function"==typeof define&&define.amd?define(["jquery","../jquery.validate"],e):"object"==typeof module&&module.exports?module.exports=e(require("jquery")):e(jQuery);