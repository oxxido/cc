cc.business = {
    add : {
        create : function()
        {
            tools.handlebars("#businessAddForm_HBT", "#businessAddForm_HBW", {});
            cc.dashboard.panel.only("#businessAdd");
            $("#businessAddForm").bind('submit', cc.business.add.store);
            cc.business.admin.init();
        },
        store : function()
        {
            cc.dashboard.panel.loading("#businessAddLoading","show");
            var form = $("#businessAddForm");
            var data = [];

            form.find("button[type='submit']").attr('disabled', true);

            var data = form.serialize();
            $.ajax({
                url : cc.baseUrl + 'business',
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
                    cc.business.add.clear();
                    cc.business.table();
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
                url : cc.baseUrl + 'business/' + id + '/edit',
                dataType : 'json'
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.handlebars("#businessEditForm_HBT", "#businessEditForm_HBW", data.business);
                    $("#business_type_id").val(data.business.business_type_id);
                    $("#organization_type_id").val(data.business.organization_type_id);
                    $("#country_code").val(data.business.city.state.country.code);
                    cc.location.country();
                    $("#businessEditForm").bind('submit', cc.business.edit.update);
                    cc.business.admin.init();
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
                url : cc.baseUrl + 'business/' + id,
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
                    cc.business.edit.clear();
                    cc.business.table();
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
                url : cc.baseUrl + 'business/' + id,
                dataType : 'json',
                type : "DELETE",
                processData : false,
                data : "_token=" + _token
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Business " + data.business + " deleted", 'success');
                    cc.business.table();
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
        $("#businessShow").collapse('show');
    },
    table : function(page)
    {
        cc.dashboard.panel.loading("#businessTableLoading","show");
        $("#businessesTable_HBW").html("");
        cc.dashboard.panel.only("#businessTable");
        $.ajax({
            url : cc.baseUrl + 'business',
            dataType : 'json',
            data : {
                page : page
            }
        })
        .done(function(data) {
            if (data.success)
            {
                tools.handlebars("#businessesTable_HBT", "#businessesTable_HBW", data);
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
            cc.business.admin.clear();
            $("#admin_tab_search .alert").hide();

            $.ajax({
                url : cc.baseUrl + 'dashboard/searchAdmin',
                dataType : 'json',
                data : {
                    keyword : keyword
                }
            })
            .done(function(data) {
                if(data.count == 0)
                {
                    cc.business.admin.noresult();
                }
                else if(data.count == 1)
                {
                    cc.business.admin.result(data.admin.id, data.admin.name, data.admin.email);
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
            cc.business.admin.clear();
            $("#admin_tab_search .alert").show();
        },
        clear : function()
        {
            $("#admin_user_id, #admin_search_name, #admin_search_email").val("");
        }
    },
    init: function()
    {
        cc.business.table();
    }
}
