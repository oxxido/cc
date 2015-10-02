/* does main namespace exists? */

var tools = {
    handlebars : function(template, wrapper, data)
    {
        var hb_template = $(template).html();
        var hb_compile = Handlebars.compile(hb_template);
        var hb_html = hb_compile(data);
        $(wrapper).html(hb_html);
    },
    fail : function(x, status, error) {
        tools.messages("There was an error in our system:, please try again (Error " + x.status + ": " + error +")");   
    },
    messagesHide: function() {
        $("#errorMessage").removeClass("in");
    },
    messages: function(str, msgType) {
        //check msgType
        var cssClass = "alert-info";
        var errorIcon = "fa-info";
        var errorText = "Info"
        switch(msgType) {
            case "error":
                cssClass = "alert-error";
                errorIcon = "fa-ban";
                errorText = "Error!"
            break;
            case "warning":
                cssClass = "alert-warning";
                errorIcon = "fa-exclamation-circle";
                errorText = "Warning!"
            break;
            case "success":
                cssClass = "alert-success";
                errorIcon = "fa-check-circle";
                errorText = "Success!"
            break;
        }
        $("#errorMessage").removeClass("alert-error alert-warning alert-info alert-success");
        $("#errorMessage").addClass(cssClass);
        //cssClass = cssClass || "alert-danger";
        //set the icon
        $("#errorIcon").removeClass("fa-info fa-ban fa-exclamation-circle fa-check-circle");
        $("#errorIcon").addClass(errorIcon);
        //set the title
        $("#errorTitle").html(errorText);

        $("#errorMessage").addClass("in");

        if(typeof str === 'string')
        {
            $("#errorMessage div").html(str);
        }
        else
        {
            $("#errorMessage div").html("<ul>");
            $.each(str, function(i, row){
                $("#errorMessage div").append('<li>'+ row +'</a>');
            });
            $("#errorMessage div").append("</ul>");
        }
        $(window).scrollTo("#errorMessage",{offset : -60});
    },
    paging : function(selector, data, callback)
    {
        if(data.pages > 1)
        {
            $(selector).easyPaging({
                total: data.total,
                perpage : data.perpage,
                page : data.page,
                onSelect: function(page)
                {
                    if(data.page != page)
                        callback(page);
                }
            });
        }
        else
        {
            $(selector).hide();
        }
    }
}
