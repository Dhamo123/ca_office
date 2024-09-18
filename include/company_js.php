<script>
  var flag=false;
var table,id,expense_table,expense_id;
function readURLAdd(input) {
   $('#add_image_show').show();
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
       $('#add_image_show').attr('src', e.target.result)};
       reader.readAsDataURL(input.files[0]);
  }
}
function readURLUpdate(input) {
   $('#update_image_show').show();
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
       $('#update_image_show').attr('src', e.target.result)};
       reader.readAsDataURL(input.files[0]);
  }
}
$(document).ready(function() {
    
$('.phone').on("cut copy paste",function(e) {
      e.preventDefault();
   });
    table = $('#table').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "pageLength": 10,
        deferRender: true,
        //keys: true,
        select: {
          style:"single",
        },
        language: {
            searchPlaceholder: "Search Company"
        },
        "ajax": "ajax/View/View-Company.php",
        // "order": [[ 0, "desc" ]],
        "drawCallback": function( settings ) {
            setTimeout(function() {
              table.cell(':eq(1)').focus();
              table.row(':eq(0)', { page: 'current' }).select();
              checkseo_button();
            },1000);
        },
    })
    .on('key-focus', function() {
       
      //table.rows('.selected').deselect();
      $('#table').DataTable().row(getRowIdx()).select();


    })
    .on('click', 'tbody tr', function() {
      var rowIdx = $('#table').DataTable().cell(this).index().row;

      $('#table').DataTable().row(rowIdx).select();
      
    })
    .on('key', function(e, datatable, key, cell, originalEvent) {
      if (key === 13) {
        var data = $('#table').DataTable().row(getRowIdx()).data();
        Edit_Customer(data[0]);
       
      }
      if(key == 38) {
        table.rows('.selected').deselect();
      }
    });
    
    expense_table = $('#expense_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "pageLength": 10,
        deferRender: true,
        //keys: true,
        select: {
          style:"single",
        },
        language: {
            searchPlaceholder: "Search Company"
        },
        "ajax": {
                "url": "ajax/View/View-Expense.php",
                "data": function(d) {
                    d.company_id = expense_id;
                    d.branch_id = $("#list_branch_id").val();
                    
                }
            },
        // "order": [[ 0, "desc" ]],
        "drawCallback": function( settings ) {
            setTimeout(function() {
              table.cell(':eq(1)').focus();
              table.row(':eq(0)', { page: 'current' }).select();
            },1000);
        },
    })
    .on('key-focus', function() {
      //table.rows('.selected').deselect();
      $('#table').DataTable().row(getRowIdx()).select();
    })
    .on('click', 'tbody tr', function() {
      var rowIdx = $('#table').DataTable().cell(this).index().row;
      $('#table').DataTable().row(rowIdx).select();
      //alert(rowIdx);
    })
    .on('key', function(e, datatable, key, cell, originalEvent) {
      if (key === 13) {
        var data = $('#table').DataTable().row(getRowIdx()).data();
        Edit_Customer(data[0]);

      }
      if(key == 38) {
        table.rows('.selected').deselect();
      }
    });

    // $('#table tbody').on('click', 'tr', function () {
    //     var data = table.row( this ).data();

    //     //alert( 'You clicked on '+data[0]+'\'s row' );
    // } );

     // $('#example tbody').on( 'click', 'tr', function () {
     //   $("#example tbody tr").removeClass('selected');        
     //   $(this).addClass('selected');
     //   alert('ok');
     // });



    function getRowIdx() {
      return $('#table').DataTable().cell({
        focused: true
      }).index().row;
    }
    
    $('#edit').click(function() {
      flag = false;
      id = $('.selected td:eq(0)').text();
      Edit_Customer(id,flag);
    });
    $('#add').click(function() {
      $("#add_company_modal").modal('show');
    });
    $('#delete').click(function() {
      id = $('.selected td:eq(0)').text();
      Delete_Customer(id);
    });
    $('#seo').click(function() {
      id = $('.selected td:eq(0)').text();
      window.location.href= 'keywords?id='+id;
    });
    $('#expense_delete').click(function() {
      id = $('.selected td:eq(0)').text();
      Delete_Expense(id);
    });
    $("body").on("click","#view",function(){
      flag = true;
      Edit_Customer($('.selected td:eq(0)').text(), true);
    });
    $('#expense').click(function() {
       id = $('.selected td:eq(0)').text();
       $("#expense_list").modal('show');
       $("#expense_company_id").val(id);
       //alert($('.selected td:eq(1)').text());
       $("#expense_company_name").html($('.selected td:eq(1)').text()+' - Expense List')
       console.log("Id=",id);
       expense_id = id;
       expense_table.ajax.reload(null, false);

            $.ajax({
                url: 'ajax/Fetch/Fetch-branch.php',
                data: {"id":id},
                type: 'POST',
                beforeSend: function() {
                  
                },
                success: function(result) {
                    expense_table.cell(':eq(1)').focus();
                    expense_table.row(':eq(0)', { page: 'current' }).select();
                    result = JSON.parse(result);
                console.log("branch=",result);
                let branch ='<option value="">Select Site/Branch</option>';
                for(let i=0;i<result.length;i++){
                    branch +='<option value="'+result[i].id+'">'+result[i].name+'</option>';
                }
                $("#branch").html(branch);
                $("#edit_branch").html(branch);
                $("#list_branch_id").html(branch);
                },
                error: function(err){
                 console.log(err);
                 
                 
                }
            });
    });
    $('#expense_add').click(function() {
        $("#expense_list").modal('hide');
        $("#add_expense").modal('show');
    });
    $('#expense_edit').click(function() {
        $("body").find('#edits_expense input[type=text]').prop("disabled", false);
        $("body").find('#edits_expense input[type=number]').prop("disabled", false);
        $("body").find('#edits_expense input[type=file]').prop("disabled", false);
        $("body").find('#edits_expense input[type=email]').prop("disabled", false);
        $("body").find('#edits_expense select').prop("disabled", false);
        $("body").find('#edits_expense textarea').prop("disabled", false);
        $("body").find('#updateExpense').show();
        $("body").find('#edit_title').text('Update Expense');
        $.ajax({
            type:"POST",
            url:"ajax/Fetch/Fetch-Expense.php",
            data:"id="+$('#expense_table .selected td:eq(0)').text(),
            success: function(data) {
                data = JSON.parse(data);
                $("#expense_edit_title").text('Update Expense');
              $("#expense_list").modal('hide');
              $("#update_expense").modal('show');
              $("body").find('#edits_expense input[type=radio]').prop("disabled", false);
              $('#update_expense textarea[name="description"]').val(data.description);
              $('#update_expense select[name="edit_expense_date"]').val(data.expense_date);
              $('#update_expense input[name="expense_id"]').val(data.id);
              $('#update_expense input[name="amount"]').val(data.amount);
              $('#update_expense select[name="frequency"]').val(data.frequency);
              $('#update_expense select[name="branch"]').val(data.branch);
              $('#update_expense select[name="type"]').val(data.type);
              $('#update_expense select[name="edit_frequency_time"]').val(data.time);
              $('#update_expense input[value="'+data.days+'"]').val(data.days).attr("checked",true);
              if(data.type=='Recurring'){
                $('#edit_frequency_setup').show();
              }else{
                $('#edit_frequency_setup').hide();
              }
              
              if(data.type=='Once-off'){
                console.log(data.expense_date)
                $('#update_expense input[name="edit_expense_date_once_off"]').val(data.expense_date);
                $('#edit_expense_date').show();
                $('#edit_expense_date_once_off').show();
                $('#edit_expense').hide();
                $('#edit_frequency_time').hide();
                $('#edit_week_days').hide();
              }else{
                console.log(data.expense_date)
                $('#update_expense select[name="edit_expense"]').val(data.expense_date);
                 $('#edit_expense_date_once_off').hide();
                 $('#edit_expense').show();
                 $('#edit_frequency_time').show();
              }
              if($("#edit_frequency").val()=='Daily'){
                $("#edit_frequency_time").show();
                $("#edit_expense_date").hide();
                $("#edit_week_days").hide();
              }else if($("#edit_frequency").val()=='Weekly'){
                $("#edit_week_days").show();
                $("#edit_expense_date").hide();
                $("#edit_frequency_time").hide();
                $("#edit_frequency_time").hide();
              }else if($("#edit_frequency").val()=='Monthly'){
                $("#edit_expense_date").show();
                $("#edit_week_days").hide();
                $("#edit_frequency_time").hide();
              }
            }
          })
    });
    $('#expense_view').click(function() {
        
        $.ajax({
            type:"POST",
            url:"ajax/Fetch/Fetch-Expense.php",
            data:"id="+$('#expense_table .selected td:eq(0)').text(),
            success: function(data) {
                data = JSON.parse(data);
                $("#expense_edit_title").text('View Expense');
              $("#expense_list").modal('hide');
              $("#update_expense").modal('show');
              $('#update_expense textarea[name="description"]').val(data.description);
              $('#update_expense select[name="edit_expense_date"]').val(data.expense_date);
              $('#update_expense input[name="expense_id"]').val(data.id);
              $('#update_expense input[name="amount"]').val(data.amount);
              $('#update_expense select[name="frequency"]').val(data.frequency);
              $('#update_expense select[name="branch"]').val(data.branch);
              $('#update_expense select[name="type"]').val(data.type);
              $('#update_expense select[name="edit_frequency_time"]').val(data.time);
              $('#update_expense input[name="seo"]').prop('checked',(data.seo=='1')?true:false);
              $("body").find('#update_expense input[name="seo"]').prop('disabled',true);
              if(data.type=='Recurring'){
                $('#edit_frequency_setup').show();
              }else{
                $('#edit_frequency_setup').hide();
              }
              $('#update_expense input[value="'+data.days+'"]').val(data.days).attr("checked",true);
                $("body").find('#edits_expense input[type=text]').prop("disabled", true);
                $("body").find('#edits_expense input[type=number]').prop("disabled", true);
                $("body").find('#edits_expense input[type=file]').prop("disabled", true);
                $("body").find('#edits_expense input[type=email]').prop("disabled", true);
                $("body").find('#edits_expense input[type=radio]').prop("disabled", true);
                $("body").find('#edits_expense select').prop("disabled", true);
                $("body").find('#edits_expense textarea').prop("disabled", true);
                $("body").find('#updateExpense').hide();
                $("body").find('#edit_title').text('View Expense');
                if(data.type=='Once-off'){
                console.log(data.expense_date)
                $('#update_expense input[name="edit_expense_date_once_off"]').val(data.expense_date);
                $('#edit_expense_date').show();
                $('#edit_expense_date_once_off').show();
                $('#edit_expense').hide();
                $('#edit_frequency_time').hide();
                $('#edit_week_days').hide();
              }else{
                console.log(data.expense_date)
                $('#update_expense select[name="edit_expense"]').val(data.expense_date);
                 $('#edit_expense_date_once_off').hide();
                 $('#edit_expense').show();
                 $('#edit_frequency_time').show();
              }
              if($("#edit_frequency").val()=='Daily'){
                $("#edit_frequency_time").show();
                $("#edit_expense_date").hide();
                $("#edit_week_days").hide();
              }else if($("#edit_frequency").val()=='Weekly'){
                $("#edit_week_days").show();
                $("#edit_expense_date").hide();
                $("#edit_frequency_time").hide();
                $("#edit_frequency_time").hide();
              }else if($("#edit_frequency").val()=='Monthly'){
                $("#edit_expense_date").show();
                $("#edit_week_days").hide();
                $("#edit_frequency_time").hide();
              }
            }
          })
    });
    $('body').on('change','#list_branch_id',function() {
        expense_table.ajax.reload(null, false);
    });
    // table.on( 'search.dt', function () {
    //   setTimeout(function() {
    //     table.cell(':eq(1)').focus();
    //     table.row(':eq(0)', { page: 'current' }).select();
    //   },500);
    // });



    setTimeout(function() {
      table.cell(':eq(1)').focus();
      table.row(':eq(0)', { page: 'current' }).select();
    },1000);

    // table.on( 'key', function ( e, datatable, key, cell, originalEvent ) {
    //   if ( key === 13 ) {
    //     var id = datatable.row( cell.index().row ).data();
        
    //   }
    // });

    

   

    // Keytable Enable/Disable Function




    // End Keytable Enable/Disable Function
        

