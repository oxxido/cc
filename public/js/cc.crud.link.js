
if (!cc) var cc = {};
if (!cc.crud) cc.crud = {};

cc.crud.link = {
    add : {
        create : function()
        {
            tools.handlebars("#linkAddForm_HBT", "#linkAddForm_HBW", {});
            cc.dashboard.panel.only("#linkAdd");
            $("#linkAddForm").bind('submit', cc.crud.link.add.store);

            $("#social_network_id").change(function(){
                cc.crud.link.setLogo();
            });
            $('#name').on('input', function() {
                cc.crud.link.setInput(this);
            });
            cc.crud.link.admin.init();
            cc.crud.link.setLogo();
            
        },
        store : function()
        {
            cc.dashboard.panel.loading("#linkAddLoading","show");
            var form = $("#linkAddForm");
            var data = [];

            form.find("button[type='submit']").attr('disabled', true);

            var data = form.serialize();
            $.ajax({
                url : cc.baseUrl + 'crud/link',
                dataType : 'json',
                type: "POST",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Profile (aqui el profile o url al profile) added", 'success');
                    cc.dashboard.panel.hide();
                    cc.crud.link.add.clear();
                    cc.crud.link.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#linkAddLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#linkTable');
            this.clear();
        },
        clear : function()
        {
            $("#linkAddForm_HBW").html("");
        }
    },
    edit : 
    {
        edit : function(id)
        {
            cc.dashboard.panel.only("#linkEdit");
            cc.dashboard.panel.loading("#linkEditLoading","show");

            $.ajax({
                url : cc.baseUrl + 'crud/link/' + id + '/edit',
                dataType : 'json'
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.handlebars("#linkEditForm_HBT", "#linkEditForm_HBW", data.business);
                    $("#id").val(data.link.pivot.social_network_id);
                    $("#social_network_id").val(data.link.id);                    
                    $("#name").val(data.link.pivot.url);
                    $("#logo").prop('src',data.link.logo);
                    $("#social_result").html("http://"+data.link.url.replace("%",data.link.pivot.url));
                    //$("#active").val(active);
                    
                    $("#social_network_id").change(function(){
                        cc.crud.link.setLogo();
                    });
                    $('#name').on('input', function() {
                        cc.crud.link.setInput(this);
                    });
                    
                    $("#linkEditForm").bind('submit', cc.crud.link.edit.update);
                    cc.crud.link.admin.init();
                }
                else
                {
                    tools.messages(data.errors, "error");
                }
            })
            .fail(tools.fail)
            .always(function(){
                cc.dashboard.panel.loading("#linkEditLoading","hide");
            });
        },
        update : function(x)
        {
            cc.dashboard.panel.loading("#linkEditLoading","show");
            var form = $("#linkEditForm");
            var data = form.serialize();
            var id = $("#id").val();

            form.find("button[type='submit']").attr('disabled', true);

            $.ajax({
                url : cc.baseUrl + 'crud/link/' + id,
                dataType : 'json',
                type: "PUT",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Profile (aqui el profile o url al profile) edited", 'success');
                    cc.dashboard.panel.hide();
                    cc.crud.link.edit.clear();
                    cc.crud.link.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#linkEditLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#linkTable');
            this.clear();
        },
        clear : function()
        {
            $("#linkEditForm_HBW").html("");
        }
    },
    destroy : function(id)
    {
        cc.dashboard.modal.confirm("Delete Profile", "Confirm delete profile?", function(){
            cc.dashboard.panel.loading("#linkTableLoading","show");
            var _token = $("meta[name=_token]").attr("content");
            $.ajax({
                url : cc.baseUrl + 'crud/link/' + id,
                dataType : 'json',
                type : "DELETE",
                processData : false,
                data : "_token=" + _token
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Profile " + data.links + " deleted", 'success');
                    cc.crud.link.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function(){
                cc.dashboard.panel.loading("#linkTableLoading","hide");
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

        cc.dashboard.panel.loading("#linkTableLoading","show");
        $("#linkTable_HBW").html("");
        cc.dashboard.panel.only("#linkTable");
        $.ajax({
            url : cc.baseUrl + 'crud/link',
            dataType : 'json',
            data : {
                page : page,
                perpage : perpage
            }
        })
        .done(function(data) {
            if (data.success)
            {
                tools.handlebars("#linkTable_HBT", "#linkTable_HBW", data);
                $("#paging").easyPaging({
                    total: data.paging.total,
                    perpage : perpage,
                    page : data.paging.page,
                    onSelect: function(page)
                    {
                        if(data.paging.page != page)
                            cc.crud.link.table(page);
                    }
                });
            }
            else
            {
                tools.messages(data.errors, "error");
            }
        })
        .fail(tools.fail)
        .always(function(){
            cc.dashboard.panel.loading("#linkTableLoading","hide");
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
            cc.crud.link.admin.clear();
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
                    cc.crud.link.admin.noresult();
                }
                else if(data.count == 1)
                {
                    cc.crud.link.admin.result(data.admin.id, data.admin.name, data.admin.email);
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
            cc.crud.link.admin.clear();
            $("#admin_tab_search .alert").show();
        },
        clear : function()
        {
            $("#admin_user_id, #admin_search_name, #admin_search_email").val("");
        }
    },
    setLogo: function()
    {
        var found = $.map(socialNetworks, function(obj) {
            if(obj.id == $("#social_network_id").val())
                 return obj; // or return obj.name, whatever.
        });
        if(typeof found[0] !='undefined') {
            $("#logo").prop('src',found[0].logo);
            this.setInput(document.getElementById("name"));
            $("#logo").show();
        } else {
            $("#logo").hide();
        }

    },
    setInput: function(diz)
    {
        var found = $.map(socialNetworks, function(obj) {
            if(obj.id == $("#social_network_id").val())
                 return obj; // or return obj.name, whatever.
        });
        $("#social_result").html("http://"+found[0].url.replace("%",$(diz).val()));

    },
    init: function()
    {
        cc.crud.link.table();
        
    }
}
