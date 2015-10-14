if (!cc) var cc = {};
if (!cc.crud) cc.crud = {};
if (!cc.crud.business) cc.crud.business = {};

cc.crud.business.commenter = {
    business_uuid: null,

    remove: function (uuid) {
        var url = cc.baseUrl + 'business/' + cc.crud.business.commenter.business_uuid + '/customer/' + uuid + '/destroy';
        $.ajax({
            url: url,
            method: 'DELETE',
            dataType: 'json',
            data: {
                _token: cc._token
            }
        })
        .done(function(data) {
            if (data.success) {
                window.location.replace(data.redirect);
            }
        })
        .fail(tools.fail);
    },

    sendrequest: function (uuid) {
        var url = cc.baseUrl + 'business/' + cc.crud.business.commenter.business_uuid + '/customer/' + uuid + '/sendrequest';
        $.ajax({
            url: url,
            dataType: 'json'
        })
        .done(function(data) {
            if (data.success) {
                tools.messages(data.message, "info");
            }
        })
        .fail(tools.fail);
    },

    init: function () {
        $('.commenter-remove').each(function() {
            var $that = $(this);
            $that.bind('click', function(event) {
                event.preventDefault();
                cc.dashboard.modal.confirm("Delete Customer", "Confirm delete the customer " + $that.data('name') + "?", function(){
                    cc.crud.business.commenter.remove($that.data('uuid'));
                });
            });
        });
        $('.commenter-request').each(function() {
            var $that = $(this);
            $that.bind('click', function(event) {
                event.preventDefault();
                cc.dashboard.modal.confirm("Send Feedback Request", "Confirm to send a feedback request now to " + $that.data('name') + "?", function(){
                    cc.crud.business.commenter.sendrequest($that.data('uuid'));
                });
            });
        });
        cc.crud.business.commenter.cvs.upload();
    },

    cvs: {
        upload : function()
        {
            var context = this;
            'use strict';

            $('#csv-upload').fileupload({
                url:  $('#csv-upload').data('url'),
                dataType: 'json',
                type : 'POST',
                formData : {
                    _token : cc._token
                },
                submit : function(e, data) {
                    cc.pusher.connect();
                    cc.pusher.subscribe('user.' + cc.id, 'App\\Events\\EventCsvImporterLog', function(notification){
                        context.notification(notification.log, notification.type, notification.datetime, notification.line);
                    });

                    tools.messagesHide();
                    $("#cvsNotifications table").html("");
                    $("#cvsNotifications").show();
                    $("#commenters_table").collapse("hide");
                    context.notification("Uploading file", "info");
                    $('#csv-progress').show();
                    return true;
                },
                done: function (e, data) {
                    cc.pusher.disconnect();
                    if(data.result.errors)
                    {
                        if(typeof data.result.errors == "string")
                        {
                            context.notification(data.result.errors, "danger", false);
                        }
                        else
                        {
                            for(var i in data.result.errors)
                            {
                                context.notification(data.result.errors[i], "danger", false);
                            }
                        }
                    }
                    else
                    {
                        if(!cc.pusher.logged)
                        {
                            for(var i in data.result.results)
                            {
                                if(data.result.results[i].errors)
                                {
                                    if(typeof data.result.results[i].errors == "string")
                                    {
                                        context.notification(data.result.results[i].errors, "danger", false);
                                    }
                                    else
                                    {
                                        for(var j in data.result.results[i].errors)
                                        {
                                            context.notification(data.result.results[i].errors[j], "danger", false);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $('#csv-progress').hide();
                    $('#cvsNotifications .box-footer').show();
                    context.notification("File uploaded", "info");
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#csv-progress .progress-bar').css('width', progress + '%');
                }
            }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
        },
        notification : function(log, type, datetime)
        {
            var line = arguments[3] ? arguments[3] : false;
            if(typeof log == "string")
            {
                var html = log;
            }
            else
            {
                var html = "<b>" + log[0] + "</b>";
                html += "<ul>";
                for (var i in log)
                {
                    if(i == 0)
                        continue;

                    if(typeof log[i] == "array")
                    {
                        for(var j in log[i])
                        {
                            html += "<li>" + i + ":</b> " + log[i][j] + "</li>";
                        }
                    }
                    else
                    {
                        html += "<li>" + i + ":</b> " + log[i] + "</li>";
                    }
                }
                html += "</ul>";
            }
            var d = new Date();
            var dhtml = datetime ? datetime : moment().format('HH:mm:ss');
            if(line)
            {
                var tr = '<tr class="' + type + '"><td width="70">' + dhtml + '</td><td width="50">Line ' + line + '</td><td>' + html + '</td></tr>';
            }
            else
            {
                var tr = '<tr class="' + type + '"><td width="70">' + dhtml + '</td><td colspan="2">' + html + '</td></tr>';
            }
            $("#cvsNotifications table").prepend(tr);
        }
    }
}
