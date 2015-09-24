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
                    tools.messagesHide();
                    cc.dashboard.panel.hide("#businessCvsLog");
                    $('#csv-progress').show();
                    return true;
                },
                done: function (e, data) {
                    cc.crud.business.cvs.log(data.result);
                    $('#csv-progress').hide();
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#csv-progress .progress-bar').css('width', progress + '%');
                }
            }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
        },
        log : function(data)
        {
            if(data.errors)
            {
                tools.messages(data.errors, "error");
            }
            else
            {
                cc.crud.business.table();
                tools.handlebars("#businessCvsLog_HBT", "#businessCvsLog_HBW", data);
                cc.dashboard.panel.show("#businessCvsLog");
            }
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
                    $("#business_type_id").val(data.business.business_type.id);
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
                        $("#city_zip_code, #city_location, #zip_code").val("");
                    }
                    if(data.business.owner.id == data.business.admin.user.id)
                    {
                        $("#new_admin").val(2);
                        $('#myTabs a[href="#admin_tab_not"]').tab('show');
                    }
                    else
                    {
                        $("#new_admin").val(0);
                        $('.admin-nav-tabs a[href="#admin_tab_search"]').tab('show');
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
        cc.dashboard.modal.confirm("Delete Business", "Confirm delete busines?", function(){
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
    show : function(id)
    {
        location.href = cc.baseUrl + 'dashbiz/load/' + id;
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
                })
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
        },
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
