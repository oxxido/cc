cc.bizfeed = {
    init : function()
    {
        this.tinymce();
        this.uploader.init();
    },
    tinymce : function(){
        tinymce.init({
          selector: "textarea.editable",
          height: 300,
          statusbar: false,
          toolbar: "undo redo taging",
          menubar: false,
          object_resizing: false,
          external_plugins: {
            "taging": cc.baseUrl + "js/vendor/taging/plugin.min.js"
          }
        });

        $("#feedbackForm").bind('submit', function(){
          $("textarea.editable").each(function(i, textarea){
            var body = $(textarea).val();
            tinymce.editors[0].destroy();
            $(textarea).val(body);
          });
          $("input[type=file]").remove();
          return true;
        });
    },
    uploader : {
        init : function()
        {
            'use strict';
            this.set('logo');
            this.set('banner');
        },
        set : function(target)
        {
            $('#'+target+'-upload').fileupload({
                url: cc.baseUrl + 'dashbiz/upload',
                dataType: 'json',
                formData : {
                    _token : cc._token,
                    target : target
                },
                submit : function(e, data) {
                    $('#'+target+'-progress').show();
                    return true;
                },
                done: function (e, data) {
                    $('#'+target+'').attr("src", data.result.image);
                    $('#'+target+'-progress').hide();
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#'+target+'-progress .progress-bar').css('width', progress + '%');
                }
            }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
        }
    },
    gallery : function(target)
    {
        $.ajax({
            url : cc.baseUrl + 'dashbiz/gallery',
            dataType : 'json',
            data : {
                target : target
            }
        })
        .done(function(data) {
            cc.dashboard.modal.handlebars("Select Image", "#gallery_HBT", data);
            cc.dashboard.modal.size("modal-lg");
            $("#dashboard-modal .thumbnail").data("target", target);
        })
        .fail(tools.fail);
    },
    selected : function(link)
    {
        var target = $(link).data("target");
        var image = $(link).data("image");
        this.save(target, image);
    },
    external : function(target)
    {
        cc.dashboard.modal.handlebars("External Image Link", "#external_HBT", {}, function(){
            var image = $("#external_link").val();
            cc.bizfeed.save(target, image);
        });
    },
    save : function(target, image)
    {
        $.ajax({
            url : cc.baseUrl + 'dashbiz/image',
            dataType : 'json',
            type : "POST",
            data : {
                _token : cc._token,
                target : target,
                image : image
            }
        })
        .done(function(data) {
            cc.dashboard.modal.hide();
            $('#'+target).attr("src", image);  
        })
        .fail(tools.fail);
    }
};

$(function () {
    cc.bizfeed.init();
});  