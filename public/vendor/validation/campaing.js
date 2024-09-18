$("#CampaingAddForm").validate({
    rules: {
        name: "required",
        template: "required",
        contactList: "required",
        senders: "required",
        categories: "required",
        countries: "required",
    },
    messages: {
        name: "Please Enter name",
        template: "Please Select Template Name",
        contactList: "Please Select Contact List",
        senders: "Please Select senders",
        categories: "Please Select category",
        countries: "Please Select Country",
    },
    submitHandler: function(form) {
        $(".preloader").css('height', '');
        $(".animation__shake").fadeIn();
        var FN = document.createElement("input");
        FN.setAttribute("type", "hidden");
        FN.setAttribute("name", "created_at");

        form.appendChild(FN);
        var date_ob = new Date();
        var day = ("0" + date_ob.getDate()).slice(-2);
        var month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
        var year = date_ob.getFullYear();

        var date = year + "-" + month + "-" + day;
        console.log(date);

        var hours = date_ob.getHours();
        var minutes = date_ob.getMinutes();
        var seconds = date_ob.getSeconds();

        var dateTime = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
        console.log(dateTime);
        FN.setAttribute("value", dateTime);
        $("#CampaingaddFormSubmit").prop("disabled", true);
        $("#save&send").prop("disabled", true);
        form.submit();
    }
});
$("#senderaddForm").validate({
    rules: {
        sendername: "required",
    },
    messages: {
        sendername: "Please Enter Sender Name",
    },
    submitHandler: function(form) {
        
        //form.submit();
         $.ajax({
            url: "/campaignSender/save",
            method: 'post',
            data: $("#senderaddForm").serialize() ,
            success: function(data){
                if(data.status=='success'){
                    $("#senderAddFormModal").modal("hide");
                    $("#addSenderList").append('<option value='+data.result.id+'>'+data.result.sender_name+'</option>');
                    $("#editCmpSender").append('<option value='+data.result.id+'>'+data.result.sender_name+'</option>');
                }
            }   
        });
    }
});
$("body").on("click", "#campaingNextStep", function() {

    if ($("body").find("input[name=name]").val().trim() == '') {
        alert('Please enter name');
        return false;
    }

    if ($("body").find("select[name=categories]").val().trim() == '') {
        alert('Please Select category');
        return false;
    }
    if ($("body").find("select[name=countries]").val().trim() == '') {
        alert('Please Select Country');
        return false;
    }
    $("body").find(".campaingNextStep").remove();
    $("body").find(".nextStep").show();
    $("body").find("#addCampaignModal").addClass('modal-xl');
    $("body").find("#addCampaignGrig").removeClass('col-md-12');
    $("body").find("#addCampaignGrig").addClass('col-md-6');
    $("body").find("#campaignFinalStep").show();
})
$("#CampaingEditForm").validate({
    rules: {
        name: "required",
        template: "required",
        contactList: "required",
        senders: "required",
    },
    messages: {
        name: "Please Enter name",
        template: "Please Select Template Name",
        contactList: "Please Select Contact List",
        senders: "Please Select senders",
    },
    submitHandler: function(form) {
        $(".preloader").css('height', '');
        $(".animation__shake").fadeIn();
        var FN = document.createElement("input");
        FN.setAttribute("type", "hidden");
        FN.setAttribute("name", "updated_at");

        form.appendChild(FN);
        var date_ob = new Date();
        var day = ("0" + date_ob.getDate()).slice(-2);
        var month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
        var year = date_ob.getFullYear();

        var date = year + "-" + month + "-" + day;
        console.log(date);

        var hours = date_ob.getHours();
        var minutes = date_ob.getMinutes();
        var seconds = date_ob.getSeconds();

        var dateTime = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
        console.log(dateTime);

        FN.setAttribute("value", dateTime);
        $("#CampaingaddFormSubmit").prop("disabled", true);
        $("#save&send").prop("disabled", true);
        form.submit();
    }
});
$("body").on('click', ".CampaingAddFormModal", function() {
    $(".textAddFormData").attr('dataid', '');
    $("body").find("#TextAddForm")[0].reset();
    $("body").find("#CampaingEditForm")[0].reset();
    $("body").find("#CampaingAddForm")[0].reset();
})
$("body").on("click", ".textAddFormData", function() {

    $("body").find("#TextAddForm")[0].reset();
    let id = $(this).attr('dataid');
    $("#campaignId").val(id);
    $("#TextAddForm").attr("action", "/textTemplate/save");
    console.log('id : ', id);
    $("#templateList").html("");

    if (id != null) {
        // e.preventDefault(); 
        //var $this = $(this); // `this` refers to the current form element
        if ($('.categoryTarget').val()) {
            var categories = $('.categoryTarget').val();
        } else {
            var categories = $('#categoryList').val();
        }
        if ($('.countriesTarget').val()) {
            var countries = $('.countriesTarget').val();
        } else {
            var countries = $('#editCountry').val();
        }
        $.ajax({
            type: "POST",
            url: "/getTemplates/all",
            /*dataType: "json",*/
            data: {
                id: id,
                categories: categories,
                countries: countries
            },
            success: function(data) {
                console.log('waiting for response ::::: 30 ');
                if (data.error) {
                    alert(data.error)
                } else {
                    var templateData = JSON.parse(data);
                    let htmlTxt = "<table class='table table-bordered table-striped dataTable no-footer dtr-inline'><thead><tr><th>TemplateName</th><th>Message</th><th>Action</th></tr></thead><tboday>";
                    if (templateData.length) {
                        for (var i = 0; i < templateData.length; i++) {
                            htmlTxt += "<tr id='temp_row_" + templateData[i].id + "'><td id='tempName_" + templateData[i].id + "'><div class='form-group'><input type='text' class='form-control temp_name_" + templateData[i].id + "' name='tempName'  placeholder='Template Name' value=" + templateData[i].name + "></div></td><td><div class='form-group'><textarea name='tempMessage' class='form-group temp_message_" + templateData[i].id + "'  id=" + templateData[i].id + ">" + templateData[i].message + "</textarea></td></div><td><input type='hidden' class='temp_id_" + templateData[i].id + "' name='tempId' value=" + templateData[i].id + "><a  type='button'  class='btn btn-danger btn-sm deleteTemp' dataid=" + templateData[i].id + " id='tempMessage_" + templateData[i].id + "' campaignId=" + templateData[i].campaignId + " title='Delete'  ><i class='fa fa-trash'></i></a></td></tr>";

                        }
                    } else {
                        htmlTxt += "<tr><td colspan='3' style='text-align:center'>No data available in table</td></tr>";
                    }
                    if (categories != '') {
                        $("#templateCategoryList").val(categories);
                        $("#templateCategoryList").attr('disabled', true);
                    }
                    if (countries != '') {
                        $("#templateCountryList").val(countries);
                        $("#templateCountryList").attr('disabled', true);
                    }

                    htmlTxt += "</tboday></table>";
                    $("#templateList").html(htmlTxt);

                }
            }
        });

    }
});
$("#scheduleRegId").change(function() {
    var ischecked= $(this).is(':checked');
    if(ischecked){
        $(".scheduleRegId").attr('disabled',false);
        $("#creatSaveSend").hide();
    }else{
        $(".scheduleRegId").attr('disabled',true);
        $("#creatSaveSend").show();
    }
    
});
 $("#editscheduleRegId").change(function() {
    var ischecked= $(this).is(':checked');
    if(ischecked){
        $(".editscheduleRegId").attr('disabled',false);
        $("#editsaveSend").hide();
    }else{
        $(".editscheduleRegId").attr('disabled',true);
        $("#editsaveSend").show();
    }
    
}); 



