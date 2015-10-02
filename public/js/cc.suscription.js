
if (!cc) var cc = {};


cc.suscription = {
    list : function()
    {
        var page = arguments.length ? arguments[0] : 1;
        var perpage = 10;

        cc.dashboard.panel.hide("#linkTableLoading","show");
        $("#businesses").change(function(){
                //function to load the mails suscribe for that biz
                //cc.suscription.setBusinessSuscription(this);
        });

        .done(function(data) {
            if (data.success)
            {
                cc.dashboard.panel.loading("#linkTableLoading","hide");
            }
            else
            {
                tools.messages(data.errors, "error");
            }
        })
        .fail(tools.fail)
        .always(function(){
            cc.dashboard.panel.loading("#linkTableLoading","hide");
            cc.dashboard.panel.loading("#biz_suscriptions","hide");
        });
    },
    setBusinessSuscription: function(diz)
    {
        var found = $.map(socialNetworks, function(obj) {
            if(obj.id == $("#businesses").val())
                 return obj; // or return obj.name, whatever.
        });

    },
    init: function()
    {
        cc.suscription.list();        
    }
}
