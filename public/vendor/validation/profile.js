$("#employee").validate({
  	rules: {
    	username: "required",
      surname: "required",
      nationalid: "required",
      countryId: "required",
      start_date: "required",
      countryCode: "required",
      phoneNumber: "required",
      
    },
    messages: {
      username: "Please enter name",
      surname: "Please enter surname",
      nationalid: "Please enter national id",
      countryId: "Please enter  country",
      phoneNumber: "Please enter phone number",
      countryCode: "Please enter country code",
      start_date: "Please enter  start date",
      
    },
    submitHandler: function (form) {
        form.submit();
    }
});

