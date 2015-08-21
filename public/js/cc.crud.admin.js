if (!cc) var cc = {};
if (!cc.crud) cc.crud = {};

cc.crud.admin = {
    add : {
        create : function()
        {
            tools.handlebars("#adminAddForm_HBT", "#adminAddForm_HBW", {});
            cc.dashboard.panel.only("#adminAdd");
            $("#adminAddForm").bind('submit', cc.crud.admin.add.store);
        },
        store : function()
        {
            cc.dashboard.panel.loading("#adminAddLoading","show");
            var form = $("#adminAddForm");
            var data = [];

            form.find("button[type='submit']").attr('disabled', true);

            var data = form.serialize();
            $.ajax({
                url : cc.baseUrl + 'crud/admin',
                dataType : 'json',
                type: "POST",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("User  " + data.admin.name + " added", 'success');
                    cc.dashboard.panel.hide();
                    cc.crud.admin.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#adminAddLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#adminTable');
            this.clear();
        },
        clear : function()
        {
            $("#adminAddForm_HBW").html("");
        }
    },
    edit : 
    {
        edit : function(id)
        {
            cc.dashboard.panel.only("#adminEdit");
            cc.dashboard.panel.loading("#adminEditLoading","show");

            $.ajax({
                url : cc.baseUrl + 'crud/admin/' + id + '/edit',
                dataType : 'json'
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.handlebars("#adminEditForm_HBT", "#adminEditForm_HBW", data.admin);
                    $("#adminEditForm").bind('submit', cc.crud.admin.edit.update);
                }
                else
                {
                    tools.messages(data.errors, "error");
                }
            })
            .fail(tools.fail)
            .always(function(){
                cc.dashboard.panel.loading("#adminEditLoading","hide");
            });
        },
        update : function(x)
        {
            cc.dashboard.panel.loading("#adminEditLoading","show");
            var form = $("#adminEditForm");
            var data = form.serialize();
            var id = $("#id").val();

            form.find("button[type='submit']").attr('disabled', true);

            $.ajax({
                url : cc.baseUrl + 'crud/admin/' + id,
                dataType : 'json',
                type: "PUT",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("User " + data.admin.name + " edited", 'success');
                    cc.dashboard.panel.hide();
                    cc.crud.admin.edit.clear();
                    cc.crud.admin.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#adminEditLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#adminTable');
            this.clear();
        },
        clear : function()
        {
            $("#adminEditForm_HBW").html("");
        }
    },
    destroy : function(id)
    {
        cc.dashboard.modal.confirm("Delete User", "Confirm delete User?", function(){
            cc.dashboard.panel.loading("#adminTableLoading","show");
            var _token = $("meta[name=_token]").attr("content");
            $.ajax({
                url : cc.baseUrl + 'crud/admin/' + id,
                dataType : 'json',
                type : "DELETE",
                processData : false,
                data : "_token=" + _token
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Business " + data.admin + " deleted", 'success');
                    cc.crud.admin.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function(){
                cc.dashboard.panel.loading("#adminTableLoading","hide");
            });
        });
    },
    show : function(id)
    {
        $("#userShow").collapse('show');
    },
    table : function(page)
    {
        cc.dashboard.panel.loading("#adminTableLoading","show");
        $("#adminTable_HBW").html("");
        cc.dashboard.panel.only("#adminTable");
        $.ajax({
            url : cc.baseUrl + 'crud/admin',
            dataType : 'json',
            data : {
                page : page
            }
        })
        .done(function(data) {
            if (data.success)
            {
                tools.handlebars("#adminTable_HBT", "#adminTable_HBW", data);
            }
            else
            {
                tools.messages(data.errors, "error");
            }
        })
        .fail(tools.fail)
        .always(function(){
            cc.dashboard.panel.loading("#adminTableLoading","hide");
        });
    },
    init: function()
    {
        cc.crud.admin.table();
    }
}