/*setTimeout(function() { 
    var t = table.cell( ':eq(1)' ).data();
         
    console.log(t)
    console.log("===",$(t).find("span:first").attr("class"))
      },
     2000);*/
    

    // Add Customer

    $('#add_company_form')
    .find('[name="dob"]')
    .datepicker({
        dateFormat: 'dd-mm-yy',
        changeYear:true,
        changeMonth:true,
        onSelect: function(date, inst) {
            $('#add_company_form').formValidation('revalidateField', 'dob');
        }
    });

    $('#add_company_form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                /*password: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        }
                    }
                },*/
                /*email: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        }
                    }
                },*/
                /*mobile: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'The mobile is required'
                        },
                        integer: {
                          message: 'only number are allowed'
                        },
                        remote: {
                            message: 'The mobile already use',
                            url: 'ajax/check-customer-mobile.php',
                            type: 'POST',
                            delay: 200
                        },
                    }
                },
                dob: {
                    row:".col-md-4",
                    validators: {
                        date: {
                            format: 'DD-MM-YYYY',
                            message: 'The date is not valid'
                        }
                    }
                },*/
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form    = $(e.target),
                formData = new FormData(),
                params   = $form.serializeArray();
                /*files    = $form.find('[name="image"]')[0].files;

            $.each(files, function(i, file) {
                formData.append('image', file);
            });*/

            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });

            $.ajax({
                url: $form.attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function() {
                  $('#addsave').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                $('#addsave').html('Save');
                swal({ 
                  type: "success",
                  title: "Success",
                  text: "Company Successfully Added !",
                  timer: 800,
                  showConfirmButton: false
                });
                setTimeout(function() { $('#add_company_modal').modal('hide'); }, 700);
                //alert(result);
                setTimeout(function() { table.ajax.reload(null, false); }, 900);
                setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 1500);
                $('#add_company_form').data('formValidation').resetForm(true);
                $("#add_company_form")[0].reset();
                },
                error: function(err){
                 console.log(err);
                 console.log(err.responseText);
                 swal({ 
                  type: "error",
                  title: "error",
                  text: err.responseText,
                  //timer: 800,
                  showConfirmButton: true
                });
                 $('#addsave').html('Save');
                 $('#addsave').attr('disabled',false);
                 $('#addsave').removeClass('disabled');
                 
                }
            });
        });
    $('#add_expenses')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                type: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: ' Expense type is required'
                        }
                    }
                },
                amount: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Amount is required'
                        }
                    }
                },
                expense_date: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Expense date is required'
                        }/*,
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'The date is not valid'
                        }*/
                    }
                }
                
                /*mobile: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'The mobile is required'
                        },
                        integer: {
                          message: 'only number are allowed'
                        },
                        remote: {
                            message: 'The mobile already use',
                            url: 'ajax/check-customer-mobile.php',
                            type: 'POST',
                            delay: 200
                        },
                    }
                },
                dob: {
                    row:".col-md-4",
                    validators: {
                        date: {
                            format: 'DD-MM-YYYY',
                            message: 'The date is not valid'
                        }
                    }
                },*/
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form    = $(e.target),
                formData = new FormData(),
                params   = $form.serializeArray();
                /*files    = $form.find('[name="image"]')[0].files;

            $.each(files, function(i, file) {
                formData.append('image', file);
            });*/

            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });

            $.ajax({
                url: $form.attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function() {
                  $('#saveExpense').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                $('#saveExpense').html('Save');
                swal({ 
                  type: "success",
                  title: "Success",
                  text: "Expense Successfully Added !",
                  timer: 800,
                  showConfirmButton: false
                });
                setTimeout(function() { $('#add_expense').modal('hide'); }, 700);
                //alert(result);
                setTimeout(function() { table.ajax.reload(null, false); }, 900);
                setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 1500);
                $('#add_expenses').data('formValidation').resetForm(true);
                $("#add_expenses")[0].reset();
                },
                error: function(err){
                 console.log(err);
                 console.log(err.responseText);
                 swal({ 
                  type: "error",
                  title: "error",
                  text: err.responseText,
                  //timer: 800,
                  showConfirmButton: true
                });
                 $('#saveExpense').html('Save');
                 $('#saveExpense').attr('disabled',false);
                 $('#saveExpense').removeClass('disabled');
                 
                }
            });
        });
      // Update Customer
    $('#edits_expense')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                type: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: ' Expense type is required'
                        }
                    }
                },
                amount: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Amount is required'
                        }
                    }
                },
                edit_expense_date: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Expense date is required'
                        }/*,
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'The date is not valid'
                        }*/
                    }
                },
                /*mobile: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'The mobile is required'
                        },
                        integer: {
                          message: 'only number are allowed'
                        },
                        remote: {
                            message: 'The mobile already use',
                            url: 'ajax/check-customer-mobile.php',
                            type: 'POST',
                            delay: 200
                        },
                    }
                },
                dob: {
                    row:".col-md-4",
                    validators: {
                        date: {
                            format: 'DD-MM-YYYY',
                            message: 'The date is not valid'
                        }
                    }
                },*/
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form    = $(e.target),
                formData = new FormData(),
                params   = $form.serializeArray();
                /*files    = $form.find('[name="image"]')[0].files;

            $.each(files, function(i, file) {
                formData.append('image', file);
            });*/

            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });

            $.ajax({
                url: $form.attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function() {
                  $('#saveExpense').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                $('#saveExpense').html('Save');
                swal({ 
                  type: "success",
                  title: "Success",
                  text: "Expense Successfully Updated !",
                  timer: 800,
                  showConfirmButton: false
                });
                setTimeout(function() { $('#update_expense').modal('hide'); }, 700);
                //alert(result);
                setTimeout(function() { expense_table.ajax.reload(null, false); }, 900);
                setTimeout(function() { expense_table.cell( ':eq(1)' ).focus();  }, 1500);
                $('#update_expense').data('formValidation').resetForm(true);
                $("#update_expense")[0].reset();

                },
                error: function(err){
                 console.log(err);
                 console.log(err.responseText);
                 swal({ 
                  type: "error",
                  title: "error",
                  text: err.responseText,
                  //timer: 800,
                  showConfirmButton: true
                });
                 $('#saveExpense').html('Save');
                 $('#saveExpense').attr('disabled',false);
                 $('#saveExpense').removeClass('disabled');
                 
                }
            });
        });
    $('#update_customer_form')
    .find('[name="dob"]')
    .datepicker({
        dateFormat: 'dd-mm-yy',
        changeYear:true,
        changeMonth:true,
        onSelect: function(date, inst) {
            $('#update_customer_form').formValidation('revalidateField', 'dob');
        }
    });

    $('#update_customer_form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                /*email: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        }
                    }
                },*/
                /*mobile: {
                    row:".col-md-4",
                    validators: {
                        integer: {
                          message: 'only number are allowed'
                        },
                        remote: {
                            message: 'The mobile already use',
                            url: 'ajax/check-customer-mobile.php',
                            type: 'POST',
                            delay: 200
                        },
                    }
                },
                dob: {
                    row:".col-md-4",
                    validators: {
                        date: {
                            format: 'DD-MM-YYYY',
                            message: 'The date is not valid'
                        }
                    }
                },*/
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form    = $(e.target),
                formData = new FormData(),
                params   = $form.serializeArray();
               /* files    = $form.find('[name="image"]')[0].files;

            $.each(files, function(i, file) {
                formData.append('image', file);
            });*/

            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });

            $.ajax({
                url: $form.attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function() {
                  $('#updatesave').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                $('#updatesave').html('Save');
                swal({ 
                  type: "success",
                  title: "Success",
                  text: "Company Successfully Updated !",
                  timer: 800,
                  showConfirmButton: false
                });
                setTimeout(function() { $('#update_company_modal').modal('hide'); }, 700);
                //alert(result);
                setTimeout(function() { table.ajax.reload(null, false);  }, 900);
                setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 1500);
                $('#update_customer_form').data('formValidation').resetForm(true);
                $("#update_customer_form")[0].reset();

                },
                error: function(err){
                 console.log(err);
                 console.log(err.responseText);
                 swal({ 
                  type: "error",
                  title: "error",
                  text: err.responseText,
                  //timer: 800,
                  showConfirmButton: true
                });
                 $('#updatesave').html('Save');
                 
                }
                
            });
        });

});
function Delete_Customer(id) {
  swal({
    title: 'Are you sure?',
    text: "You won't be delete this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(function () {
    $.ajax({
      type:"POST",
      url:"ajax/Delete/Delete-Company.php",
      data:"id="+id,
      success: function() {
        swal({ 
          type: "success",
          title: "Deleted",
          text: "Company Successfully Deleted !",
          timer: 500,
          showConfirmButton: false
        });
        table.ajax.reload(null, false);
        setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 500);
      }
    });
  });
}
function Delete_Expense(id) {
  swal({
    title: 'Are you sure?',
    text: "You won't be delete this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(function () {
    $.ajax({
      type:"POST",
      url:"ajax/Delete/Delete-Expense.php",
      data:"id="+id,
      success: function() {
        swal({ 
          type: "success",
          title: "Deleted",
          text: "Expense Successfully Deleted !",
          timer: 500,
          showConfirmButton: false
        });
        expense_table.ajax.reload(null, false);
        setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 500);
      }
    });
  });
}

