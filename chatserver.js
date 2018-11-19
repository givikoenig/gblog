var http = require('http').Server();
var io = require('socket.io')(http);
var Redis = require('ioredis');

var redis = new Redis();
redis.psubscribe('news-action.*');
redis.on('pmessage', function(pattern, channel, message) {
	console.log('Message recieved' + message);
	console.log('Channel :' + channel);
	message = JSON.parse(message);
	io.emit(channel + ':' + message.event, message.data);
});

http.listen(3300, function() {
	console.log('Listening on Port: 3300');
})

