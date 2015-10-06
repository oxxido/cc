
if (!cc) var cc = {};

cc.suscription = {
    list : function()
    {
        cc.dashboard.panel.loading("#linkTableLoading","show");  

        $("#businesses").change(function(){
                //function to load the mails suscribe for that biz
                if ($("#businesses").val() != 0) {
                    cc.suscription.setBusinessSuscription($("#businesses").val());
                };
        });
        cc.dashboard.panel.loading("#linkTableLoading","hide");
    },
    setBusinessSuscription: function(diz)
    {
        //find the business_commenter and check the suscribe business mails if necesary
        var found = $.map(bizCommenters, function(obj) {
            if(obj.business_id == $("#businesses").val())
                 return obj; // or return obj.name, whatever.
        });
        
        $("#suscribe_biz").prop('checked', found[0].mail_suscribe == 1 ? true : false);

        //find the business mail types and check anyone mail type if necesary
        var foundMail = $.map(mailBizSuscribes, function(obj) {
            if(obj.business_id == $("#businesses").val())
                 return obj; // or return obj.name, whatever.
        });

        for (var i = 0; i < foundMail.length; i++) {
            check = foundMail[i].suscribe == 1 ? true : false;

            $("#mail"+foundMail[i].mail_type).prop('checked', check);
        }

    },
    init: function()
    {
        cc.suscription.list();        
    }
}
