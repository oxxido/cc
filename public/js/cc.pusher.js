cc.pusher = {
    logged : false,
    instance : false,
    connect : function(){
        cc.pusher.logged = false;
        this.instance = new Pusher(cc.pusher_key, {
            encrypted: true
        });
    },
    subscribe : function(name, event, callback){
        var channel = this.instance.subscribe(name);
        channel.bind(event, function(data) {
            cc.pusher.logged = true;
            callback(data);
        });
    },
    disconnect : function(){
        this.instance.disconnect();
    }
};
