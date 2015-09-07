if (!cc) var cc = {};

cc.testimonials = {
	product_id : false,
	init : function(product_id)
	{
		this.product_id = product_id;
		this.table();
	},

    table : function()
    {
        var page = arguments.length ? arguments[0] : 1;
        var perpage = 10;

        $("#reviewsTable_HBW").html("");
        $.ajax({
            url : cc.baseUrl + 'widget/reviews',
            dataType : 'json',
            data : {
                page : page,
                perpage : perpage,
                product_id : this.product_id
            }
        })
        .done(function(data) {
            if (data.success)
            {
                tools.handlebars("#reviewsTable_HBT", "#reviewsTable_HBW", data);
                $(".comment .rating").rating();
                tools.paging("#paging", data.paging, function(page){
                    cc.testimonials.table(page);
                })
            }
            else
            {
                tools.messages(data.errors, "error");
            }
        })
        .fail(tools.fail)
        .always(function(){
        });
    }
};