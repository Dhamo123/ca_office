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
            searchPlaceholder: "Search Keyword"
        },
        "ajax": {
                "url": "ajax/View/View-Keywords.php",
                "data": function(d) {
                    d.id = "<?php echo $_GET['id']?>";
                    
                    
                }
            },
       // "ajax": "ajax/View/View-Keywords.php",
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
      $("#add_keyword_modal").modal('show');
    });
    $('#delete').click(function() {
      id = $('.selected td:eq(0)').text();
      Delete_Customer(id);
    });
    
    
    
   
    setTimeout(function() {
      table.cell(':eq(1)').focus();
      table.row(':eq(0)', { page: 'current' }).select();
    },1000);

   
    $('#add_keyword_form')
    .find('[name="dob"]')
    .datepicker({
        dateFormat: 'dd-mm-yy',
        changeYear:true,
        changeMonth:true,
        onSelect: function(date, inst) {
            $('#add_keyword_form').formValidation('revalidateField', 'dob');
        }
    });

    $('#add_keyword_form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                keywords: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'keywords is required'
                        }
                    }
                },
                
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
                  text: "Keyword Successfully Added !",
                  timer: 800,
                  showConfirmButton: false
                });
                setTimeout(function() { $('#add_keyword_modal').modal('hide'); }, 700);
                //alert(result);
                setTimeout(function() { table.ajax.reload(null, false); }, 900);
                setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 1500);
                $('#add_keyword_form').data('formValidation').resetForm(true);
                $("#add_keyword_form")[0].reset();
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
    
    
    

    $('#update_keywords_form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                keywords: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Keywords is required'
                        }
                    }
                },
                
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
                  text: "Keyword Successfully Updated !",
                  timer: 800,
                  showConfirmButton: false
                });
                setTimeout(function() { $('#update_keyword_modal').modal('hide'); }, 700);
                //alert(result);
                setTimeout(function() { table.ajax.reload(null, false);  }, 900);
                setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 1500);
                $('#update_keywords_form').data('formValidation').resetForm(true);
                $("#update_keywords_form")[0].reset();

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

        $('#keyword_date_form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                createDate: {
                    row:".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'Date is required'
                        }
                    }
                },
                
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
                  $('#updatedatesave').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                $('#updatedatesave').html('Update');
                swal({ 
                  type: "success",
                  title: "Success",
                  text: "Date Successfully Updated !",
                  timer: 800,
                  showConfirmButton: false
                });
                setTimeout(function() { $('#keyword_date_modal').modal('hide'); }, 700);
                //alert(result);
                setTimeout(function() { table.ajax.reload(null, false);  }, 900);
                setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 1500);
                $('#keyword_date_form').data('formValidation').resetForm(true);
                $("#keyword_date_form")[0].reset();

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
                 $('#updatedatesave').html('Update');
                 
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
      url:"ajax/Delete/Delete-Keywords.php",
      data:"id="+id,
      success: function() {
        swal({ 
          type: "success",
          title: "Deleted",
          text: "Keyword Successfully Deleted !",
          timer: 500,
          showConfirmButton: false
        });
        table.ajax.reload(null, false);
        setTimeout(function() { table.cell( ':eq(1)' ).focus();  }, 500);
      }
    });
  });
}


function Edit_Customer(id,flag=false) {

  if(flag){
    flag = true;
   
    $("#updatesave").hide();
    $("#edit_title").html('View-Company');
  }else{
    flag = false;
    
    $("#updatesave").show();
    $("#edit_title").html('Update Keyword');
  }
  $("#add-more-branch-edit").html('');
  $.ajax({
    type:"POST",
    url:"ajax/Fetch/Fetch-Keywords.php",
    data:"id="+id,
    dataType:"json",
    success: function(data) {
      $('#update_keyword_modal').modal('show');
      
      $('#update_keyword_modal input[name="keywords"]').val(data.keywords);
      $('#update_keyword_modal input[name="monthly_search_volume"]').val(data.monthly_search_volume);
      $('#update_keyword_modal input[name="difficulty"]').val(data.difficulty);
      $('#update_keyword_modal input[name="start_position"]').val(data.start_position);
      
      $('#update_keyword_modal input[name="id"]').val(data.id);
      
      
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
var next = 0;
var next_edit = 0;
$('#createDate').datetimepicker({
        format: 'YYYY-MM-DD',
});







$('#table tbody').on( 'click focus load key-focus', 'tr', function () {
        
        let seo = $(this).find('span').attr('seo');
        if(seo=='1'){
           $("body").find("#seo").show();
        }else{
            $("body").find("#seo").hide();
        }
        
});
$('body').on( 'click ', '.keywords_date', function () {
        
       id = $(this).attr('dataid');
       let date = $(this).attr('date');
       let keywords = $(this).attr('keywords');
       $("#keyword_title").text(keywords);
       $('#keyword_date_modal').modal('show');
       $('#keyword_date_modal input[name="id"]').val(id);
       $('#keyword_date_modal input[name="createDate"]').val(date);
        
});
 $('.keywords_date').click(function() {
      
      
    });

/*$('#table tbody').on( 'click', 'tr', function () {    
    let str = table.row( this ).data()[0];
    console.log(  str);
    str.attr('seo');
    console.log(  str.attr('seo'));
} );*/


</script>