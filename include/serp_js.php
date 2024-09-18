<script>
var table,id;
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
    
    var dateNow = new Date();
    $('#serp_date').datetimepicker({
        format: 'YYYY-MM-DD',
    });
    $('#exampleInputFile').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.exampleInputFile').html(fileName);
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
      id = $('.selected td:eq(0)').text();
      Edit_Customer(id);
    });
    $('#openSrp').click(function() {
      id = $('.selected td:eq(0)').text();
      window.location.href="Upload-Serp.php?id="+id;
    });
    $('#opnProject').click(function() {
      $("#add_customer_modal").modal('show');
    });
    $('#add').click(function() {
      $("#add_customer_modal").modal('show');
    });
    $('#delete').click(function() {
      id = $('.selected td:eq(0)').text();
      Delete_Customer(id);
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
        


    

    // Add Customer

    $('#add_customer_form')
    .find('[name="dob"]')
    .datepicker({
        dateFormat: 'dd-mm-yy',
        changeYear:true,
        changeMonth:true,
        onSelect: function(date, inst) {
            $('#add_customer_form').formValidation('revalidateField', 'dob');
        }
    });

    $('#add_customer_form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                serp_date: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'serp date is required'
                        }
                    }
                },
                keywordfile: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'file is required'
                        }
                    }
                },
                serp_date: {
                    row:".col-md-4",
                    validators: {
                        date: {
                            format: 'YYYY-DD-MM',
                            message: 'The date is not valid'
                        },
                        notEmpty: {
                            message: 'serp date is required'
                        }
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
                files    = $form.find('[name="keywordfile"]')[0].files;

            $.each(files, function(i, file) {
                formData.append('keywordfile', file);
            });

            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });

            $.ajax({
                url: $form.attr('action'),
                data: formData,
                //cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                beforeSend: function() {
                  $('#addsave').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                $('#addsave').html('Upload');
                $('.exampleInputFile').html('');
                swal({ 
                  type: "success",
                  title: "Success",
                  text: "SERP Uploaded Successfully!",
                  timer: 800,
                  showConfirmButton: false
                });
                setTimeout(function() { $('#add_customer_modal').modal('hide'); }, 700);
                //alert(result);
                setTimeout(function() { table.ajax.reload(null, false); }, 900);
                setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 1500);
                $('#add_customer_form').data('formValidation').resetForm(true);
                $("#add_customer_form")[0].reset();
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
                 $('#addsave').html('Upload');
                 $('#addsave').attr('disabled',false);
                 $('#addsave').removeClass('disabled');
                 
                }
            });
        });

      // Update Customer

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
      url:"ajax/Delete/Delete-Project.php",
      data:"id="+id,
      success: function() {
        swal({ 
          type: "success",
          title: "Deleted",
          text: "User Successfully Deleted !",
          timer: 500,
          showConfirmButton: false
        });
        table.ajax.reload(null, false);
        setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 500);
      }
    });
  });
}
function Edit_Customer(id) {
  $.ajax({
    type:"POST",
    url:"ajax/Fetch/Fetch-Project.php",
    data:"id="+id,
    dataType:"json",
    success: function(data) {
      $('#update_customer_modal').modal('show');
      /*$('#update_customer_modal input[name="id"]').val(data.customer_id);
      $('#update_customer_modal input[name="name"]').val(data.name);
      $('#update_customer_modal input[name="umobile"]').val(data.mobile);
      $('#update_customer_modal #mobile').text(data.mobile);
      $('#update_customer_modal input[name="telephone"]').val(data.telephone);*/
      $('#update_customer_modal input[name="Username"]').val(data.Username);
      $('#update_customer_modal input[name="email"]').val(data.email);
      $('#update_customer_modal input[name="id"]').val(data.customer_id)
      /*$('#update_customer_modal input[name="dob"]').val(data.dob);
      $('#update_customer_modal textarea[name="address"]').val(data.address);*/
      //$('#update_customer_modal #update_image_show').show();
      //$('#update_customer_modal #update_image_show').attr('src', 'dist/img/customer/'+data.image);
    }
  })
}
function Get_Details_Customer(id) {
  $.ajax({
    type:"POST",
    url:"ajax/View/View-Customer-Details.php",
    data:"id="+id,
    success: function(data) {
      $('#view_customer_modal').modal('show');
      $('#view_customer_details').html(data);
    }
  })
}
</script>