function Edit_Customer(id,flag=false) {

  if(flag){
    flag = true;
    $("#add-more-edit").attr('disabled',true);
    $("body").find('#update_customer_form input[type=text]').prop("disabled", true);
    $("body").find('#update_customer_form input[type=number]').prop("disabled", true);
    $("body").find('#update_customer_form input[type=file]').prop("disabled", true);
    $("body").find('#update_customer_form input[type=email]').prop("disabled", true);
    $("body").find('#update_customer_form select').prop("disabled", true);
    $("body").find('#update_customer_form textarea').prop("disabled", true);
    $("#updatesave").hide();
    $("#edit_title").html('View-Company');
  }else{
    flag = false;
    $("#add-more-edit").attr('disabled',false);
    $("body").find('#update_customer_form input[type=text]').prop("disabled", false);
    $("body").find('#update_customer_form input[type=number]').prop("disabled", false);
    $("body").find('#update_customer_form input[type=file]').prop("disabled", false);
    $("body").find('#update_customer_form input[type=email]').prop("disabled", false);
    $("body").find('#update_customer_form textarea').prop("disabled", false);
    $("body").find('#update_customer_form select').prop("disabled", false);
    $("#updatesave").show();
    $("#edit_title").html('Update Company');
  }
  $("#add-more-branch-edit").html('');
  $.ajax({
    type:"POST",
    url:"ajax/Fetch/Fetch-Company.php",
    data:"id="+id,
    dataType:"json",
    success: function(data) {
      $('#update_company_modal').modal('show');
      $('#update_company_modal textarea[name="address"]').val(data.address);
      $('#update_company_modal input[name="vat"]').val(data.vat);
      $('#update_company_modal input[name="tax"]').val(data.tax);
      $('#update_company_modal input[name="phone"]').val(data.phone);
      $('#update_company_modal input[name="tradings"]').val(data.tradings);
      $('#update_company_modal input[name="reg"]').val(data.reg);
      $('#update_company_modal select[name="country"]').val(data.country);
      $('#update_company_modal select[name="countryCode"]').val(data.countryCode);
      
      $('#update_company_modal input[name="website"]').val(data.website);
      $('#update_company_modal input[name="name"]').val(data.name);
      $('#update_company_modal input[name="email"]').val(data.email);
      $('#update_company_modal input[name="id"]').val(data.company_id);
      console.log("data.seo=",data.seo)
      $('#update_company_modal input[name="seo"]').prop('checked',(data.seo=='1')?true:false);
      let enable = (flag)?'disabled':'';
      for(let i=0;i<data.branch.length;i++){
        if(i==0){
          $('#update_company_modal input[name="branch[]"]').val(data.branch[i].name);
          $("#add-more-branch-edit").append('<input type="hidden" name="branchid[]" value="'+data.branch[i].id+'">') ;
        }else{
          next = next_edit + 1;
          var newIn = ' <div id="branch_row_edit_'+next_edit+'">&nbsp; <div class="row"> <div class="col-md-6"> <div class="row"> <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> <input type="text" name="branch[]" '+enable+' value="'+data.branch[i].name+'" class="form-control" placeholder="Enter Branch Or Site"><input type="hidden" name="branchid[]"  value="'+data.branch[i].id+'"> </div><div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> <label for="countryCode"></label> <button class="remove_branch_edit btn btn-danger" dataid="'+next_edit+'" name="remove" class="btn btn-danger" '+enable+' ><i class="fa fa-trash"></i></button> </div></div></div></div></div>';
        $("#add-more-branch-edit").append(newIn) ;
        }
      }
      /*$('#update_company_modal input[name="dob"]').val(data.dob);
      $('#update_company_modal textarea[name="address"]').val(data.address);*/
      //$('#update_company_modal #update_image_show').show();
      //$('#update_company_modal #update_image_show').attr('src', 'dist/img/customer/'+data.image);
    }
  })
}
function Get_Details_Customer(id) {
  $.ajax({
    type:"POST",
    url:"ajax/View/View-Company-Details.php",
    data:"id="+id,
    success: function(data) {
      $('#view_customer_modal').modal('show');
      $('#view_customer_details').html(data);
    }
  })
}
function checkseo_button(){
    var t = table.cell( ':eq(1)' ).data()
    let seo = $(t).attr('seo');
    if(seo=='1'){
    $("body").find("#seo").show();
    }else{
        $("body").find("#seo").hide();
    }
}
var next = 0;
var next_edit = 0;
$('#expense_date, #expense_date_once_off, #edit_expense_date_once_off').datetimepicker({
        format: 'YYYY-MM-DD',
});
$('body').on('change','#type', function(){
    if($(this).val()=='Recurring'){
        $("#frequency_setup").show();
        $("#expense_date").show();
        $("#expense_date_once_off").hide();

    }else{
        $("#frequency_setup").hide();
        $("#expense_date").hide();
        $("#expense_date_once_off").show();
        $('#edit_week_days').hide();
    }
});
$('body').on('change','#frequency', function(){
    if($(this).val()=='Daily'){
        $("#frequency_time").show();
    }else{
        $("#frequency_time").hide();
    }
});
$('body').on('change','#frequency', function(){
    if($(this).val()=='Weekly'){
        $("#week_days").show();
    }else{
        $("#week_days").hide();
    }
});
$('body').on('change','#frequency', function(){
    if($(this).val()=='Monthly'){
        $("#add_expense_date").show();
    }else{
        $("#add_expense_date").hide();
    }
});
$('body').on('change','#edit_frequency', function(){
    if($(this).val()=='Daily'){
        $("#edit_frequency_time").show();
        $("#edit_expense_date").hide();
        $("#edit_week_days").hide();
    }else if($(this).val()=='Weekly'){
        $("#edit_week_days").show();
        $("#edit_expense_date").hide();
        $("#edit_frequency_time").hide();
    }else{
        $("#edit_week_days").hide();
        $("#edit_frequency_time").hide();
        $("#edit_expense_date").show();
        $("#edit_expense").show();
    }
});
$('body').on('change','#edit_type', function(){
    if($(this).val()=='Recurring'){
        $("#edit_frequency_setup").show();
        $("#edit_expense_date_once_off").hide();
        $("#edit_expense_date").show();
        $("#edit_expense").show();
        if($("#edit_frequency").val()=='Monthly'){
            $("#edit_expense_date").show();
        }
    }else{
        $("#edit_frequency_setup").hide();
        $("#edit_frequency_time").hide();
        $("#edit_expense_date").show();
        $("#edit_expense").hide();
        $("#edit_expense_date_once_off").show();
        $('#edit_week_days').hide();
    }
});
$("#add-more").click(function(e){
        e.preventDefault();
        next = next + 1;
        var newIn = ' <div id="branch_row_'+next+'">&nbsp; <div class="row"> <div class="col-md-6"> <div class="row"> <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> <input type="text" name="branch[]" class="form-control" placeholder="Enter Branch Or Site"> </div><div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> <label for="countryCode"></label> <button class="remove_branch btn btn-danger" dataid="'+next+'" name="remove" class="btn btn-danger"><i class="fa fa-trash"></i></button> </div></div></div></div></div>';
        $("#add-more-branch").append(newIn) ;
  });
