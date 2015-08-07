/* does main namespace exists? */
if (!cc) {
    var cc = {};
}

/* start fuctions and methods */
cc.business = {
    that: false,
    send: function(step, data) {
        var $form = $(this);

        //first, disable button to avoid double click
        $form.find("button[type='submit']").attr('disabled', true);
        //console.log("entrando a js");
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
                    tools.formMessages("Business id:"+data.business.id+" Added", 'success');
                    $("#userAdd").collapse("hide");
                    $form.trigger("reset");
                    cc.that.get();
                } else {
                    tools.formMessages(data.errors, 'error');
                    //console.log("error!")
                }
        })
        .fail(function(x, status, error) {
            tools.formMessages("There was an error in our system:, please try again (Error " + x.status + ": " + error +")", 'error');
            console.log(x);
        })
        .always(function () {
            $form.find("button[type='submit']").attr('disabled', false);
        });
        return false;
    },
    get: function(page) {

        console.log("entrando a get");
        // Get every form element value in an object
        $.ajax({
            url : cc.baseUrl + 'business',
            dataType : 'json',
            type: "GET"
        })
        .done(function(data) {
            if (data.success) {
                    //$("#businessesTableDiv").text(data.businesses);
                    //ready to start templating
                    var businessesTmpl = $("#businessesTemplate").html();
                    // Compile the template
                    var businessesHB = Handlebars.compile(businessesTmpl);
                    // Pass our data to the template
                    var businessesHtml = businessesHB(data);
                    //render
                    $("#businessesTableDiv").html(businessesHtml);
                } else {
                    tools.formMessages(data.errors);
                }
        })
        .fail(function(x, status, error) {
            tools.formMessages("There was an error in our system:, please try again (Error " + x.status + ": " + error +")");
            console.log(x);
        })
        .always(function () {
            //$form.find("button[type='submit']").attr('disabled', false);
        });
        
    },
    init: function() {
        cc.that = this;
        $("#userAddForm").bind('submit', this.send);
        this.get();
    }
}
