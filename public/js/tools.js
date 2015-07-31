/* does main namespace exists? */

var tools = {
    formMessages: function(str, msgType) {
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

        $("#errorMessage").collapse("show");

        $("#errorMessage p").html(str);

    }

}
