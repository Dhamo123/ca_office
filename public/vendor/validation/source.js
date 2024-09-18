$("#sourceaddForm").validate({
  rules: {
    sourcename: {
      required: true,
    },
    /*country: "required",
    url: "required",*/
  },
  messages: {
    sourcename: {required:"Please Enter Source Name"},
  },
  submitHandler: function (form) {
    $("#sourceaddFormSubmit").prop("disabled", true);
    form.submit();
  }
});


$("#editSourceaddForm").validate({
  rules: {
    sourcename: {
      required: true,
    },
    /*country: "required",
    url: "required",*/
  },
  messages: {
    sourcename: {required:"Please Enter Source Name"},
  },
  submitHandler: function (form) {
    $("#editSourceaddFormSubmit").prop("disabled", true);
    form.submit();
  }
});
$("body").on("click",".editSourceList",function(){
  id= $(this).attr('dataid');
  let sourceName = $("#source_"+id).text();
  let message = $("#message_"+id).text();
  let role = $("#role_"+id).text();
  $("#editexampleInputSourcename").val(sourceName);
  $("#editexampleInputMessage1").val(message);
  // if(role=='superadmin'){
    // $("#editSuperadmin").attr('checked','checked');
  // }else{
     // $("#editAdmin").attr('checked','checked');
  // }
  $("#editSourceaddForm").attr("action","/source/update/"+id);
})