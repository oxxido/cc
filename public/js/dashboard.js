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
                $("#city_location").val("Zip Code not matching or not found");
            }
            else if(data.count == 1)
            {
                cc.location.city(data.city_id, data.location);
            }
            else
            {
                $("#cities").html("");
                $.each(data.rows, function(i, row){
                    $("#cities").append('<a href="javascript:cc.location.city(\''+ row.city_id +'\',\''+ row.location +'\')" class="list-group-item">'+ row.location +'</a>');
                });
                $('#citiesModal').modal("show");
            }
        })
        .fail(tools.fail)
        .always(function () {
            city_zipcode.attr('disabled', false);
        });
    },
    city : function(city_id, text)
    {
        $("#city_location").val(text);
        $("#city_id").val(city_id);
        $('#citiesModal').modal("hide");
    }
};

cc.dashboard = {
    panel : {
        only : function(selector)
        {
            $('#content-dashboard .collapse:not('+selector+')').collapse('hide');
            this.show(selector);
        },
        hide : function()
        {
            if(arguments.length)
                $(arguments[0]).collapse('hide');
            else
                $("#content-dashboard .collapse").collapse('hide');
        },
        show : function()
        {
            if(arguments.length)
                $(arguments[0]).collapse('show');
            else
                $("#content-dashboard .collapse").collapse('show');
        },
        loading : function(selector, method)
        {
            if(method == 'show')
                $(selector).show();
            else
                $(selector).hide();
        },
    }
};

cc.business = {
    add : {
        create : function()
        {
            cc.dashboard.panel.loading("#businessAddLoading","show");
            $.ajax({
                url : cc.baseUrl + 'business/create',
                dataType : 'json'
            })
            .done(function(data) {
                tools.handlebars("#businessAddForm_HBT", "#businessAddForm_HBW", {'_token':data._token});
                cc.dashboard.panel.only("#businessAdd");
                $("#businessAddForm").bind('submit', cc.business.add.store);
            })
            .fail(tools.fail)
            .always(function () {
                cc.dashboard.panel.loading("#businessAddLoading","hide");
            });
        },
        store : function()
        {
            cc.dashboard.panel.loading("#businessAddLoading","show");
            var form = $("#businessAddForm");
            var data = [];

            form.find("button[type='submit']").attr('disabled', true);

            $.each(form.serializeArray(), function(i, field) {
                data[field.name] = field.value;
            });
            $.ajax({
                url : cc.baseUrl + 'business',
                dataType : 'json',
                type: "POST",
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Business " + data.business.name + " Added", 'success');
                    cc.dashboard.panel.hide();
                    cc.business.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#businessAddLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#businessTable');
            this.clear();
        },
        clear : function()
        {
            $("#businessAddForm_HBW").html("");
        }
    },
    edit : 
    {
        edit : function(id)
        {
            cc.dashboard.panel.only("#businessEdit");
            cc.dashboard.panel.loading("#businessEditLoading","show");

            $.ajax({
                url : cc.baseUrl + 'business/' + id + '/edit',
                dataType : 'json'
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.handlebars("#businessEditForm_HBT", "#businessEditForm_HBW", data.business);
                    $("#business_type_id").val(data.business.business_type_id);
                    $("#organization_type_id").val(data.business.organization_type_id);
                    $("#country_code").val(data.business.country.code);
                    cc.location.country();
                    $("#businessEditForm").bind('submit', cc.business.edit.update);
                }
                else
                {
                    tools.messages(data.errors, "error");
                }
            })
            .fail(tools.fail)
            .always(function(){
                cc.dashboard.panel.loading("#businessEditLoading","hide");
            });
        },
        update : function(x)
        {
            cc.dashboard.panel.loading("#businessEditLoading","show");
            var form = $("#businessEditForm");
            var data = form.serialize();
            var id = $("#id").val();

            form.find("button[type='submit']").attr('disabled', true);

            $.ajax({
                url : cc.baseUrl + 'business/' + id,
                dataType : 'json',
                type: "PUT",
                processData : false,
                data : data
            })
            .done(function(data) {
                if (data.success)
                {
                    tools.messages("Business " + data.business.name + " Edited", 'success');
                    cc.dashboard.panel.hide();
                    cc.business.table();
                }
                else
                {
                    tools.messages(data.errors, 'error');
                }
            })
            .fail(tools.fail)
            .always(function () {
                form.find("button[type='submit']").attr('disabled', false);
                cc.dashboard.panel.loading("#businessEditLoading","hide");
            });
            return false;
        },
        cancel : function()
        {
            cc.dashboard.panel.only('#businessTable');
            this.clear();
        },
        clear : function()
        {
            $("#businessEditForm_HBW").html("");
        }
    },
    destroy : function(id)
    {

    },
    show : function(id)
    {
        $("#businessShow").collapse('show');
    },
    table : function(page)
    {
        cc.dashboard.panel.loading("#businessTableLoading","show");
        $("#businessesTable_HBW").html("");
        cc.dashboard.panel.only("#businessTable");
        $.ajax({
            url : cc.baseUrl + 'business',
            dataType : 'json',
            data : {
                page : page
            }
        })
        .done(function(data) {
            if (data.success)
            {
                tools.handlebars("#businessesTable_HBT", "#businessesTable_HBW", data);
            }
            else
            {
                tools.messages(data.errors, "error");
            }
        })
        .fail(tools.fail)
        .always(function(){
            cc.dashboard.panel.loading("#businessTableLoading","hide");
        });
    },
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
                url : cc.baseUrl + 'dashboard/searchAdmin',
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
    init: function()
    {
        cc.business.table();
        cc.business.admin.init();
    }
}
