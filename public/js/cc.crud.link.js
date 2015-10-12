
if (!cc) var cc = {};
if (!cc.crud) cc.crud = {};

cc.crud.link = {
    business_uuid : false,
    init : function(business_uuid)
    {
        this.business_uuid = business_uuid;
        cc.crud.link.table();
    },
    table : function()
    {
        var page = arguments.length ? arguments[0] : 1;
        var perpage = 10;

        cc.dashboard.panel.loading("#linkTableLoading","show");
        $("#linkTable_HBW").html("");
        cc.dashboard.panel.only("#linkTable");
        $.ajax({
            url : cc.baseUrl + 'business/' + cc.crud.link.business_uuid + '/links',
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

                tools.paging("#paging", data.paging, function(page){
                    cc.crud.link.table(page);
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
    add :
    {
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
                url : cc.baseUrl + 'business/' + cc.crud.link.business_uuid + '/link',
                dataType : 'json',
                type: "POST",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Profile for <b>" + data.link.social_network.name + "</b> added", 'success');
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
        edit : function(uuid)
        {
            cc.dashboard.panel.only("#linkEdit");
            cc.dashboard.panel.loading("#linkEditLoading","show");

            $.ajax({
                url : cc.baseUrl + 'business/' + cc.crud.link.business_uuid + '/link/' + uuid + '/edit',
                dataType : 'json'
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.handlebars("#linkEditForm_HBT", "#linkEditForm_HBW");
                    $("#id").val(data.link.social_network_id);
                    $("#social_network_id").val(data.link.social_network.id);                    
                    $("#name").val(data.link.url);
                    $("#logo").prop('src',data.link.social_network.logo);
                    $("#social_result").html(data.link.profile);
                    //$("#active").val(active);
                    
                    $("#social_network_id").change(function(){
                        cc.crud.link.setLogo();
                    });
                    $('#name').on('input', function() {
                        cc.crud.link.setInput(this);
                    });
                    
                    $("#linkEditForm").bind('submit', function(){
                        cc.crud.link.edit.update(uuid);
                        return false;
                    });
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
        update : function(uuid)
        {
            cc.dashboard.panel.loading("#linkEditLoading","show");
            var form = $("#linkEditForm");
            var data = form.serialize();

            form.find("button[type='submit']").attr('disabled', true);

            $.ajax({
                url : cc.baseUrl + 'business/' + cc.crud.link.business_uuid + '/link/' + uuid,
                dataType : 'json',
                type: "PUT",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Profile for <b>" + data.link.social_network.name + "</b> edited", 'success');
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
    destroy : function(uuid)
    {
        cc.dashboard.modal.confirm("Delete Profile", "Confirm delete profile?", function(){
            cc.dashboard.panel.loading("#linkTableLoading","show");
            var _token = $("meta[name=_token]").attr("content");
            $.ajax({
                url : cc.baseUrl + 'business/' + cc.crud.link.business_uuid + '/link/' + uuid,
                dataType : 'json',
                type : "DELETE",
                processData : false,
                data : "_token=" + _token
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Profile for <b>" + data.name + "</b> was deleted", 'success');
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

    }
}
