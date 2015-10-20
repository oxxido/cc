
if (!cc) var cc = {};

cc.suscription = {
    list : function()
    {
        $("#unsuscribe_all").change(function(){
            if($("#unsuscribe_all").prop('checked'))
            {
                $("#businesses, #unsuscribe_biz, #mail1, #mail2").attr("disabled", "disabled").removeAttr("checked");
            }
            else
            {
                $("#businesses").removeAttr("disabled");
                if ($("#businesses").val() != 0) {
                    $("#unsuscribe_biz, #mail1, #mail2").removeAttr("disabled");
                    cc.suscription.setBusinessSuscription();
                }
                else
                {
                    $("#unsuscribe_biz, #mail1, #mail2").attr("disabled", "disabled").removeAttr("checked")
                }
            }
        });

        $("#unsuscribe_biz").change(function(){
            if($("#unsuscribe_biz").prop('checked'))
            {
                $("#mail1, #mail2").attr("disabled", "disabled");
            }
            else
            {
                $("#mail1, #mail2").removeAttr("disabled");
            }
        });

        $("#businesses").change(function(){
            //function to load the mails suscribe for that biz
            if ($("#businesses").val() != 0) {
                $("#unsuscribe_biz, #mail1, #mail2").removeAttr("disabled");
                cc.suscription.setBusinessSuscription();
            }
            else
            {
                $("#unsuscribe_biz, #mail1, #mail2").attr("disabled", "disabled").removeAttr("checked")
            }
        });
    },
    setBusinessSuscription: function()
    {
        //find the business_commenter and check the suscribe business mails if necesary
        var found = $.map(bizCommenters, function(obj) {
            if(obj.business_id == $("#businesses").val())
                 return obj; // or return obj.name, whatever.
        });

        $("#unsuscribe_biz").prop('checked', found[0].mail_unsuscribe == 1 ? true : false);

        //find the business mail types and check anyone mail type if necesary
        var foundMail = $.map(mailBizSuscribes, function(obj) {
            if(obj.business_id == $("#businesses").val())
                 return obj; // or return obj.name, whatever.
        });

        for (var i = 0; i < foundMail.length; i++) {
            check = foundMail[i].unsuscribe == 1 ? true : false;

            $("#mail"+foundMail[i].mail_type).prop('checked', check);
        }

    },
    init: function()
    {
        cc.suscription.list();
    }
}
