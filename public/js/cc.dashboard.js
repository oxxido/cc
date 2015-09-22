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

    zip_code : function()
    {
        var city_zip_code = $("#city_zip_code");
        var zip_code = city_zip_code.val();
        var country_code = $("#country_code option:selected").val();

        city_zip_code.attr("disabled", true);
        cc.location.clear();
        $("#location_auto .alert").hide();

        $.ajax({
            url : cc.baseUrl + "location/zipcode",
            dataType : "json",
            data : {
                country_code : country_code,
                zip_code : zip_code
            }
        })
        .done(function(data) {
            if(data.count == 0)
            {
                cc.location.noresult();
            }
            else if(data.count == 1)
            {
                cc.location.result(data.city_id, data.location);
            }
            else
            {
                cc.dashboard.modal.handlebars("Select Location", "#modalLocations_HBT", {locations : data.rows});
            }
        })
        .fail(tools.fail)
        .always(function () {
            city_zip_code.attr("disabled", false);
        });
    },
    result : function(city_id, text)
    {
        $("#city_location").val(text);
        $("#city_id").val(city_id);
        $("#citiesModal").modal("hide");
    },
    noresult : function()
    {
        cc.location.clear();
        $("#location_auto .alert").show();
    },
    clear : function()
    {
        $("#city_location, #city_id").val("");
    }
};

cc.dashboard = {
    modal : {
        confirm : function(title, message, success)
        {
            this.show(title, message);
            $("#dashboard-modal .btn-primary").removeClass("hide");
            $("#dashboard-modal .btn-primary" ).off( "click");
            $("#dashboard-modal .btn-primary").html("Confirm").click(function(){
                success();
                cc.dashboard.modal.hide();
                $("#dashboard-modal .btn-primary").html("Save");
            });
        },
        handlebars : function(title, template, data)
        {
            var success = arguments[3] ? arguments[3] : function(){};
            this.show(title, "");
            tools.handlebars(template, "#dashboard-modal .modal-body", data);
            if(success)
            {
                $("#dashboard-modal .btn-primary").removeClass("hide");
                $("#dashboard-modal .btn-primary" ).off( "click");
                $("#dashboard-modal .btn-primary").click(function(){
                    success();
                    cc.dashboard.modal.hide();
                });
            }
        },
        show : function(title, content)
        {
            $("#dashboard-modal .btn-primary").addClass("hide");
            $("#dashboard-modal .modal-title").html(title);
            $("#dashboard-modal .modal-body").html(content);
            $("#dashboard-modal").modal("show");
        },
        hide : function()
        {
            $("#dashboard-modal").modal("hide");
        },
        size : function(size)
        {
            $("#dashboard-modal .modal-dialog").removeClass("modal-sm modal-lg").addClass(size);
        }
    },
    panel : {
        only : function(selector)
        {
            $("#content-dashboard .collapse:not("+selector+", alert.collapse)").collapse("hide");
            this.show(selector);
        },
        hide : function()
        {
            if(arguments.length)
                $(arguments[0]).collapse("hide");
            else
                $("#content-dashboard .collapse").collapse("hide");
        },
        show : function()
        {
            if(arguments.length)
                $(arguments[0]).collapse("show");
            else
                $("#content-dashboard .collapse").collapse("show");
        },
        loading : function(selector, method)
        {
            if(method == "show")
                $(selector).show();
            else
                $(selector).hide();
        },
    }
};