$("#TextAddForm").submit(function(e) {

    //if(!($("#campaignId").val())){
    e.preventDefault();
    var $this = $(this); // `this` refers to the current form element
    $.ajax({
        type: "POST",
        url: "/saveCampingTemplate/save",
        /*dataType: "json",*/
        data: $this.serialize(),
        success: function(data) {
            if (data.error) {
                alert(data.error)
            } else {
                console.log($(this).serialize())
                //if(!data.hasOwnProperty('flag')){
                //$("#templateLoop").append('<option value="'+data.id+'">'+data.name+'</option>');
                // $("#editTemplateLoop").append('<option value="'+data.id+'" class="edit_template edit_temp_id_'+data.id+'">'+data.name+'</option>');

                //}
                let templateData = data;
                let tempHtml = '';
                let tempHtml2 = '';
                let selected = $('#editTemplateLoop').val().toString();
                selected = selected.split(',');
                for (var i = 0; i < templateData.length; i++) {
                    let index = selected.indexOf(templateData[i].id.toString());
                    index = (index > -1) ? 'selected' : '';
                    let msg = (templateData[i].message) ? '(' + templateData[i].message + ')' : '';
                    tempHtml += '<option value=' + templateData[i].id + '  id="temp_id_' + templateData[i].id + '">' + templateData[i].name + ' ' + msg + '</option>';
                    tempHtml2 += '<option value="' + templateData[i].id + '" ' + index + ' class="edit_template edit_temp_id_' + templateData[i].id + '">' + templateData[i].name + ' ' + msg + '</option>';
                }
                $("#templateLoop").html(tempHtml);
                $("#editTemplateLoop").html(tempHtml2);
                $("#textAddFormModal").modal("hide");

            }
        }
    });

    // }

});
$("body").on("click", ".deleteTemp", function() {
    let tempId = $(this).attr('dataid');
    let campaignId = $(this).attr('campaignId');
    if (confirm("Are you sure you want to delete this template?")) {
        $.ajax({
            type: "POST",
            url: "/template/delete",
            dataType: "json",
            data: {
                "tempId": tempId,
                "campaignId": campaignId
            },
            success: function(data) {
                if (data.error) {
                    alert(data.error)
                } else {
                    $("#temp_row_" + tempId).remove();
                }
            }
        });
    }
})
$("body").on("click", ".textAddFormDataTmp", function() {
    $("#TextAddForm")[0].reset();
    let id = $(this).attr('dataid');
    $("#campaignId").val(id);
    $("#TextAddForm").attr("action", "/textTemplate/save");
    console.log('id : ', id);
    $("#templateList").html("");
    if (id == null) {
        // e.preventDefault(); 
        //var $this = $(this); // `this` refers to the current form element
        $.ajax({
            type: "POST",
            url: "/getTemplates/all",
            /*dataType: "json",*/
            data: {
                id: id,
                categories: $("#categoryList").val(),
                countries: $("#editCountry").val()
            },
            success: function(data) {
                console.log('waiting for response ::::: 30 ');
                if (data.error) {
                    alert(data.error)
                } else {
                    let templateData = JSON.parse(data);
                    let tempHtml = '';
                    let tempHtml2 = '';
                    let selected = $('#editTemplateLoop').val().toString();
                    console.log("templateData==", templateData)
                    selected = selected.split(',');
                    for (var i = 0; i < templateData.length; i++) {
                        let index = selected.indexOf(templateData[i].id.toString());
                        index = (index > -1) ? 'selected' : '';
                        let msg = (templateData[i].message) ? '(' + templateData[i].message + ')' : '';
                        tempHtml += '<option value=' + templateData[i].id + '  id="temp_id_' + templateData[i].id + '">' + templateData[i].name + ' ' + msg + '</option>';
                        tempHtml2 += '<option value="' + templateData[i].id + '" ' + index + ' class="edit_template edit_temp_id_' + templateData[i].id + '">' + templateData[i].name + ' ' + msg + '</option>';
                    }
                    $("#templateLoop").html(tempHtml);
                    $("#editTemplateLoop").html(tempHtml2);
                    $("#textAddFormModal").modal("hide");

                }
            }
        });

    }
});
$("body").on("click", ".abTesting", function() {
    if ($(this).prop('checked') == true) {
        $(".percent").show();
    } else {
        $(".percent").hide();

    }
});
$(document).ready(function() {
    $("body").on("click", "#mmd_channel,#deliverhub_channel,#textlocal_channel,#abTesting,#textbox_channel,#p1sms_channel,#smsstudio_channel", function() {
        if ($("#abTesting").prop('checked')) {
            $("#mmd_channel").attr('disabled', false);
            $("#deliverhub_channel").attr('disabled', false);
            $("#textlocal_channel").attr('disabled', false);
            $("#textbox_channel").attr('disabled', false);
            $("#smsstudio_channel").attr('disabled', false);
            $("#p1sms_channel").attr('disabled', false);
            $("#smsedge_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $("body").find("#contactSendDetailEdit").show();
        } else {
            $("body").find("#contactSendDetailEdit").hide();
            if ($("#mmd_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#p1sms_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $("#smsedge_channel").attr('disabled', false);
                $("#smsstudio_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);
                $("#p1sms_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $("#smsedge_channel").attr('disabled', true);
                $("#smsstudio_channel").attr('disabled', true);
                $(".textboxchannels").attr('disabled', true);

            } else if ($("#deliverhub_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $("#smsstudio_channel").attr('disabled', false);
                $("#p1sms_channel").attr('disabled', false);
                $("#smsedge_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $("#p1sms_channel").attr('disabled', true);
                $("#smsstudio_channel").attr('disabled', true);
                $("#smsedge_channel").attr('disabled', true);
                $(".textboxchannels").attr('disabled', true);

            } else if ($("#textlocal_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $("#smsedge_channel").attr('disabled', false);
                $("#p1sms_channel").attr('disabled', false);
                $("#smsstudio_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#deliverhub_channel").attr('disabled', true);
                $("#p1sms_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $("#smsstudio_channel").attr('disabled', true);
                $("#smsedge_channel").attr('disabled', true);
                $(".textboxchannels").prop('disabled', true);


            } else if ($("#smsstudio_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $("#p1sms_channel").attr('disabled', false);
                $("#smsedge_channel").attr('disabled', false);
                $("#smsstudio_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#deliverhub_channel").attr('disabled', true);
                $("#p1sms_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $("#smsedge_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);
                $(".textboxchannels").prop('disabled', true);


            } else if ($("#p1sms_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $("#p1sms_channel").attr('disabled', false);
                $("#smsstudio_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#smsedge_channel").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#deliverhub_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);
                $("#smsstudio_channel").attr('disabled', true);
                $("#smsedge_channel").attr('disabled', true);
                $(".textboxchannels").prop('disabled', true);


            } else if ($("#textbox_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $("#p1sms_channel").attr('disabled', false);
                $("#smsstudio_channel").attr('disabled', false);
                $("#smsedge_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#deliverhub_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);
                $("#smsstudio_channel").attr('disabled', true);
                $("#smsedge_channel").attr('disabled', true);
                $("#p1sms_channel").attr('disabled', true);
                $(".textboxchannels").attr('disabled', true);
            } else if ($("#smsedge_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $("#p1sms_channel").attr('disabled', false);
                $("#smsstudio_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#smsedge_channel").attr('disabled', true);
                $("#deliverhub_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);
                $("#smsstudio_channel").attr('disabled', true);
                $("#p1sms_channel").attr('disabled', true);
                $(".textboxchannels").prop('disabled', true);


            }else {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $("#smsstudio_channel").attr('disabled', false);
                $("#p1sms_channel").attr('disabled', false);
                $("#smsedge_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
            }
        }
    });
});
$("body").on("click", ".mmd_channel,.deliverhub_channel,.textlocal_channel,.abTesting,.textbox_channel,.p1sms_channel,.smsstudio_channel,.smsedge_channel", function() {
    if ($(".abTesting").prop('checked')) {
        $(".mmd_channel").attr('disabled', false);
        $(".deliverhub_channel").attr('disabled', false);
        $(".textlocal_channel").attr('disabled', false);
        $(".textbox_channel").attr('disabled', false);
        $(".p1sms_channel").attr('disabled', false);
        $(".smsstudio_channel").attr('disabled', false);
        $(".smsedge_channel").attr('disabled', false);
        $(".textboxchannels").attr('disabled', false);
        $(".smsedge_channel").attr('disabled', false);
        $("body").find("#contactSendDetailEdit").show();
    } else {
        $("body").find("#contactSendDetailEdit").hide();
        if ($(".mmd_channel").prop('checked')) {
            $(".mmd_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', false);
            $(".textlocal_channel").attr('disabled', false);
            $(".textbox_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".smsstudio_channel").attr('disabled', false);
            $(".smsedge_channel").attr('disabled', false);
            $(".p1sms_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', true);
            $(".textlocal_channel").attr('disabled', true);
            $(".textbox_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
            $(".p1sms_channel").attr('disabled', true);
            $(".smsedge_channel").attr('disabled', true);
            $(".smsstudio_channel").attr('disabled', true);
        } else if ($(".deliverhub_channel").prop('checked')) {
            $(".mmd_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', false);
            $(".textlocal_channel").attr('disabled', false);
            $(".textbox_channel").attr('disabled', false);
            $(".p1sms_channel").attr('disabled', false);
            $(".smsstudio_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".smsedge_channel").attr('disabled', false);
            $(".mmd_channel").attr('disabled', true);
            $(".textlocal_channel").attr('disabled', true);
            $(".textbox_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
            $(".p1sms_channel").attr('disabled', true);
            $(".smsstudio_channel").attr('disabled', true);
            $(".smsedge_channel").attr('disabled', true);
        } else if ($(".textlocal_channel").prop('checked')) {
            $(".mmd_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', false);
            $(".textlocal_channel").attr('disabled', false);
            $(".p1sms_channel").attr('disabled', false);
            $(".textbox_channel").attr('disabled', false);
            $(".smsstudio_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".smsedge_channel").attr('disabled', false);
            $(".mmd_channel").attr('disabled', true);
            $(".deliverhub_channel").attr('disabled', true);
            $(".textbox_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
            $(".p1sms_channel").attr('disabled', true);
            $(".smsstudio_channel").attr('disabled', true);
            $(".smsedge_channel").attr('disabled', true);
        } else if ($(".p1sms_channel").prop('checked')) {
            $(".mmd_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', false);
            $(".textlocal_channel").attr('disabled', false);
            $(".textbox_channel").attr('disabled', false);
            $(".smsstudio_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".p1sms_channel").attr('disabled', false);
            $(".smsedge_channel").attr('disabled', false);
            $(".mmd_channel").attr('disabled', true);
            $(".deliverhub_channel").attr('disabled', true);
            $(".textbox_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
            $(".textlocal_channel").attr('disabled', true);
            $(".smsstudio_channel").attr('disabled', true);
            $(".smsedge_channel").attr('disabled', true);

        } else if ($(".textbox_channel").prop('checked')) {
            $(".mmd_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', false);
            $(".p1sms_channel").attr('disabled', false);
            $(".textlocal_channel").attr('disabled', false);
            $(".smsstudio_channel").attr('disabled', false);
            $(".textbox_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".smsedge_channel").attr('disabled', false);
            $(".mmd_channel").attr('disabled', true);
            $(".deliverhub_channel").attr('disabled', true);
            $(".textlocal_channel").attr('disabled', true);
            $(".smsstudio_channel").attr('disabled', true);
            $(".p1sms_channel").attr('disabled', true);
            $(".smsedge_channel").attr('disabled', true);

        } else if ($(".smsstudio_channel").prop('checked')) {
            $(".mmd_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', false);
            $(".p1sms_channel").attr('disabled', false);
            $(".textlocal_channel").attr('disabled', false);
            $(".smsstudio_channel").attr('disabled', false);
            $(".textbox_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".smsedge_channel").attr('disabled', false);
            $(".mmd_channel").attr('disabled', true);
            $(".deliverhub_channel").attr('disabled', true);
            $(".textlocal_channel").attr('disabled', true);
            $(".textbox_channel").attr('disabled', true);
            $(".p1sms_channel").attr('disabled', true);
            $(".smsedge_channel").attr('disabled', true);

        } else if ($(".smsedge_channel").prop('checked')) {
            $(".mmd_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', false);
            $(".p1sms_channel").attr('disabled', false);
            $(".textlocal_channel").attr('disabled', false);
            $(".smsstudio_channel").attr('disabled', false);
            $(".textbox_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".smsedge_channel").attr('disabled', false);
            $(".mmd_channel").attr('disabled', true);
            $(".deliverhub_channel").attr('disabled', true);
            $(".textlocal_channel").attr('disabled', true);
            $(".textbox_channel").attr('disabled', true);
            $(".p1sms_channel").attr('disabled', true);
            $(".smsstudio_channel").attr('disabled', true);

        } else {
            $(".mmd_channel").attr('disabled', false);
            $(".deliverhub_channel").attr('disabled', false);
            $(".textlocal_channel").attr('disabled', false);
            $(".p1sms_channel").attr('disabled', false);
            $(".smsstudio_channel").attr('disabled', false);
            $(".textbox_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".smsedge_channel").attr('disabled', false);
        }
    }
});
$("body").on("click", ".deleteMasterTemp", function() {
    if ($(this).attr('is_deleted') == '0') {
        var is_deleted = 0;
        var msg = 'Are you sure want to Disable this template?';
    } else {
        is_deleted = 1;
        var msg = 'Are you sure want to Enable this template?';
    }
    let tempId = $(this).attr('dataid');
    if (confirm(msg)) {
        if (is_deleted == 0) {
            $("#tempMessage_" + tempId).html('<i class="fa fa-lock"></i>');
        } else {
            $("#tempMessage_" + tempId).html('<i class="fa fa-unlock"></i>');
        }
        $.ajax({
            type: "POST",
            url: "/template/enableDisable",
            dataType: "json",
            data: {
                "tempId": tempId
            },
            success: function(data) {
                if (data.error) {
                    alert(data.error)
                } else {

                    if (is_deleted == 0) {

                        $(".temp_name_" + tempId).attr("disabled", true);
                        $(".temp_message_" + tempId).attr("disabled", true);
                        $(".temp_id_" + tempId).attr("disabled", true);
                        $("#tempMessage_" + tempId).attr("is_deleted", '1');

                    } else {

                        $(".temp_name_" + tempId).attr("disabled", false);
                        $(".temp_message_" + tempId).attr("disabled", false);
                        $(".temp_id_" + tempId).attr("disabled", false);
                        $("#tempMessage_" + tempId).attr("is_deleted", '0');
                    }
                }
            }
        });
    }

});
$("body").on("click", ".sendCampaign", function() {
    let ids = $(this).attr('dataid');
    var date_ob = new Date();
    var day = ("0" + date_ob.getDate()).slice(-2);
    var month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
    var year = date_ob.getFullYear();

    var date = year + "-" + month + "-" + day;
    console.log(date);

    var hours = date_ob.getHours();
    var minutes = date_ob.getMinutes();
    var seconds = date_ob.getSeconds();
    //var millisec = date_ob.getMillisec();
    var dateTime = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
    if (confirm("Are you sure want to send campaign?")) {
        //console.log('/campaing/delete/'+ids+'/'+dateTime)
        window.location.href = '/send/campaign/' + ids + '/' + dateTime;
    }
});

/***** On change value of percent box ***/
$("body").on("keyup keydown click", ".percentInput, .quantityInput, .Calculate", function(e) {
    console.log("keycode=", e.which)
    console.log("key=", e.key)
    console.log("getClass = =", e)
    console.log("getClass = =", e.currentTarget.classList);
    console.log("getClass = =", Array.from(e.currentTarget.classList));
    console.log("getClass = = index", Array.from(e.currentTarget.classList).indexOf('Calculate'));

    let percentVal = $(".percentInput").val();
    if (percentVal > 100) {
        alert("Please Enter a value upto 100%");
        $(".percentInput").val("");
        return false;
    }

    let quantityInput = $(".quantityInput").val();

    if (quantityInput.indexOf('.') > -1) {
        alert('Use WHOLE numbers only');
        $(".quantityInput").val("");
        return false;
    }

    let contactList = $('#contactList :selected').val();
    let campaignId = "";

    // alert("percentVal="+percentVal+" contactList="+contactList);
    console.log('percentVal : ', percentVal, " contactList : ", contactList, " campaignId : ", campaignId, "quantityInput : ", quantityInput);

    if (e.which == 13 || Array.from(e.currentTarget.classList).indexOf('Calculate')>-1) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/getContactPercentage",
            dataType: "json",
            data: {
                "percentVal": percentVal,
                "contactList": contactList,
                "campaignId": campaignId,
                "quantityInput": quantityInput
            },
            success: function(data) {

                if (data.error) {
                    alert(data.error)
                } else {
                    console.log("dataContactPercentage : ", data);
                    let percentageData = "<b>" + data.totaContactSelected + "/" + data.totalContacts + "</b>";

                    if (quantityInput != "") {
                        if (quantityInput > data.totalContacts) {
                            alert("Qty cannot exceed total available leads");
                            $(".percentInput").val("");
                            $(".quantityInput").val("");
                        } else {
                            $(".percentInput").val(data.contactPercentageVal);
                        }
                    }


                    $("#contactSendDetail").html(percentageData);
                }
            }
        });
    }

});
$("body").on("keyup keydown click", "#ab_percent, #ab_percent_QTY, .Calculate", function(e) {

    console.log("keycode=", e.which)
    console.log("key=", e.key)
    console.log("getClass = =", e)
    console.log("getClass = =", e.currentTarget.classList);
    console.log("getClass = =", Array.from(e.currentTarget.classList));
    console.log("getClass = = index", Array.from(e.currentTarget.classList).indexOf('Calculate'));
    let percentVal = $("#ab_percent").val();
    if (percentVal > 100) {
        alert("Please Enter a value upto 100%");
        $("#ab_percent").val("");
        return false;
    }
    let quantityInput = $("#ab_percent_QTY").val();

    if (quantityInput.indexOf('.') > -1) {
        alert('Use WHOLE numbers only');
        $("#ab_percent_QTY").val("");
        return false;
    }

    let contactList = $('#contactList :selected').val();

    const element = document.getElementById("CampaingEditForm");
    let textAction = element.getAttribute("action");
    console.log('textAction ::::::', textAction, " : ", textAction.split('/'));
    let campaignId = textAction.split('/')[3];
    console.log('campaignId : ', campaignId);
    if (campaignId) {
        contactList = $('#editCmpContact :selected').val();
    }
    // alert("percentVal="+percentVal+" contactList="+contactList);
    console.log('percentVal : ', percentVal, " contactList : ", contactList, " campaignId : ", campaignId);
    if (e.which == 13 || Array.from(e.currentTarget.classList).indexOf('Calculate')>-1) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/getContactPercentage",
            dataType: "json",
            data: {
                "percentVal": percentVal,
                "contactList": contactList,
                "campaignId": campaignId,
                "quantityInput": quantityInput
            },
            success: function(data) {
                if (data.error) {
                    alert(data.error)
                } else {
                    console.log("dataContactPercentage : ", data);
                    let percentageData = "<b>" + data.totaContactSelected + "/" + data.totalContacts + "</b>";
                    if (quantityInput != "") {
                        if (quantityInput > data.totalContacts) {
                            alert("Qty cannot exceed total available leads");
                            $("#ab_percent").val("");
                            $("#ab_percent_QTY").val("");
                        } else {
                            $("#ab_percent").val(data.contactPercentageVal);
                        }

                    }

                    $("#contactSendDetailEdit").html(percentageData);
                }
            }
        });
    }
});
$("body").on('change', '.categoryTarget, .countriesTarget', function() {
    $.ajax({
        type: "POST",
        url: "/getTemplates/all",
        /*dataType: "json",*/
        data: {
            categories: $('.categoryTarget').val(),
            countries: $('.countriesTarget').val()
        },
        success: function(data) {
            console.log('waiting for response ::::: 30 ');
            if (data.error) {
                alert(data.error)
            } else {

                let templateData = JSON.parse(data);
                let tempHtml = '';
                let tempHtml2 = '';
                let selected = $('#editTemplateLoop').val().toString();
                selected = selected.split(',');
                for (var i = 0; i < templateData.length; i++) {
                    let index = selected.indexOf(templateData[i].id.toString());
                    index = (index > -1) ? 'selected' : '';
                    let msg = (templateData[i].message) ? '(' + templateData[i].message + ')' : '';
                    tempHtml += '<option value=' + templateData[i].id + '  id="temp_id_' + templateData[i].id + '">' + templateData[i].name + ' ' + msg + '</option>';
                    tempHtml2 += '<option value="' + templateData[i].id + '" ' + index + ' class="edit_template edit_temp_id_' + templateData[i].id + '">' + templateData[i].name + ' ' + msg + '</option>';
                }
                $("#templateLoop").html(tempHtml);
                $("#editTemplateLoop").html(tempHtml2);
                $("#textAddFormModal").modal("hide");

            }
        }
    });
    $.ajax({
        type: "POST",
        url: "/getContactList/all",
        dataType: "json",
        data: {
            categories: $('.categoryTarget').val(),
            countries: $('.countriesTarget').val()
        },
        success: function(data) {
            console.log('waiting for response ::::: 30 ');
            if (data.error) {
                alert(data.error)
            } else {
                console.log(data)
                let contactList = '<option value="">Select Contact List</option>';
                let offerList = '<option value="">Select Offer List</option>';
                for (let i = 0; i < data.contact.length; i++) {
                    contactList += '<option value=' + data.contact[i].id + '>' + data.contact[i].name + ' (' + data.contact[i].totalContact + ')</option>';
                }
                for (let i = 0; i < data.offer.length; i++) {
                    let comment = (data.offer[i].comment) ? '(' + data.offer[i].comment + ')' : '';
                    let url = (data.offer[i].url) ? '(' + data.offer[i].url + ')' : '';
                    offerList += '<option value=' + data.offer[i].id + ' >' + data.offer[i].company + ' ' + comment + ' ' + url + '</option>';
                }
                $("#contactList").html(contactList);
                $("#offerList").html(offerList);
            }
        }
    });
});
$("body").on("click", ".textbox_channel, #textbox_channel", function() {
    if ($(this).is(':checked')) {

        var country_select = document.querySelector("#editCountry");
        var countries = country_select.options[country_select.selectedIndex].getAttribute('abv1');

        var country_select2 = document.querySelector("#addCountries");
        var countries2 = country_select2.options[country_select2.selectedIndex].getAttribute('abv1');

        if ((countries == '' || countries == undefined) && (countries2 == '' || countries2 == undefined)) {
            alert("Please Select Country");
            return false;
        }
        $(".preloader").css('height', '');
        $(".animation__shake").fadeIn();
        $.ajax({
            type: "POST",
            url: "/textBoxRoutes",
            dataType: "json",
            data: {
                "countries": (countries) ? countries : countries2
            },
            success: function(data) {
                $(".preloader").css('height', 0);
                $(".animation__shake").fadeOut();
                if (data.error) {
                    alert(data.error)
                } else {
                    let routes_html = '';
                    for (let i = 0; i < data.length; i++) {
                        routes_html += '<div class="col-sm-3"><div class="form-group"><div class="custom-checkbox custom-control"><input class="form-check-input textboxchannels"  name="channel" id="routes_' + data[i].id + '" type="checkbox" value="' + data[i].id + '" checked> <label class="form-check-label" for="routes_' + data[i].id + '">' + data[i].name + '</label></div></div></div>';
                    }
                    //alert(countries2)
                    if (countries2) {
                        $("body").find(".textboxRoutes").html(routes_html);
                        $("body").find(".textboxRoutes").show();
                        $("body").find(".textboxRoutesEdit").html('');
                    } else {
                        $("body").find(".textboxRoutesEdit").html(routes_html);
                        $("body").find(".textboxRoutesEdit").show();
                        $("body").find(".textboxRoutes").html('');
                    }


                    console.log("dataContactPercentage : ", data);

                }
            }
        });
    } else {
        $("body").find(".textboxRoutes").html('');
        $("body").find(".textboxRoutesEdit").html('');
    }

});