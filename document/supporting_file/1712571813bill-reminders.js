$(document).ready(function () {
  if(Cookies.get("calenderViews") == '1'){
    billView('calender');
  }

  $("#addBillReminderForm").validate({
    rules: {
      billType: {
        required: true,
      },
      billDueDate: {
        required: true,
      },
      billNotificationReminder: {
        required: true,
      },
      billAmount: {
        required: true,
      },
      billRecurring: {
        required: true,
      },
      billFrequency: {
        required: true,
      },
    },
    messages: {
      billType: {
        required: "Please select bill type",
      },
      billDueDate: {
        required: "Please select bill due date",
      },
      billNotificationReminder: {
        required: "Please Set reminder notification",
      },
      billAmount: {
        required: "Please enter amount",
      },
      billRecurring: {
        required: "Please select bill recurring",
      },
      billFrequency: {
        required: "Please select bill frequency",
      },
      billPayment: {
        required: "Please select bill payment",
      },
    },
    submitHandler: function (form) {
     $.ajax({
        type: "POST",
        url: base_url + "/bill-reminder/create",
        cache: false,
        data: $("form#addBillReminderForm").serialize(),
        success: function (response) {
         
          console.log("response=", response);
          if (response.hasOwnProperty("message")) {
            toastr.success(response.message);
            $("#addBillReminder-modal").modal("hide");
            $('#addBillReminderForm')[0].reset();

            setTimeout(function () {
              window.location.reload();
            }, 1000);
          }
        },
        error: function (err) {
          if (err.hasOwnProperty("message")) {
            toastr.error(err.message);
          } else {
            toastr.error(err.responseJSON.data.message);
          }
        },
      });

    },
  });
  $("#editBillReminderForm").validate({
    rules: {
      editbillType: {
        required: true,
      },
      editbillDueDate: {
        required: true,
      },
      editbillNotificationReminder: {
        required: true,
      },
      editbillAmount: {
        required: true,
      },
      editbillRecurring: {
        required: true,
      },
      editbillFrequency: {
        required: true,
      },
    },
    messages: {
      editbillType: {
        required: "Please select bill type",
      },
      editbillDueDate: {
        required: "Please select bill due date",
      },
      editbillNotificationReminder: {
        required: "Please Set reminder notification",
      },
      editbillAmount: {
        required: "Please enter amount",
      },
      editbillRecurring: {
        required: "Please select bill recurring",
      },
      editbillFrequency: {
        required: "Please select bill frequency",
      },
      editbillPayment: {
        required: "Please select bill payment",
      },
    },
    submitHandler: function (form) {
      
     
      $.ajax({
        type: "get",
        url: base_url +$("#editBillReminderForm").attr('action'),
        cache: false,
        data: $("form#editBillReminderForm").serialize(),
        success: function (response) {
         
          console.log("response=", response);
          if (response.data.hasOwnProperty("message")) {
            toastr.success(response.data.message);
            $("#editBillReminder-modal").modal("hide");
            
            setTimeout(function () {
                window.location.reload();
            }, 1000);
          }
        },
        error: function (err) {
          if (err.hasOwnProperty("message")) {
            toastr.error(err.message);
          } else {
            toastr.error(err.responseJSON.data.message);
          }
        },
      });

    },
  });

  $(".edit_billreminder").on("click", function(){
    let id = $(this).attr('data-id');
      console.log('edit_billreminder click---', id);
      $.ajax({
        type: "POST",
        url: base_url + "/bill-reminder/edit",
        cache: false,
        data: {"id":id},
        success: function (response) {
         
          console.log("response=", response.data);
          if (response.data.hasOwnProperty("message")) {
            $("#editBillReminder-modal").modal("show");
            $("#editbillType").val(response.data.data.billTypeId);
            $("#editDueDate-date").val(response.data.data.dueDate);
            $("#editBillReminderForm").attr('action','/bill-reminder/update/'+response.data.data._id);
            $("#editbillNotificationReminder").val(response.data.data.notificationReminder);
            $("#editbillAmount").val(response.data.data.amount);
            $("#editbillRecurring").val(response.data.data.isBillRecurring);
            $("#editbillFrequency").val(response.data.data.frequency);
            $("#editbillPayment").val(response.data.data.payments);
            if(response.data.data.isBillRecurring == "no"){
              $(".billFrequency").hide();
              $(".billPayment").hide();
              }else {
                $(".billFrequency").show();
                $(".billPayment").show();
              }
            var dateToday = new Date();
            if(response.data.data.payments=='By Date'){
              $('.editbillPaymentText').show();
              $('#editbillPaymentText').attr('type','text');
              $('#editbillPaymentText').attr('placeholder','01/02/2021');
              $('.editbillPaymentTextIcon').show();
              $('#editbillPaymentText').addClass('billPaymentText');
              
              // $(".editbillPaymentText").html('<input type="text" name="billPaymentText" class="form-control editbillPaymentText" placeholder="01/02/2021" id="endPaymentText"/> <span class="input-group-addon editendPaymentTextIcon" data-toggle="datetimepicker"><span class="fa fa-calendar"></span></span>');
              $('.editbillPaymentText').datetimepicker({
                      format: 'DD/MM/YYYY',
                      minDate: dateToday,
                  });
            }else if(response.data.data.payments=='Number of payments'){
              // $('.editbillPaymentText').html('<input type="text" name="billPaymentText" class="form-control" placeholder="Enter number of payment" id="editendPaymentText"/>');
              $('.editbillPaymentText').show();
              $('.editbillPaymentTextIcon').hide();
              // $('#editbillPaymentText').attr('type','number');
              $('#editbillPaymentText').attr('placeholder','Enter number of payment');

            }else{
              $('.editbillPaymentText').hide();
              $('.editbillPaymentTextIcon').hide();
            }
            $("#editbillPaymentText").val(response.data.data.billPaymentText);
          }
        },
        error: function (err) {
          if (err.hasOwnProperty("message")) {
            toastr.error(err.message);
          } else {
            toastr.error(err.responseJSON.data.message);
          }
        },
      });
  });

  $(".trash_billreminder").on("click",function(){
    let id = $(this).attr('data-id');
    if(confirm("Are you sure want to delete this bill-reminder")){
      $.ajax({
        type: "get",
        url: base_url +'/bill-reminder/deleteBillReminder/'+id,
        cache: false,
        data: {},
        success: function (response) {
         
          console.log("response=", response);
          if (response.data.hasOwnProperty("message")) {
            toastr.success(response.data.message);
            setTimeout(function () {
                window.location.reload();
            }, 1000);
          }
        },
        error: function (err) {
          if (err.hasOwnProperty("message")) {
            toastr.error(err.message);
          } else {
            toastr.error(err.responseJSON.data.message);
          }
        },
      });
    }
    
    })

    $("#billPayment").on("change",function(){
      var dateToday = new Date();
      if($(this).val()=='By Date'){
        $('.billPaymentText').show();
        $('#billPaymentText').attr('type','text');
        $('#billPaymentText').attr('placeholder','01/02/2021');
        $('.billPaymentTextIcon').show();
        $('#billPaymentText').addClass('billPaymentText');
        
        $(".billPaymentText").html('<input type="text" name="billPaymentText" class="form-control billPaymentText" placeholder="01/02/2021" id="endPaymentText"/> <span class="input-group-addon endPaymentTextIcon" data-toggle="datetimepicker"><span class="fa fa-calendar"></span></span>');
        $('.billPaymentText').datetimepicker({
                format: 'DD/MM/YYYY',
                minDate: dateToday,
            });
      }else if($(this).val()=='Number of payments'){
        $('.billPaymentText').html('<input type="number" name="billPaymentText" class="form-control" placeholder="Enter number of payment" id="endPaymentText"/>');
        
        $('.billPaymentText').show();
        $('.billPaymentTextIcon').hide();
        $('#billPaymentText').attr('type','number');
        $('#billPaymentText').attr('placeholder','Enter number of payment');

      }else{
        $('.billPaymentText').hide();
        $('.billPaymentTextIcon').hide();
      }
  });

    $("#editbillPayment").on("change",function(){
      var dateToday = new Date();
      if($(this).val()=='By Date'){
        $('.editbillPaymentText').show();
        $('#editbillPaymentText').attr('type','text');
        $('#editbillPaymentText').attr('placeholder','01/02/2021');
        $('.editbillPaymentTextIcon').show();
        $('#editbillPaymentText').addClass('billPaymentText');
        
        $(".editbillPaymentText").html('<input type="text" name="billPaymentText" class="form-control editbillPaymentText" placeholder="01/02/2021" id="endPaymentText"/> <span class="input-group-addon editendPaymentTextIcon" data-toggle="datetimepicker"><span class="fa fa-calendar"></span></span>');
        $('.editbillPaymentText').datetimepicker({
                format: 'DD/MM/YYYY',
                minDate: dateToday,
            });
      }else if($(this).val()=='Number of payments'){
        $('.editbillPaymentText').html('<input type="number" name="billPaymentText" class="form-control" placeholder="Enter number of payment" id="editendPaymentText"/>');
        
        $('.editbillPaymentText').show();
        $('.editbillPaymentTextIcon').hide();
        $('#editbillPaymentText').attr('type','number');
        $('#editbillPaymentText').attr('placeholder','Enter number of payment');

      }else{
        $('.editbillPaymentText').hide();
        $('.editbillPaymentTextIcon').hide();
      }
  });
 
});
function billView(view){
    // alert(view);
     events =  [];
  if (view == 'calender') {
    Cookies.set('calenderViews', '1');
    $("#billView").val("calender");
    $(".tableView").hide();
    $(".calenderView").show();
    $.ajax({
      type: "get",
      url: base_url + '/bill-reminder/getAllBillReminder',
      cache: false,
      data: {},
      success: function (response) {
        if (response.data.hasOwnProperty("message")) {

          for (let i = 0; i < response.data.data.length; i++) {
            // log
            
            let dueDate = response.data.data[i].dueDate.split("/");
            let obj = {
              title: response.data.data[i].billTypeId + '  $ ' + response.data.data[i].amount,
              description: response.data.data[i].amount,
              start: dueDate[2] + '-' + dueDate[1] + '-' + dueDate[0],
              /*end: '2022-0-05',*/
              className: 'fc-bg-default',
              icon: "circle",
              "billId": response.data.data[i]._id
                        }
                    // console.log("333",obj.start);
                events.push(obj);

            }
            console.log('events=',events)
            jQuery(function() {
                // page is ready
                jQuery('#calendar').fullCalendar({
                    themeSystem: 'bootstrap4',
                    // emphasizes business hours
                    businessHours: false,
                    defaultView: 'month',
                    // event dragging & resizing
                    editable: true,
                    // header
                    header: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    events: events,
                    eventRender: function(event, element) {
                      console.log('element---', element);
                        if(event.icon){
                            element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");
                        }
                      },
                    dayClick: function(date, jsEvent, view, resourceObj) {
                      console.log(date)
                      let data = date.format().split("-");
                      
                      date = data[2]+'/'+data[1]+'/'+data[0];
                      $("#addDueDate-date").val(date);
                        jQuery('#addBillReminder-modal').modal();
                        $(".billFrequency").hide();
                        $(".billPayment").hide();
                    },
                    eventClick: function(event, jsEvent, view) {
                      console.log('element---', event);
                      $( ".edit_billreminder" ).each(function() {
                        if($(this).attr('data-id')==event.billId){
                          $(this).trigger('click');
                        }
                      });
                      //$('#edit_billreminder').trigger('click', [{billId:event.billId}]);
                            jQuery('.event-icon').html("<i class='fa fa-"+event.icon+"'></i>");
                            jQuery('.event-title').html(event.title);
                            jQuery('.event-body').html(event.description);
                            jQuery('.eventUrl').attr('href',event.url);
                            jQuery('#modal-view-event').modal();
                    },
                })
            });
            
          }
        },
        error: function (err) {
          if (err.hasOwnProperty("message")) {
            toastr.error(err.message);
          } else {
            toastr.error(err.responseJSON.data.message);
          }
        },
      });
      /*(function () {    
            'use strict';
            // ------------------------------------------------------- //
            // Calendar
            // ------------------------------------------------------ //
            jQuery(function() {
                // page is ready
                jQuery('#calendar').fullCalendar({
                    themeSystem: 'bootstrap4',
                    // emphasizes business hours
                    businessHours: false,
                    defaultView: 'month',
                    // event dragging & resizing
                    editable: true,
                    // header
                    header: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    events: events,
                    eventRender: function(event, element) {
                        if(event.icon){
                            element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");
                        }
                      },
                    dayClick: function() {
                        jQuery('#addBillReminder-modal').modal();
                    },
                    eventClick: function(event, jsEvent, view) {
                            jQuery('.event-icon').html("<i class='fa fa-"+event.icon+"'></i>");
                            jQuery('.event-title').html(event.title);
                            jQuery('.event-body').html(event.description);
                            jQuery('.eventUrl').attr('href',event.url);
                            jQuery('#modal-view-event').modal();
                    },
                })
            });
          
        })(jQuery);*/
    }else{
      Cookies.set('calenderViews', '0');
      $(".tableView").show();
      $(".calenderView").hide();
    }
}
