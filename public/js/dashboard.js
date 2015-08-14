/* does main namespace exists? */
if (!cc) {
    var cc = {};
}

cc.location = {
    init : function()
    {

    },

    country : function()
    {
        var country_code = $("#country_code option:selected").val();
        if(country_code == "US")
        {
            $("#location_auto").show();
            $("#location_manual").hide();
            $("#new_city").val("0");
        }
        else
        {
            $("#location_auto").hide();
            $("#location_manual").show();
            $("#new_city").val("1");
        }
    },

    zipcode : function()
    {
        var city_zipcode = $("#city_zipcode");
        var zipcode = city_zipcode.val();
        var country_code = $("#country_code option:selected").val();

        city_zipcode.attr('disabled', true);
        cc.location.city("","");

        $.ajax({
            url : cc.baseUrl + 'location/zipcode',
            dataType : 'json',
            data : {
                country_code : country_code,
                zipcode : zipcode
            }
        })
        .done(function(data) {
            if(data.count == 0)
            {
                $("#city_text").val("Zip Code not matching or not found");
            }
            else if(data.count == 1)
            {
                cc.location.city(data.city_id, data.text);
            }
            else
            {
                $("#cities").html("");
                $.each(data.rows, function(i, row){
                    $("#cities").append('<a href="javascript:cc.location.city(\''+ row.city_id +'\',\''+ row.text +'\')" class="list-group-item">'+ row.text +'</a>');
                });
                $('#citiesModal').modal("show");
            }
        })
        .always(function () {
            city_zipcode.attr('disabled', false);
        });
    },
    city : function(city_id, text)
    {
        $("#city_text").val(text);
        $("#city_id").val(city_id);
        $('#citiesModal').modal("hide");
    }
};

cc.business = {
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
            cc.business.admin.clear();
            $("#admin_tab_search .alert").hide();

            $.ajax({
                url : cc.baseUrl + 'business/search',
                dataType : 'json',
                data : {
                    keyword : keyword
                }
            })
            .done(function(data) {
                if(data.count == 0)
                {
                    cc.business.admin.noresult();
                }
                else if(data.count == 1)
                {
                    cc.business.admin.result(data.admin.id, data.admin.name, data.admin.email);
                }
                else
                {
                    $("#boSearchModal .result").html("");
                    $.each(data.admins, function(i, admin){
                        $("#boSearchModal .result").append('<a href="javascript:cc.business.admin.result(\''+ admin.id +'\',\''+ admin.name +'\',\''+ admin.email +'\')" class="list-group-item">'+ admin.name +' - '+ admin.email +'</a>');
                    });
                    $('#boSearchModal').modal("show");
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
            cc.business.admin.clear();
            $("#admin_tab_search .alert").show();
        },
        clear : function()
        {
            $("#admin_user_id, #admin_search_name, #admin_search_email").val("");
        }
    },
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
            if (data.success)
            {
                tools.formMessages("Business " + data.business.name + " Added", 'success');
                $('#businessAdd').collapse('hide');
                $form.trigger("reset");
                cc.location.country();
                $('#admin_tab_new').tab('show');
                cc.that.get();
            }
            else
            {
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
        // Get every form element value in an object
        $.ajax({
            url : cc.baseUrl + 'business',
            dataType : 'json',
            type: "GET"
        })
        .done(function(data) {
            if (data.success)
            {
                    //$("#businessesTableDiv").text(data.businesses);
                    //ready to start templating
                    var businessesTmpl = $("#businessesTemplate").html();
                    // Compile the template
                    var businessesHB = Handlebars.compile(businessesTmpl);
                    // Pass our data to the template
                    var businessesHtml = businessesHB(data);
                    //render
                    $("#businessesTableDiv").html(businessesHtml);
            }
            else
            {
                tools.formMessages(data.errors, "error");
            }
        })
        .fail(function(x, status, error) {
            tools.formMessages("There was an error in our system:, please try again (Error " + x.status + ": " + error +")");
        })
        .always(function () {
            //$form.find("button[type='submit']").attr('disabled', false);
        });
        
    },
    init: function() {
        cc.that = this;
        $("#businessAddForm").bind('submit', this.send);
        this.get();
        cc.business.admin.init();
    }
}
