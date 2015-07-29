/* does main namespace exists? */
if (!cc) {
    var cc = {};
}

/*set variables and "constants"*/
cc.ver = "0.0.1";
cc.baseUrl = "http://ivy.local:8000/";
/* start fuctions and methods */
cc.business = {
    that: false,
    send: function(step, data) {
        var $form = $(this);

        //first, disable button to avoid double click
        $form.find("button[type='submit']").attr('disabled', true);
        console.log("entrando a js");
        // Get every form element value in an object
        var form_data = {};
        $.each($form.serializeArray(), function(i, field) {
            form_data[field.name] = field.value;
        });
        $.ajax({
            url : cc.baseUrl + 'business',
            dataType : 'json',
            type: "POST",
            data : form_data
        })
        .done(function(data) {
            if (data.success) {
                } else {
                    formMessages(data.errors);
                    //console.log("error!")
                }
        })
        .fail(function(x, status, error) {
            formMessages("There was an error in our system:, please try again (Error " + x.status + ": " + error +")");
            console.log(x);
        })
        .always(function () {
            $form.find("button[type='submit']").attr('disabled', false);
        });
        return false;
    },
    init: function() {
        that = this;
        $("#userAddForm").bind('submit', this.send);
    }
}
