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
        }).success(function(data) {
            if (data.success) {
                window.location.replace(data.redirect);
            }
        });
    },

    init: function () {
        $('.commenter-remove').each(function() {
            var $that = $(this);
            $that.bind('click', function() {
                cc.crud.business.commenter.remove($that.data('uuid'));
            });
        });
    }
}
