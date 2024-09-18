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
    
    $("#add-more").click(function(e){
        e.preventDefault();
        next = next + 1;
        var newIn = ' <div id="branch_row_'+next+'">&nbsp;<div class=row><div class=col-md-4><label for="">Bank Name</label> <input class=form-control name=bankname[] placeholder="Enter Bank Name"></div><div class=col-md-3><label for="">IFSC</label> <input class=form-control name=ifsc[] placeholder="Enter IFSC"></div><div class=col-md-3><label for="">Account No</label> <input class=form-control name=accountno[] placeholder="Enter Account No"></div><div class=col-md-1 style=margin-top:30px><label for=""></label> <button class="remove_branch btn btn-danger" dataid="'+next+'" name="remove" class="btn btn-danger"><i class="fa fa-trash"></i></button></div></div></div></div></div>';
        $("#add-more-branch").append(newIn) ;
  });
$("#add-more-edit").click(function(e){
        e.preventDefault();
        next = next_edit + 1;
        
         var newIn = ' <div id="branch_row_edit_'+next_edit+'">&nbsp;<div class=row><div class=col-md-4><label for="">Bank Name</label> <input class=form-control name=bankname[] placeholder="Enter Bank Name"></div><div class=col-md-3><label for="">IFSC</label> <input class=form-control name=ifsc[] placeholder="Enter IFSC"></div><div class=col-md-3><label for="">Account No</label> <input class=form-control name=accountno[] placeholder="Enter Account No"></div><div class=col-md-1 style=margin-top:30px><label for=""></label> <button class="remove_branch_edit btn btn-danger" dataid="'+next_edit+'" name="remove" class="btn btn-danger"><i class="fa fa-trash"></i></button></div></div></div></div></div>';
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
                searchPlaceholder: "Search Inward"
            },
            //"ajax": "ajax/View/View-Employee.php",
            "ajax": {
                "url": "ajax/View/View-Inward.php",
                "data": function(d) {
                    d.company_id = $('#list_company_id').val();
                    d.branch_id = $('#list_branch_id').val();
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
        flag = false;
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

    $('#employee')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'username is required'
                        }
                    }
                },
                email: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'email is required'
                        }
                    }
                },
                mobile: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'contact no is required'
                        }
                    }
                },
                pan: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'pan number is required'
                        }
                    }
                },
                adhar: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'adhar is required'
                        }
                    }
                },
               
                
                fileno: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'The fileno is required'
                        },
                        /*integer: {
                            message: 'only number are allowed'
                        },*/
                        remote: {
                            message: 'The fileno already use',
                            url: 'ajax/inward_file_no_exists.php',
                            type: 'POST',
                            delay: 200
                        },
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
            /*files = $form.find('[name="id_card_f"]')[0].files;
            $.each(files, function(i, file) {
                formData.append('id_card_f', file);
            });
            files = $form.find('[name="id_card_b"]')[0].files;
            $.each(files, function(i, file) {
                formData.append('id_card_b', file);
            });
            files = $form.find('[name="proof_address"]')[0].files;
            $.each(files, function(i, file) {
                formData.append('proof_address', file);
            });
            files = $form.find('[name="proof_bank"]')[0].files;
            $.each(files, function(i, file) {
                formData.append('proof_bank', file);
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
                        text: "Employee Successfully Added !",
                        timer: 800,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        $('#add_company_modal').modal('hide');
                    }, 700);
                    //alert(result);
                    setTimeout(function() {
                        table.ajax.reload(null, false);
                    }, 900);
                    setTimeout(function() {
                        table.cell(':eq(1)').focus();
                    }, 1500);
                    $('#employee').data('formValidation').resetForm(true);
                    $("#employee")[0].reset();
                    $("#add-more-branch").html('');
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
                    $('#addsave').html('Save');
                    $('#addsave').attr('disabled', false);
                    $('#addsave').removeClass('disabled');

                }
            });
        });

    

    $('#edit_employee')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'username is required'
                        }
                    }
                },
                email: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'email is required'
                        }
                    }
                },
                mobile: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'contact no is required'
                        }
                    }
                },
                pan: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'pan number is required'
                        }
                    }
                },
                adhar: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'adhar is required'
                        }
                    }
                },
               
                
                fileno: {
                    row: ".col-md-4",
                    validators: {
                        notEmpty: {
                            message: 'The fileno is required'
                        },
                        /*integer: {
                            message: 'only number are allowed'
                        },*/
                        remote: {
                            message: 'The fileno already use',
                            url: 'ajax/inward_file_no_exists.php',
                            type: 'POST',
                            data: function(d){
                               return {'id':$("#inwardid").val()}
                            },
                            delay: 200
                        },
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
                    $('#updatesave').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                    $('#updatesave').html('Save');
                    swal({
                        type: "success",
                        title: "Success",
                        text: "Employee Successfully Updated !",
                        timer: 800,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        $('#update_company_modal').modal('hide');
                    }, 700);
                    //alert(result);
                    setTimeout(function() {
                        table.ajax.reload(null, false);
                    }, 900);
                    setTimeout(function() {
                        table.cell(':eq(1)').focus();
                    }, 1500);
                    $('#edit_employee').data('formValidation').resetForm(true);
                    $("#edit_employee")[0].reset();
                    $("#add-more-branch-edit").html('');

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
            url: "ajax/Delete/Delete-Inward.php",
            data: "id=" + id,
            success: function() {
                swal({
                    type: "success",
                    title: "Deleted",
                    text: "Inward Successfully Deleted !",
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
$("body").on("click", "#leave", function() {
    let id = $('.selected td:eq(0)').text();
    $("#leave_form_id").val(id)
    $.ajax({
        type: "POST",
        url: "ajax/Fetch/Fetch-Employee.php",
        data: "id=" + id,
        dataType: "json",
        success: function(result) {

            $("#leave_application").modal('show');
            $("#leave_name").html("Employee Name: " + result.name + " " + result.surname);
            $("#leave_company").html((result.company.name) ? 'Company Name: ' + result.company.name : "Company Name: ");
            $("#leave_branch").html((result.branch_name) ? 'Branch Name: ' + result.branch_name : "Branch Name: ");

        }
    })

})

$('#renumeration_form').formValidation({
    framework: 'bootstrap',
    icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {

    }
}).on('success.form.fv', function(e) {
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
            $('#addsave').html('<i class="fa fa-spinner fa-spin"></i>');
        },
        success: function(result) {
            $('#addsave').html('Save');
            swal({
                type: "success",
                title: "Success",
                text: "Renumeration Successfully Added !",
                timer: 800,
                showConfirmButton: false
            });
            setTimeout(function() {
                $('#renumeration').modal('hide');
            }, 700);
            //alert(result);
            setTimeout(function() {
                table.ajax.reload(null, false);
            }, 900);

            $("#renumeration_form")[0].reset();
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
            $('#renumeration_form_save').html('Save');
            $('#renumeration_form_save').attr('disabled', false);
            $('#renumeration_form_save').removeClass('disabled');

        }
    });
});
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

    if (flag) {
        flag = true;
        
        $("#save_employee").hide();
        $("#edit_title").html('View-Employee');
    } else {
       
        $("#save_employee").show();
        $("#edit_title").html('Update Inward');
    }
    $.ajax({
        type: "POST",
        url: "ajax/Fetch/Fetch-Inward.php",
        data: "id=" + id,
        dataType: "json",
        success: function(data) {

            $('#update_company_modal').modal('show');
            console.log(data.username);
            
            $('#update_company_modal input[name="username"]').val(data.username);
            $('#update_company_modal select[name="return_type"]').val(data.return_type);
            $('#update_company_modal input[name="pan"]').val(data.pan);
            $('#update_company_modal input[name="adhar"]').val(data.adhar);
            $('#update_company_modal input[name="email"]').val(data.email);
            $('#update_company_modal input[name="mobile"]').val(data.mobile);
            $('#update_company_modal input[name="fileno"]').val(data.fileno);
            $('#update_company_modal textarea[name="address"]').val(data.address);
            $('#inwardid').val(data.id);

            let bank = (data.bank)?data.bank:[];
            console.log(bank)
            for(let i=0;i<bank.length;i++){
                if(i==0){
                    
                  $('#update_company_modal input[name="bankname[]"]').val(bank[i].bank);
                  $('#update_company_modal input[name="ifsc[]"]').val(bank[i].ifsc);
                  $('#update_company_modal input[name="accountno[]"]').val(bank[i].account_number);
                  $("#add-more-branch-edit").append('<input type="hidden" name="bankid[]" value="'+bank[i].id+'">') ;
                }else{
                  next = next_edit + 1;

                   var newIn = ' <div id="branch_row_edit_'+next_edit+'">&nbsp;<div class=row><div class=col-md-4><label for="">Bank Name</label> <input class=form-control name=bankname[] placeholder="Enter Bank Name" value="'+bank[i].bank+'"></div><div class=col-md-3><label for="">IFSC</label> <input type="hidden" name="bankid[]" value="'+bank[i].id+'"><input class=form-control name=ifsc[] value="'+bank[i].ifsc+'" placeholder="Enter IFSC"></div><div class=col-md-3><label for="">Account No</label> <input class=form-control name=accountno[] value="'+bank[i].account_number+'" placeholder="Enter Account No"></div><div class=col-md-1 style=margin-top:30px><label for=""></label> <button class="remove_branch_edit btn btn-danger" dataid="'+next_edit+'" name="remove" class="btn btn-danger"><i class="fa fa-trash"></i></button></div></div></div></div></div>';
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