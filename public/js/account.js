/* does main namespace exists? */
if (!cc) {
    var cc = {};
}

cc.user = {
    add : {
        create : function()
        {
            tools.handlebars("#userAddForm_HBT", "#userAddForm_HBW", {});
            cc.dashboard.panel.only("#userAdd");
            $("#userAddForm").bind('submit', cc.user.add.store);
            cc.user.admin.init();
        },
        store : function()
        {
            cc.dashboard.panel.loading("#userAddLoading","show");
            var form = $("#userAddForm");
            var data = [];

            form.find("button[type='submit']").attr('disabled', true);

            var data = form.serialize();
            $.ajax({
                url : cc.baseUrl + 'user',
                dataType : 'json',
                type: "POST",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("user " + data.user.name + " Added", 'success');
                    cc.dashboard.panel.hide();
                    cc.user.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#userAddLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#userTable');
            this.clear();
        },
        clear : function()
        {
            $("#userAddForm_HBW").html("");
        }
    },
    show : function(id)
    {
        $("#userShow").collapse('show');
    },
    table : function(page)
    {
        cc.dashboard.panel.loading("#userTableLoading","show");
        $("#usersTable_HBW").html("");
        cc.dashboard.panel.only("#userTable");
        $.ajax({
            url : cc.baseUrl + 'user',
            dataType : 'json',
            data : {
                page : page
            }
        })
        .done(function(data) {
            if (data.success)
            {
                tools.handlebars("#usersTable_HBT", "#usersTable_HBW", data);
            }
            else
            {
                tools.messages(data.errors, "error");
            }
        })
        .fail(tools.fail)
        .always(function(){
            cc.dashboard.panel.loading("#userTableLoading","hide");
        });
    },
    init: function()
    {
        cc.user.table();
    }
}