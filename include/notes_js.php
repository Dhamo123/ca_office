<script>
var table, id;

function readURLAdd(input) {
    $('#add_image_show').show();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#add_image_show').attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function readURLUpdate(input) {
    $('#update_image_show').show();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#update_image_show').attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
var next = 0;
var next_edit = 0;
$(document).ready(function() {
  $('.phoneNumber').on("cut copy paste",function(e) {
      e.preventDefault();
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
    var dateNow = new Date();
    $('#start_date, #start_date_e, #new_salary_date, #new_bonus_date, #leave_date').datetimepicker({
        format: 'YYYY-MM-DD',
    });

    

    table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "pageLength": 10,
            deferRender: true,
            //keys: true,
            select: {
                style: "single",
            },
            language: {
                searchPlaceholder: "Search Notes"
            },
            //"ajax": "ajax/View/View-Employee.php",
            "ajax": {
                "url": "ajax/View/View-Note.php",
                "data": function(d) {
                    //d.company_id = $('#list_company_id').val();
                    //d.branch_id = $('#list_branch_id').val();
                }
            },
            // "order": [[ 0, "desc" ]],
            "drawCallback": function(settings) {
                setTimeout(function() {
                    table.cell(':eq(1)').focus();
                    table.row(':eq(0)', {
                        page: 'current'
                    }).select();
                }, 1000);
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
            if (key == 38) {
                table.rows('.selected').deselect();
            }
        });





    function getRowIdx() {
        return $('#table').DataTable().cell({
            focused: true
        }).index().row;
    }

    $('#edit').click(function() {
        
        id = $('.selected td:eq(0)').text();
        Edit_Customer(id);
    });
    $('#notes').click(function() {
        
        id = $('.selected td:eq(0)').text();
        Edit_Notes(id);
    });
    $('#add').click(function() {
        $("#add_company_modal").modal('show');
    });
    

    $('#delete').click(function() {
        id = $('.selected td:eq(0)').text();
        Delete_Customer(id);
    });

  setTimeout(function() {
        table.cell(':eq(1)').focus();
        table.row(':eq(0)', {
            page: 'current'
        }).select();
    }, 1000);



    $('#add_company_form')
        .find('[name="dob"]')
        .datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true,
            onSelect: function(date, inst) {
                $('#add_company_form').formValidation('revalidateField', 'dob');
            }
        });

   

    

    $('#edit_note')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                note: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'note is required'
                        }
                    }
                },
                
                
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                formData = new FormData(),
                params = $form.serializeArray();
            


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
                    $('#notesave').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                    $('#notesave').html('Save');
                    swal({
                        type: "success",
                        title: "Success",
                        text: "Note Successfully Updated !",
                        timer: 800,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        $('#edit_note_modal').modal('hide');
                    }, 700);
                    //alert(result);
                    setTimeout(function() {
                        table.ajax.reload(null, false);
                    }, 900);
                    setTimeout(function() {
                        table.cell(':eq(1)').focus();
                    }, 1500);
                    $('#edit_note').data('formValidation').resetForm(true);
                    $("#edit_note")[0].reset();
                    

                },
                error: function(err) {
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
$('#note')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                note: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'note is required'
                        }
                    }
                },
                
                /*dob: {
                    row: ".col-md-4",
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

            var $form = $(e.target),
                formData = new FormData(),
                params = $form.serializeArray();
            


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
                    $('#notesave').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                    $('#updatesave').html('Save');
                    swal({
                        type: "success",
                        title: "Success",
                        text: "Note Successfully Added !",
                        timer: 800,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        $('#add_note_modal').modal('hide');
                    }, 700);
                    //alert(result);
                    setTimeout(function() {
                        table.ajax.reload(null, false);
                    }, 900);
                    setTimeout(function() {
                        table.cell(':eq(1)').focus();
                    }, 1500);
                    $('#add_note_modal').data('formValidation').resetForm(true);
                    $("#add_note_modal")[0].reset();
                    

                },
                error: function(err) {
                    console.log(err);
                    console.log(err.responseText);
                    swal({
                        type: "error",
                        title: "error",
                        text: err.responseText,
                        //timer: 800,
                        showConfirmButton: true
                    });
                    $('#notesave').html('Save');

                }

            });
        });


});

$('body').on('click', '.document_view', function() {
    let link = $(this).attr('link');
    let title = $(this).attr('title');
    // alert(link);
    $("#document_link").attr('src', link);
    $("#document_title").html(title);
    $('body').find("#update_company_modal").modal('hide');
    $('body').find("#document_view").modal('show');
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
    }).then(function() {
        $.ajax({
            type: "POST",
            url: "ajax/Delete/Delete-Notes.php",
            data: "id=" + id,
            success: function() {
                swal({
                    type: "success",
                    title: "Deleted",
                    text: "Note Successfully Deleted !",
                    timer: 500,
                    showConfirmButton: false
                });
                table.ajax.reload(null, false);
                setTimeout(function() {
                    table.cell(':eq(1)').focus();
                }, 500);
            }
        });
    });
}
var flag = false;



$("body").on("click", "#document_back_edit", function() {
    $("#document_view").modal('hide');
    Edit_Customer($(this).attr('dataid'), flag);
});
$("body").on("click", "#view", function() {
    flag = true;
    Edit_Customer($('.selected td:eq(0)').text(), true);
});
$("body").on("click", ".renumeration_set", function() {
    $('#update_company_modal').modal('hide');
});

function Edit_Notes(id) {
    $.ajax({
        type: "POST",
        url: "ajax/Fetch/Fetch-Inward.php",
        data: "id=" + id,
        dataType: "json",
        success: function(data) {

            $('#add_note_modal').modal('show');
            console.log(data.username);
            
            $('#note_inward').text(data.username);
            $('#inward_note').val(id);
            
          

          
        }
    })
}
function Edit_Customer(id, flag = false) {

    
    $.ajax({
        type: "POST",
        url: "ajax/Fetch/Fetch-Notes.php",
        data: "id=" + id,
        dataType: "json",
        success: function(data) {

            $('#edit_note_modal').modal('show');
            
            $('#edit_note_modal textarea[name="note"]').val(data.description);
            
            $('#inward_note').val(data.id);

           
        }
    })
}

function Get_Details_Customer(id) {
    $.ajax({
        type: "POST",
        url: "ajax/View/View-Company-Details.php",
        data: "id=" + id,
        success: function(data) {
            $('#view_customer_modal').modal('show');
            $('#view_customer_details').html(data);
        }
    })
}
$("#company_id").on('change', function() {
    id = $(this).val();
    $.ajax({
        type: "POST",
        url: "ajax/Fetch/Fetch-branch.php",
        data: "id=" + id,
        dataType: "json",
        success: function(data) {
            let branch_htm = '<option value="">Select Branch</option>';
            for (let i = 0; i < data.length; i++) {
                console.log(data);
                branch_htm += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
            }
            $("#branch").html(branch_htm);
        }
    })
})

$("#list_company_id").on('change', function() {
    id = $(this).val();
    $.ajax({
        type: "POST",
        url: "ajax/Fetch/Fetch-branch.php",
        data: "id=" + id,
        dataType: "json",
        success: function(data) {
            let branch_htm = '<option value="">All</option>';
            for (let i = 0; i < data.length; i++) {
                console.log(data);
                branch_htm += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
            }
            $("#list_branch_id").html(branch_htm);
            table.ajax.reload();
        }
    })
})
$("#list_branch_id").on('change', function() {
    //id=$(this).val();
    table.ajax.reload();
})

</script>