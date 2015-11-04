if (!cc) var cc = {};
if (!cc.crud) cc.crud = {};

cc.crud.business = {
    cvs: {
        upload : function()
        {
            'use strict';

            $('#csv-upload').fileupload({
                url:  cc.baseUrl + 'crud/business/csv',
                dataType: 'json',
                type : 'POST',
                formData : {
                    _token : cc._token
                },
                submit : function(e, data) {
                    cc.pusher.connect();
                    cc.pusher.subscribe('user.' + cc.id, 'App\\Events\\EventCsvImporterLog', function(notification){
                        cc.crud.business.cvs.notification(notification.log, notification.type, notification.datetime, notification.line);
                    });

                    tools.messagesHide();
                    $("#businessCvsNotifications table").html("");
                    $("#businessCvsNotifications").show();
                    cc.crud.business.cvs.notification("Uploading file", "info");
                    $('#csv-progress').show();
                    return true;
                },
                done: function (e, data) {
                    cc.pusher.disconnect();
                    if(data.result.errors)
                    {
                        if(typeof data.result.errors == "string")
                        {
                            cc.crud.business.cvs.notification(data.result.errors, "danger", false);
                        }
                        else
                        {
                            for(var i in data.result.errors)
                            {
                                cc.crud.business.cvs.notification(data.result.errors[i], "danger", false);
                            }
                        }
                    }
                    else
                    {
                        cc.crud.business.table();

                        if(!cc.pusher.logged)
                        {
                            for(var i in data.result.results)
                            {
                                if(data.result.results[i].errors)
                                    cc.crud.business.cvs.notification(data.result.results[i].errors, "danger", false);
                            }
                        }
                    }
                    $('#csv-progress').hide();
                    cc.crud.business.cvs.notification("File uploaded", "info");
                },
                fail : function (e, data){
                    tools.fail(data.jqXHR, data.errorThrown, data.textStatus);
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#csv-progress .progress-bar').css('width', progress + '%');
                }
            }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
        },
        notification : function(log, type, datetime)
        {
            var line = arguments[3] ? arguments[3] : false;
            if(typeof log == "string")
            {
                var html = log;
            }
            else
            {
                var html = "<b>" + log[0] + "</b>";
                html += "<ul>";
                for (var i in log)
                {
                    if(i == 0)
                        continue;

                    if(typeof log[i] == "array")
                    {
                        for(var j in log[i])
                        {
                            html += "<li>" + i + ":</b> " + log[i][j] + "</li>";
                        }
                    }
                    else
                    {
                        html += "<li>" + i + ":</b> " + log[i] + "</li>";
                    }
                }
                html += "</ul>";
            }
            var d = new Date();
            var dhtml = datetime ? datetime : moment().format('HH:mm:ss');
            if(line)
            {
                var tr = '<tr class="' + type + '"><td width="70">' + dhtml + '</td><td width="50">Line ' + line + '</td><td>' + html + '</td></tr>';
            }
            else
            {
                var tr = '<tr class="' + type + '"><td width="70">' + dhtml + '</td><td colspan="2">' + html + '</td></tr>';
            }
            $("#businessCvsNotifications table").prepend(tr);
        }
    },
    add : {
        create : function()
        {
            tools.handlebars("#businessAddForm_HBT", "#businessAddForm_HBW", {});
            cc.dashboard.panel.only("#businessAdd");
            $("#businessAddForm").bind('submit', cc.crud.business.add.store);
            cc.crud.business.admin.init();
        },
        store : function()
        {
            cc.dashboard.panel.loading("#businessAddLoading","show");
            var form = $("#businessAddForm");
            var data = [];

            form.find("button[type='submit']").attr('disabled', true);

            var data = form.serialize();
            $.ajax({
                url : cc.baseUrl + 'crud/business',
                dataType : 'json',
                type: "POST",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Business " + data.business.name + " added", 'success');
                    cc.dashboard.panel.hide();
                    cc.crud.business.add.clear();
                    cc.crud.business.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#businessAddLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#businessTable');
            this.clear();
        },
        clear : function()
        {
            $("#businessAddForm_HBW").html("");
        }
    },
    edit :
    {
        edit : function(id)
        {
            cc.dashboard.panel.only("#businessEdit");
            cc.dashboard.panel.loading("#businessEditLoading","show");

            $.ajax({
                url : cc.baseUrl + 'crud/business/' + id + '/edit',
                dataType : 'json'
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.handlebars("#businessEditForm_HBT", "#businessEditForm_HBW", data.business);
                    if(data.business.business_type)
                        $("#business_type_id").val(data.business.business_type.id);
                    if(data.business.organization_type)
                        $("#organization_type_id").val(data.business.organization_type.id);

                    var country_code = data.business.city.state.country.code;
                    $("#country_code").val(country_code);
                    cc.location.country();
                    if(country_code == "US")
                    {
                        $("#city_name, #state_name, #zip_code").val("");
                    }
                    else
                    {
                        $("#city_zip_code, #city_location").val("");
                    }
                    if(data.business.owner.id == data.business.admin.user.id)
                    {
                        $("#new_admin").val(2);
                        $('.admin-nav-tabs').hide();
                        $('.btn-admin-nt').show();
                    }
                    else
                    {
                        $('.admin-nav-tabs').show();
                        $('.btn-admin-nt').hide();
                        $('#admin_tabs a:first').tab('show');
                        $("#new_admin").val(0);
                        $("#admin_search").val(data.business.admin.id);
                    }
                    $("#businessEditForm").bind('submit', cc.crud.business.edit.update);
                    cc.crud.business.admin.init();
                }
                else
                {
                    tools.messages(data.errors, "error");
                }
            })
            .fail(tools.fail)
            .always(function(){
                cc.dashboard.panel.loading("#businessEditLoading","hide");
            });
        },
        update : function(x)
        {
            cc.dashboard.panel.loading("#businessEditLoading","show");
            var form = $("#businessEditForm");
            var data = form.serialize();
            var id = $("#id").val();

            form.find("button[type='submit']").attr('disabled', true);

            $.ajax({
                url : cc.baseUrl + 'crud/business/' + id,
                dataType : 'json',
                type: "PUT",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Business " + data.business.name + " edited", 'success');
                    cc.dashboard.panel.hide();
                    cc.crud.business.edit.clear();
                    cc.crud.business.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#businessEditLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#businessTable');
            this.clear();
        },
        clear : function()
        {
            $("#businessEditForm_HBW").html("");
        }
    },
    destroy : function(id)
    {
        cc.dashboard.modal.confirm("Delete Business", "Confirm delete this bussines?", function(){
            cc.dashboard.panel.loading("#businessTableLoading","show");
            var _token = $("meta[name=_token]").attr("content");
            $.ajax({
                url : cc.baseUrl + 'crud/business/' + id,
                dataType : 'json',
                type : "DELETE",
                processData : false,
                data : "_token=" + _token
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Business " + data.business + " deleted", 'success');
                    cc.crud.business.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function(){
                cc.dashboard.panel.loading("#businessTableLoading","hide");
            });
        });
    },
    table : function()
    {
        var page = arguments.length ? arguments[0] : 1;
        var perpage = 10;

        cc.dashboard.panel.loading("#businessTableLoading","show");
        $("#businessesTable_HBW").html("");
        cc.dashboard.panel.only("#businessTable");
        $.ajax({
            url : cc.baseUrl + 'crud/business',
            dataType : 'json',
            data : {
                page : page,
                perpage : perpage
            }
        })
        .done(function(data) {
            if (data.success)
            {
                tools.handlebars("#businessesTable_HBT", "#businessesTable_HBW", data);
                tools.paging("#paging", data.paging, function(page){
                    cc.crud.business.table(page);
                });
            }
            else
            {
                tools.messages(data.errors, "error");
            }
        })
        .fail(tools.fail)
        .always(function(){
            cc.dashboard.panel.loading("#businessTableLoading","hide");
        });
    },
    admin : {
        init : function(){
            $('.admin-nav-tabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $("#new_admin").val($(e.target).attr('isnew'));
            })
        },
        search : function() {
            var search = $("#admin_search");
            var keyword = search.val();
            //alert('change to: '+keyword);
            $('.ats-biz-data').hide();
            $('#ats-biz-data-'+keyword).show();
        },
        /*search : function() {
            var search = $("#admin_search");
            var keyword = search.val();

            search.attr('disabled', true);
            cc.crud.business.admin.clear();
            $("#admin_tab_search .alert").hide();

            $.ajax({
                url : cc.baseUrl + 'dashowner/searchadmin',
                dataType : 'json',
                data : {
                    keyword : keyword
                }
            })
            .done(function(data) {
                if(data.count == 0)
                {
                    cc.crud.business.admin.noresult();
                }
                else if(data.count == 1)
                {
                    cc.crud.business.admin.result(data.admin.id, data.admin.name, data.admin.email);
                }
                else
                {
                    cc.dashboard.modal.handlebars("Select Business Admin", "#modalAdmins_HBT", {admins : data.admins});
                }
            })
            .always(function () {
                search.attr('disabled', false);
            });
        },*/
        result : function(user_id, name, email)
        {
            $("#admin_id").val(user_id);
            $("#admin_search_name").val(name);
            $("#admin_search_email").val(email);
            $('#boSearchModal').modal("hide");
        },
        noresult : function()
        {
            cc.crud.business.admin.clear();
            $("#admin_tab_search .alert").show();
        },
        clear : function()
        {
            $("#admin_user_id, #admin_search_name, #admin_search_email").val("");
        }
    },
    init: function()
    {
        cc.crud.business.table();
        cc.crud.business.cvs.upload();
    }
}
