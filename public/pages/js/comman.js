$(function() {
    var host = window.location.origin;
    var table_user = $('#example1').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        "initComplete": function() {
            $("div.toolbar")
                .html('<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i>User</a>');
        },

        "ajax": {
            url: host + "/getUsers",
            data: function(d) {
                d.rank = $('#userRank').val();
            }
        },
        "columns": [{
                "data": "username",
                render: function(data, type, row) {
                    return '<span id="username_' + row.id + '">' + row.username + '</span>';
                }
            },
            {
                "data": "email",
                render: function(data, type, row) {
                    return '<span id="email_' + row.id + '">' + row.email + '</span>';
                }
            },
            {
                "data": "role",
                render: function(data, type, row) {
                    return '<span id="role_' + row.id + '">' + row.role + '</span>';
                }
            },
            {
                "data": "createdAt",
                render: function(data, type, row) {
                    return moment(row.createdAt).format("DD/MM/YYYY HH:mm");
                }
            },
            {
                "data": "action"
            },


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


    var table_contact = $('#contact').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        "initComplete": function() {
            $("div.toolbar")
                .html('<a href="#" data-toggle="modal" data-target="#contactaddForm" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp;New List</a>');
        },

        "ajax": {
            url: host + "/getContact",
            data: function(d) {
                // d.rank = $('#userRank').val();
            }
        },
        "columns": [{
                "data": "name",
                render: function(data, type, row) {
                    return '<span id="name_' + row.id + '">' + row.name + '</span>';
                }
            },
            {
                "data": "username",
                render: function(data, type, row) {
                    return '<span id="username_' + row.id + '">' + row.username + '</span>';
                }
            },
            {
                "data": "comment",
                render: function(data, type, row) {
                    return '<span id="comment_' + row.id + '">' + row.comment + '</span>';
                }
            },
            {
                "data": "country",
                render: function(data, type, row) {
                    return '<span id="country_' + row.id + '" country="' + row.countries + '">' + row.country + '</span>';
                    return row.download;
                }
            },
            {
                "data": "createdAt",
                render: function(data, type, row) {
                    return moment(row.createdAt).format("DD/MM/YYYY HH:mm");
                }
            },
            {
                "data": "contactCount",
                render: function(data, type, row) {
                    return row.contactCount
                }
            },
            {
                "data": "action"
            },


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    var all_contact = $('#all_contact').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        "initComplete": function() {
            $("div.toolbar")
                .html('<a href="#" data-toggle="modal" data-target="#contactaddForm" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp;New Contact</a>');
        },

        "ajax": {
            url: host + "/getAllContact",
            data: function(d) {
                d.contactId = $('#contactId').val();
            }
        },
        "columns": [{
                "data": "first",
                render: function(data, type, row) {
                    return '<span id="first_' + row.id + '">' + row.first + '</span>';
                }
            },
            {
                "data": "last",
                render: function(data, type, row) {
                    return '<span id="last_' + row.id + '">' + row.last + '</span>';
                }
            },
            {
                "data": "country",
                render: function(data, type, row) {
                    return '<span id="country_' + row.id + '">' + row.country + '</span>';
                }
            },
            {
                "data": "email",
                render: function(data, type, row) {
                    return '<span id="email_' + row.id + '">' + row.email + '</span>';
                    //return row.download;
                }
            },
            {
                "data": "phone",
                render: function(data, type, row) {
                    return '<span id="phone_' + row.id + '">' + row.phone + '</span>';
                    //return row.download;
                }
            },
            {
                "data": "custom_1",
                render: function(data, type, row) {
                    return '<span id="custom_1_' + row.id + '">' + row.custom_1 + '</span>';
                    //return row.download;
                }
            },
            {
                "data": "custom_2",
                render: function(data, type, row) {
                    return '<span id="custom_2_' + row.id + '">' + row.custom_2 + '</span>';
                    //return row.download;
                }
            },
            {
                "data": "custom_3",
                render: function(data, type, row) {
                    return '<span id="custom_3_' + row.id + '">' + row.custom_3 + '</span>';
                    //return row.download;
                }
            },

            {
                "data": "action"
            },


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    var campaign = $('#Campaign').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        /*"initComplete": function(){
           $("div.toolbar")
              .html('<a href="#" data-toggle="modal" data-target="#contactaddForm" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp;New Contact</a>');           
        }  , */

        "ajax": {
            url: host + "/getCampaign",
            data: function(d) {
                d.contactId = $('#contactId').val();
            }
        },
        "columns": [{
                "data": "name",
                render: function(data, type, row) {
                    return '<a href="javascript:void(0)" dataid="' + row.id + '" contact_list="' + row.contact_list + '" offers="' + row.offers + '" comment="' + row.comment + '" channel="' + row.channel + '" senders="' + row.senders + '" abtest="' + row.ab_test + '" percent="' + row.percent + '" category="' + row.categories + '" routes="' + row.routes + '" class="edit_campaing"><span id="name_' + row.id + '">' + row.name + '</span></a>';
                }
            },
            {
                "data": "createdAt",
                render: function(data, type, row) {
                    return moment((row.updated) ? row.updated : row.updatedAt).format("DD/MM/YYYY HH:mm");
                }
            },
            {
                "data": "country",
                render: function(data, type, row) {
                    return '<span id="country_' + row.id + '" countries="' + row.countries + '">' + row.country + '</span>';
                    //return row.download;
                }
            },
            {
                "data": "contactList",
                render: function(data, type, row) {
                    return '<span id="contactList_' + row.id + '">' + row.contactList + '</span>';
                }
            },
            {
                "data": "totalDelivered",
                render: function(data, type, row) {
                    let sendStatus = row.totalDelivered + '/' + row.totalSent
                    return '<span id="sendStatus_' + row.id + '">' + sendStatus + '</span>';
                }
            },
            {
                "data": "hits",
                render: function(data, type, row) {
                    let clicks = row.hits + '/(' + row.unique_hits + ')';
                    return '<span id="hits_' + row.id + '">' + clicks + '</span>';
                }
            },
            {
                "data": "ctr",
                render: function(data, type, row) {
                    let ctr_sent = isFinite(row.ctr) && row.ctr || 0 + '(' + row.ctr_sent + ')';
                    return '<span id="ctr_sent_' + row.id + '">' + ctr_sent + '</span>';
                }
            },
            {
                "data": "cost",
                render: function(data, type, row) {
                    return '<span id="cost_' + row.id + '">' + parseFloat(row.cost.toString().slice(0, (row.cost.toString().indexOf(".")) + 3)) + '</span>';

                }
            },
            {
                "data": "channel",
                render: function(data, type, row) {
                    let cpc = isFinite(parseFloat(row.cost) / parseFloat(row.unique_hits)) && parseFloat(row.cost) / parseFloat(row.unique_hits) || 0;
                    return '<span">' + parseFloat(cpc).toFixed(2) + '</span>';
                }
            },
            {
                "data": "category",
                render: function(data, type, row) {
                    return '<span id="channel_' + row.id + '">' + row.channelWithMostSends + '</span>';
                    //return row.download;
                }
            },

            {
                "data": "username",
                render: function(data, type, row) {
                    return '<span id="username_' + row.id + '">' + row.username + '</span>';
                }
            },
            {
                "data": "category",
                render: function(data, type, row) {
                    return '<span id="category_' + row.id + '">' + row.category + '</span>';
                    //return row.download;
                }
            },
            {
                "data": "action"
            },


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

   

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' },format: 'YYYY-MM-DD HH:mm:ss',minDate: new Date() });
    $('body').find('#reservationdatetimeedit').datetimepicker({ icons: { time: 'far fa-clock' },format: 'YYYY-MM-DD HH:mm:ss',minDate: new Date(),debug: true  });
    
    //Date range picker
    

    /*** senders List 10-01-2023 ***/
    var table_sender = $('#senderTable').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        "initComplete": function() {
            $("div.toolbar")
                .html('<a href="#" data-toggle="modal" data-target="#addSenderModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i>Add Sender</a>');
        },

        "ajax": {
            url: host + "/getSenders",
            data: function(d) {
                //d.rank = $('#userRank').val();
            }
        },
        "columns": [{
                "data": "sender_name",
                render: function(data, type, row) {
                    return '<span id="sender_' + row.id + '">' + row.sender_name + '</span>';
                }
            },
            {
                "data": "message",
                render: function(data, type, row) {
                    return '<span id="message_' + row.id + '">' + row.message + '</span>';
                }
            },
            {
                "data": "action"
            },


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#senderTable_wrapper .col-md-6:eq(0)');

    /*** ./End senders List 10-01-2023 ***/

    var table_source = $('#sourceTable').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        "initComplete": function() {
            $("div.toolbar")
                .html('<a href="#" data-toggle="modal" data-target="#addSourceModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i>Add Source</a>');
        },

        "ajax": {
            url: host + "/getSource",
            data: function(d) {
                //d.rank = $('#userRank').val();
            }
        },
        "columns": [{
                "data": "source_name",
                render: function(data, type, row) {
                    return '<span id="source_' + row.id + '">' + row.source_name + '</span>';
                }
            },
            {
                "data": "message",
                render: function(data, type, row) {
                    return '<span id="message_' + row.id + '">' + row.message + '</span>';
                }
            },
            {
                "data": "action"
            },


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#sourceTable_wrapper .col-md-6:eq(0)');

    var table_offerUrl = $('#offerUrl').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        "initComplete": function() {
            $("div.toolbar")
                .html('<a href="#" data-toggle="modal" data-target="#addOfferUrlModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp; Offers/URLs</a>');
        },

        "ajax": {
            url: host + "/getOffers",
            data: function(d) {
                // d.rank = $('#userRank').val();
            }
        },
        "columns": [{
                "data": "company",
                render: function(data, type, row) {
                    return '<span id="company_' + row.id + '">' + row.company + '</span>';
                }
            },
            {
                "data": "country",
                render: function(data, type, row) {
                    return '<span id="country_' + row.id + '" dataid="' + row.countries + '">' + row.country + '</span>';
                }
            },
            {
                "data": "categories",
                render: function(data, type, row) {
                    return '<span id="category_' + row.id + '" dataid="' + row.categories + '">' + row.category + '</span>';
                }
            },
            {
                "data": "comment",
                render: function(data, type, row) {
                    return '<span id="comment_' + row.id + '">' + row.comment + '</span>';
                }
            },

            {
                "data": "tinyurl",
                render: function(data, type, row) {
                    return '<span id="tinyurl_' + row.id + '">' + row.tinyurl + '</span>';
                }
            },
            {
                "data": "url",
                render: function(data, type, row) {
                    return '<span id="url_' + row.id + '">' + row.url + '</span>';
                }
            },

            {
                "data": "action"
            },


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    var TemplateList = $('#TemplateList').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        "initComplete": function() {
            $("div.toolbar")
                .html('<a href="#" data-toggle="modal" data-target="#addTemplateModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp;New Text Template</a>');
        },

        "ajax": {
            url: host + "/getTemplateList",
            data: function(d) {
                // d.contactId = $('#contactId').val();
            }
        },
        "columns": [{
                "data": "name",
                render: function(data, type, row) {
                    return '<span id="name_' + row.id + '">' + row.name + '</span>';
                }
            },
            {
                "data": "message",
                render: function(data, type, row) {
                    return '<span id="message_' + row.id + '">' + row.message + '</span>';
                }
            },
            {
                "data": "username",
                render: function(data, type, row) {
                    return '<span id="username_' + row.id + '">' + row.username + '</span>';
                }
            },
            {
                "data": "category",
                render: function(data, type, row) {
                    return '<span id="category_' + row.id + '" category="' + row.categories + '">' + row.category + '</span>';
                }
            },
            {
                "data": "country",
                render: function(data, type, row) {
                    return '<span id="country_' + row.id + '" country="' + row.countries + '">' + row.country + '</span>';
                }
            },
            {
                "data": "createdAt",
                render: function(data, type, row) {
                    return moment(row.createdAt).format("DD/MM/YYYY HH:mm");
                }
            },

            {
                "data": "action"
            },


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    var all_country = $('#all_country').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "serverSide": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        /*"initComplete": function(){
           $("div.toolbar")
              .html('<a href="#" data-toggle="modal" data-target="#addTemplateModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp;New Text Template</a>');           
        }  , */

        "ajax": {
            url: host + "/getCountries",
            data: function(d) {
                // d.contactId = $('#contactId').val();
            }
        },
        "columns": [{
                "data": "country",
                render: function(data, type, row) {
                    return '<span id="country_' + row.id + '">' + row.country + '</span>';
                }
            },
            {
                "data": "abv1",
                render: function(data, type, row) {
                    return '<span id="abv1_' + row.id + '">' + row.abv1 + '</span>';
                }
            },
            {
                "data": "abv2",
                render: function(data, type, row) {
                    return '<span id="abv2_' + row.id + '">' + row.abv2 + '</span>';
                }
            },
            {
                "data": "dialling_code_1",
                render: function(data, type, row) {
                    return '<span id="dialling_code_1_' + row.id + '">' + row.dialling_code_1 + '</span>';
                }
            },
            {
                "data": "dialling_code_2",
                render: function(data, type, row) {
                    return '<span id="dialling_code_2_' + row.id + '">' + row.dialling_code_2 + '</span>';
                }
            },
            {
                "data": "dialling_code_3",
                render: function(data, type, row) {
                    return '<span id="dialling_code_3_' + row.id + '">' + row.dialling_code_3 + '</span>';
                }
            },

            /*{ "data": "action" },*/


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    var all_countries = $('#all_countries').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        "destroy": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        /*"initComplete": function(){
           $("div.toolbar")
              .html('<a href="#" data-toggle="modal" data-target="#addTemplateModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp;New Text Template</a>');           
        }  ,*/

        "ajax": {
            url: host + "/getCountries",
            data: function(d) {
                d.campaign = id;
            }
        },
        "columns": [

            {
                "data": "country",
                render: function(data, type, row) {
                    return '<span">' + row.country + '</span>';
                }
            },
            {
                "data": "abv1",
                render: function(data, type, row) {
                    return '<span">' + row.abv1 + '</span>';
                }
            },
            {
                "data": "abv2",
                render: function(data, type, row) {
                    return '<span">' + row.abv2 + '</span>';
                }
            },
            {
                "data": "dialling_code_1",
                render: function(data, type, row) {
                    return '<span">' + row.dialling_code_1 + '</span>';
                }
            },
            {
                "data": "dialling_code_2",
                render: function(data, type, row) {
                    return '<span">' + row.dialling_code_2 + '</span>';
                }
            },
            {
                "data": "dialling_code_3",
                render: function(data, type, row) {
                    return '<span">' + row.dialling_code_3 + '</span>';
                }
            },

            /*{ "data": "action" },*/


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    var all_categories = $('#all_categories').DataTable({
        "processing": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "serverSide": true,
        "destroy": true,
        /*"order": [[2, 'desc']],*/
        "ordering": false,
        "autoWidth": false,
        "pageLength": 10,
        "dom": 'l<"toolbar">frtip',
        "initComplete": function() {
            $("div.toolbar")
                .html('<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp;Category</a>');
        },

        "ajax": {
            url: host + "/getCategories",
            data: function(d) {

            }
        },
        "columns": [

            {
                "data": "name",
                render: function(data, type, row) {
                    return '<span">' + row.name + '</span>';
                }
            },
            /*{
              "data": "username", render: function (data, type, row) {
                return '<span id="username_'+row.id+'">'+row.username+'</span>';
              }
            },
            {
              "data": "createdAt", render: function (data, type, row) {
                return moment(row.createdAt).format("DD/MM/YYYY HH:mm");
              }
            },*/


            /*{ "data": "action" },*/


            /*{ "data": "editDel", "className": "btn-group" }*/
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $("body").on("change", "#fileContact", function() {
        let file = $(this).val();
        $.ajax({
            type: "POST",
            url: "/contact/fileread",
            dataType: "text",
            data: {
                file: file,
            },
            success: function(data) {
                //processData(data);
            }
        });
    });
    $("body").on("change", ".select2", function() {
        $(".remove_disable").prop('disabled', false);
        $("#selectedId_" + $(this).attr('dataid')).val($(this).val())
        $(".select2").each(function() {
            let ids = $(this).val();
            console.log("ids=", ids)
            $(".disable_" + ids).prop('disabled', true);
        });
    });


    $("body").on("click", ".edit_campaing", function() {

        $("body").find("#TextAddForm")[0].reset();
        $("body").find("#CampaingEditForm")[0].reset();
        $('input:checkbox').removeAttr('checked');

        let id = $(this).attr('dataid');
        $(".textAddFormData").attr('dataid', id)
        $("#refreshClick").attr("dataid", id)
        let percent = $(this).attr('percent');
        let comment = $(this).attr('comment');
        let ab_test = $(this).attr('abtest');
        let contact = $(this).attr('contact_list');
        let offers = $(this).attr('offers');
        let routes = $(this).attr('routes');
        let name = $("#name_" + id).text();

        let category = $(this).attr('category');
        let country = $("#country_" + id).attr('countries');
        let channel = $(this).attr('channel').split(',');
        $("#mmd_channel").attr("checked", false);
        $("#deliverhub_channel").attr("checked", false);
        $("#textlocal_channel").attr('checked', false);
        $("#p1sms_channel").attr('checked', false);
        $("#smsstudio_channel").attr('checked', false);
        $("#smsedge_channel").attr('checked', false);
        $(".textboxchannels").attr('checked', false);

        ($(this).attr('contact_list') != 'null') ? $("#editCmpContact").val($(this).attr('contact_list')): '';
        //$("#editCmpContact").val($(this).attr('contact_list'));
        ($(this).attr('offers') != 'null') ? $("#editCmpOffer").val($(this).attr('offers')): '';
        //$("#editCmpOffer").val($(this).attr('offers'));

        ($(this).attr('senders') != 'null') ? $("#editCmpSender").val($(this).attr('senders')): '';

        if (channel) {
            if (channel.indexOf('mmd') > -1) {
                $("#mmd_channel").attr("checked", true);
            }
            if (channel.indexOf('deliverhub') > -1) {
                $("#deliverhub_channel").attr("checked", true);
            }
            if (channel.indexOf('textlocal') > -1) {
                $("#textlocal_channel").attr("checked", true);
            }
            if (channel.indexOf('p1sms') > -1) {
                $("#p1sms_channel").attr("checked", true);
            }
            if (channel.indexOf('smsstudio') > -1) {
                $("#smsstudio_channel").attr("checked", true);
            }
            if (channel.indexOf('smsedge') > -1) {
                $("#smsedge_channel").attr("checked", true);
            }
            if (routes != '' && routes != null && routes != 'null') {
                $("#textbox_channel").attr('checked', true);
            }

        }

        if (ab_test == 'y') {
            $("body").find("#abTesting").attr("checked", true);
            $("body").find(".percent").show();
            $("body").find("#ab_percent").val(percent);
            $("#mmd_channel").attr('disabled', false);
            $("#deliverhub_channel").attr('disabled', false);
            $("#textlocal_channel").attr('disabled', false);
            $("#p1sms_channel").attr('disabled', false);
            $("#smsedge_channel").attr('disabled', false);
            $("#textbox_channel").attr('disabled', false);
            $("#smsstudio_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);

        } else {
            $("body").find("#abTesting").attr("checked", false);
            $("body").find(".percent").hide();
            $("body").find("#ab_percent").val('');
        }
        if ($("#mmd_channel").prop('checked') && ab_test != 'y') {
            $("#deliverhub_channel").attr('disabled', true);
            $("#textlocal_channel").attr('disabled', true);
            $("#p1sms_channel").attr('disabled', true);
            $("#smsedge_channel").attr('disabled', true);
            $("#smsstudio_channel").attr('disabled', true);
            $("#textbox_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
        } else if ($("#deliverhub_channel").prop('checked') && ab_test != 'y') {
            $("#mmd_channel").attr('disabled', true);
            $("#textlocal_channel").attr('disabled', true);
            $("#p1sms_channel").attr('disabled', true);
            $("#smsstudio_channel").attr('disabled', true);
            $("#textbox_channel").attr('disabled', true);
            $("#smsedge_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
        } else if ($("#textlocal_channel").prop('checked') && ab_test != 'y') {
            $("#mmd_channel").attr('disabled', true);
            $("#deliverhub_channel").attr('disabled', true);
            $("#p1sms_channel").attr('disabled', true);
            $("#smsstudio_channel").attr('disabled', true);
            $("#textbox_channel").attr('disabled', true);
            $("#smsedge_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
        } else if ($("#smsstudio_channel").prop('checked') && ab_test != 'y') {
            $("#mmd_channel").attr('disabled', true);
            $("#deliverhub_channel").attr('disabled', true);
            $("#textlocal_channel").attr('disabled', true);
            $("#p1sms_channel").attr('disabled', true);
            $("#textbox_channel").attr('disabled', true);
            $("#smsedge_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
        } else if ($("#p1sms_channel").prop('checked') && ab_test != 'y') {
            $("#mmd_channel").attr('disabled', true);
            $("#deliverhub_channel").attr('disabled', true);
            $("#textlocal_channel").attr('disabled', true);
            $("#smsstudio_channel").attr('disabled', true);
            $("#textbox_channel").attr('disabled', true);
            $("#smsedge_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
        }else if ($("#smsedge_channel").prop('checked') && ab_test != 'y') {
            $("#mmd_channel").attr('disabled', true);
            $("#deliverhub_channel").attr('disabled', true);
            $("#textlocal_channel").attr('disabled', true);
            $("#smsstudio_channel").attr('disabled', true);
            $("#textbox_channel").attr('disabled', true);
            $("#p1sms_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
        } else if ($("#textbox_channel").prop('checked') && ab_test != 'y') {
            $("#mmd_channel").attr('disabled', true);
            $("#deliverhub_channel").attr('disabled', true);
            $("#p1sms_channel").attr('disabled', true);
            $("#smsstudio_channel").attr('disabled', true);
            $("#textlocal_channel").attr('disabled', true);
            $("#smsedge_channel").attr('disabled', true);
            $(".textboxchannels").attr('disabled', true);
            $(".textboxRoutesEdit").show();
        } else {
            $("#mmd_channel").attr('disabled', false);
            $("#deliverhub_channel").attr('disabled', false);
            $("#textlocal_channel").attr('disabled', false);
            $("#p1sms_channel").attr('disabled', false);
            $("#smsstudio_channel").attr('disabled', false);
            $("#smsedge_channel").attr('disabled', false);
            $("#textbox_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $(".textboxRoutesEdit").html('');
            $(".textboxRoutesEdit").hide();
        }
        $("#CampaingEditFormModal").modal('show');
        $(".edit_template").attr("selected", false);
        $("#CampaingEditForm").attr("action", '/campaing/update/' + id);
        $("#deleteCampaign").attr("href", '/campaing/delete/' + id);


        // $("#editCmpSender").val($(this).attr('senders'));
        if (ab_test == 'y') {
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
        $.ajax({
            type: "POST",
            url: "/getContactList/all",
            dataType: "json",
            data: {
                categories: category,
                countries: country
            },
            success: function(data) {
                console.log('waiting for response ::::: 30 ');
                if (data.error) {
                    alert(data.error)
                } else {
                    console.log(data.contact)

                    let contactList = '<option value="">Select Contact List</option>';
                    let template = '';
                    let offer = '<option value="">Select Offer List</option>';
                    for (let i = 0; i < data.contact.length; i++) {
                        contactList += '<option value=' + data.contact[i].id + '>' + data.contact[i].name + ' (' + data.contact[i].totalContact + ')</option>'
                    }
                    for (let i = 0; i < data.template.length; i++) {
                        template += '<option value=' + data.template[i].id + ' class="edit_template edit_temp_id_' + data.template[i].id + '">' + data.template[i].name + ' (' + data.template[i].message + ')</option>';
                    }
                    for (let i = 0; i < data.offer.length; i++) {
                        let comment = (data.offer[i].comment) ? '(' + data.offer[i].comment + ')' : '';
                        let url = (data.offer[i].url) ? '(' + data.offer[i].url + ')' : '';
                        offer += '<option value=' + data.offer[i].id + ' >' + data.offer[i].company + ' ' + comment + ' ' + url + '</option>';
                    }
                    console.log(template)
                    $("#editTemplateLoop").html(template);
                    $("#editCmpContact").html(contactList);
                    $("#editCmpOffer").html(offer);
                    //alert(offers)
                    $("#editCmpOffer").val(offers);
                    //($(this).attr('offers') != 'null') ? $("#editCmpOffer").val($(this).attr('offers')): '';
                    //alert((offers != 'null') ? $("#editCmpOffer").val(offers): '');
                    $("#editCmpContact").val(contact)
                }
            }
        });
        $.ajax({
            type: "POST",
            url: "/getHits",
            dataType: "json",
            data: {
                "campaignId": id,
            },
            success: function(data) {
                var BroadcastHistory = $('#BroadcastHistory').DataTable({
                    "processing": true,
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "serverSide": true,
                    "destroy": true,
                    /*"order": [[2, 'desc']],*/
                    "ordering": false,
                    "autoWidth": false,
                    "pageLength": 30,
                    lengthMenu: [
                        [30, 50, 100,],
                        [30, 50, 100],
                    ],
                    //"dom": 'l<"toolbar">frtip',
                    /*"initComplete": function(){
                       $("div.toolbar")
                          .html('<a href="#" data-toggle="modal" data-target="#addTemplateModal" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> &nbsp;New Text Template</a>');           
                    }  ,*/

                    "ajax": {
                        url: host + "/getBroadcastHistory",
                        data: function(d) {
                            d.campaign = id;
                        }
                    },
                    "columns": [{
                            "data": "createdAt",
                            render: function(data, type, row) {
                                return moment((row.created_at) ? row.created : row.createdAt).format("DD/MM/YYYY HH:mm")+((row.send_type=='schedule')?'<img style="margin-left:5px" title="Schedule" src='+host+'/schedule.png>':'');
                            }
                        },
                        {
                            "data": "username",
                            render: function(data, type, row) {
                                return '<span">' + row.username + '</span>';
                            }
                        },
                        {
                            "data": "broadcast_id",
                            render: function(data, type, row) {
                                return '<span">' + row.broadcast_id + '</span>';
                            }
                        },
                        {
                            "data": "channel",
                            render: function(data, type, row) {
                                return '<span">' + row.channel + '</span>';
                            }
                        },
                        {
                            "data": "template",
                            render: function(data, type, row) {
                                return '<span">' + row.offer + '</span>';
                            }
                        },
                        {
                            "data": "delivered",
                            render: function(data, type, row) {
                                return '<span">' + row.delivered + '/' + row.sent + '</span>';
                            }
                        },
                        
                        {
                            "data": "hits",
                            render: function(data, type, row) {
                                let hits = (row.hits) ? row.hits : 0 + '(' + (row.unique_hits) ? row.unique_hits : 0 + ')';
                                return '<span">' + row.hits + '(' + row.unique_hits + ')</span>';
                            }
                        },
                        {
                            "data": "unique_hits",
                            render: function(data, type, row) {
                                let ctr = (isNaN(parseFloat((parseFloat(row.unique_hits) / parseFloat(row.delivered)) * 100))) ? 0 : parseFloat((parseFloat(row.unique_hits) / parseFloat(row.delivered)) * 100).toFixed(2);
                                let sent = (isNaN(parseFloat((parseFloat(row.unique_hits) / parseFloat(row.sent)) * 100))) ? 0 : parseFloat((parseFloat(row.unique_hits) / parseFloat(row.sent)) * 100).toFixed(2);
                                return '<span">' + ctr + '% (' + sent + '%)</span>';
                            }
                        },

                        {
                            "data": "cost",
                            render: function(data, type, row) {
                                return '<span">' + parseFloat(row.cost.toString().slice(0, (row.cost.toString().indexOf(".")) + 4)) + '</span>';
                            }
                        },
                        {
                            "data": "channel",
                            render: function(data, type, row) {
                                let cpc = isFinite(parseFloat(row.cost) / parseFloat(row.unique_hits)) && parseFloat(row.cost) / parseFloat(row.unique_hits) || 0;
                                return '<span">' + parseFloat(cpc).toFixed(2) + '</span>';
                            }
                        },
                        {
                            "data": "contact_name",
                            render: function(data, type, row) {
                                return '<span">' + row.contact_name + '</span>';
                            }
                        },
                        /*{ "data": "action" },*/


                        /*{ "data": "editDel", "className": "btn-group" }*/
                    ]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            }
        });

        //$('#BroadcastHistory').DataTable({data:{"dsd":"ds"}}).ajax.reload();
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "/getTemplates/all",
                /*dataType: "json",*/
                data: {
                    id: id,
                    countries: country,
                    categories: category
                },
                success: function(data) {
                    $("#CampaingEditFormModal").modal('show');
                    if (data.error) {
                        alert(data.error)
                    } else {
                        var templateData = JSON.parse(data);
                        var s2 = $("#editTemplateLoop").select2({
                            tags: true
                        });
                        var vals = [];
                        for (var i = 0; i < templateData.length; i++) {
                            //$("body").find(".edit_temp_id_"+templateData[i].id).attr("selected", true).trigger("change");
                            //s2.val(templateData[i].id).trigger("change");
                            vals.push(templateData[i].id)
                        }
                        s2.val(vals).trigger("change");
                        $("#editeCampaingName").val(name);
                        $("#categoryList").val(category);
                        $("#editCountry").val(country);
                        $("#editComment").val(comment);
                        if(templateData[0].hasOwnProperty('schedule_date')){
                            $("#editscheduleRegId").attr('checked',true);
                            $(".editscheduleRegId").attr('disabled',false);
                            //alert(templateData[0].schedule_date)
                            $(".editscheduleRegId").val(templateData[0].schedule_date);
                            $("#editsaveSend").hide();
                        }else{
                            $("#editsaveSend").show();
                        }
                        
                        if (routes != '' && routes != null) {
                            $("#textbox_channel").attr("checked", true);
                            var country_select = document.querySelector("#editCountry");
                            var country_code = country_select.options[country_select.selectedIndex].getAttribute('abv1');
                            let countries = country_code;
                            $.ajax({
                                type: "POST",
                                url: "/textBoxRoutes",
                                dataType: "json",
                                data: {
                                    "countries": country_code
                                },
                                success: function(data) {
                                    $(".preloader").css('height', 0);
                                    $(".animation__shake").fadeOut();
                                    if (data.error) {
                                        alert(data.error)
                                    } else {
                                        let routes_html = '';
                                        routes.split(',');
                                        for (let i = 0; i < data.length; i++) {
                                            let routes_selected = (routes.indexOf(data[i].id) > -1) ? 'checked' : '';
                                            routes_html += '<div class=col-sm-3><div class="form-group"><div class="custom-checkbox custom-control"><input class="form-check-input textboxchannels" name="channel" id="routes_' + data[i].id + '" type="checkbox" value=' + data[i].id + ' ' + routes_selected + '> <label class="form-check-label" for="routes_' + data[i].id + '">' + data[i].name + '</label></div></div></div>';
                                        }
                                        if (id != '') {
                                            $('body').find(".textboxRoutesEdit").html(routes_html);
                                            $("body").find(".textboxRoutes").html('');
                                            $("body").find(".textboxRoutesEdit").show();
                                        } else {
                                            $("body").find(".textboxRoutes").html(routes_html);
                                            $('body').find(".textboxRoutesEdit").html('');
                                            $("body").find(".textboxRoutes").show();
                                        }

                                        provider_check();
                                        //console.log("dataContactPercentage : ",data);

                                    }
                                }
                            });
                        }

                    }
                }
            });
        }, 1000);
    });

    function provider_check() {
        if ($("#abTesting").prop('checked')) {
            $("#mmd_channel").attr('disabled', false);
            $("#deliverhub_channel").attr('disabled', false);
            $("#textlocal_channel").attr('disabled', false);
            $("#textbox_channel").attr('disabled', false);
            $(".textboxchannels").attr('disabled', false);
            $("body").find("#contactSendDetailEdit").show();
        } else {
            $("body").find("#contactSendDetailEdit").hide();
            if ($("#mmd_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $(".textboxchannels").attr('disabled', true);

            } else if ($("#deliverhub_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $(".textboxchannels").attr('disabled', true);

            } else if ($("#textlocal_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#deliverhub_channel").attr('disabled', true);
                $("#textbox_channel").attr('disabled', true);
                $(".textboxchannels").prop('disabled', true);


            } else if ($("#textbox_channel").prop('checked')) {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
                $("#mmd_channel").attr('disabled', true);
                $("#deliverhub_channel").attr('disabled', true);
                $("#textlocal_channel").attr('disabled', true);

            } else {
                $("#mmd_channel").attr('disabled', false);
                $("#deliverhub_channel").attr('disabled', false);
                $("#textlocal_channel").attr('disabled', false);
                $("#textbox_channel").attr('disabled', false);
                $(".textboxchannels").attr('disabled', false);
            }
        }
    }
    $("body").on("click", "#refreshClick", function() {
        let id = $(this).attr('dataid');
        $.ajax({
            type: "POST",
            url: "/getHits",
            dataType: "json",
            data: {
                "campaignId": id,
            },
            success: function(data) {
                $('#BroadcastHistory').DataTable().ajax.reload();
            }
        });
    });
    $("body").on("click", ".refreshCampaign", function() {
        let id = $(this).attr('dataid');
        $.ajax({
            type: "POST",
            url: "/getHits",
            dataType: "json",
            data: {
                "campaignId": id,
            },
            success: function(data) {
                $('#Campaign').DataTable().ajax.reload();
            }
        });
    })

});