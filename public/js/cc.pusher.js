var pusher = new Pusher('d05e325a459b724d0d2f', {
    encrypted: true
});

var channel = pusher.subscribe('user.' + cc.id);
channel.bind('App\\Events\\EventCsvImporterLog', function(data) {
    cc.crud.business.cvs.notification(data.log, data.type, data.datetime, data.line);
});