$("#add-more-edit").click(function(e){
        e.preventDefault();
        next = next_edit + 1;
        var newIn = ' <div id="branch_row_edit_'+next_edit+'">&nbsp; <div class="row"> <div class="col-md-6"> <div class="row"> <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> <input type="text" name="branch[]" class="form-control" placeholder="Enter Branch Or Site"> </div><div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> <label for="countryCode"></label> <button class="remove_branch_edit btn btn-danger" dataid="'+next_edit+'" name="remove" class="btn btn-danger"><i class="fa fa-trash"></i></button> </div></div></div></div></div>';
        $("#add-more-branch-edit").append(newIn) ;
  });

$("body").on('click','.remove_branch',function(e){
  e.preventDefault();
       var id=$(this).attr('dataid');
        $("#branch_row_"+id).remove();
});
$("body").on('click','.remove_branch_edit',function(e){
  e.preventDefault();
       var id=$(this).attr('dataid');
        $("#branch_row_edit_"+id).remove();
});

$('#table tbody').on( 'click focus load key-focus', 'tr', function () {
        console.log($(this))
        let seo = $(this).find('span').attr('seo');
        if(seo=='1'){
           $("body").find("#seo").show();
        }else{
            $("body").find("#seo").hide();
        }
        
});

 
    
   
    

    

/*$('#table tbody').on( 'click', 'tr', function () {    
    let str = table.row( this ).data()[0];
    console.log(  str);
    str.attr('seo');
    console.log(  str.attr('seo'));
} );*/


</script>