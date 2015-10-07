cc.pusher = {
    instance : false,
    connect : function(){
        this.instance = new Pusher(cc.pusher_key, {
            encrypted: true
        });
    },
    subscribe : function(name, event, callback){
        var channel = this.instance.subscribe(name);
        channel.bind(event, function(data) {
            callback(data);
        });
    },
    disconnect : function(){
        this.instance.disconnect();
    }
};
