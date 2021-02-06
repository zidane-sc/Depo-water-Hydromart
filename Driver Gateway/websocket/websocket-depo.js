var app = require("express")();
var bodyParser = require("body-parser");
app.use(bodyParser.urlencoded({
    extended: false
}));
app.use(bodyParser.json());
var server = require("http").Server(app);
var io = require("socket.io")(server);
var clear = require('clear');


io.origins((origin, callback) => {
    callback(null, true);
});
var port = 9090;

server.listen(process.env.PORT || port, '0.0.0.0', function () {
    console.log('listening on *:' + port);
});
// WARNING: app.listen(80) will NOT work here!
// konversi dari rest do\i broadcast ke socketio
app.post("/depo-air", function (req, res) {
    // clear();
    console.log(req.body);
    io.to("all").emit("air-depo", req.body);
    res.send("DEPO AIR OK");
});
 

io.on("connection", function (socket) {
    let from = socket.handshake.query['from'];
    console.log(from + ' : Connected');
    io.to("all").emit("eh-gateway-status", {
        'status': 'socket-connect'
    });

    socket.on('disconnect', () => {
        clear();
        io.to("all").emit("eh-gateway-status", {
            'status': 'socket-disconnect'
        });
        console.log(from + ' : Disconnected');
    });
    socket.join("all");
    // socket.join("all");

    // socket.emit('news', {
    // 	hello: 'world'
    // });
    // socket.on('my other event', function (data) {
    // 	console.log(data);
    // });
});
