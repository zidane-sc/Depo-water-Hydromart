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
var port = 1010;

server.listen(process.env.PORT || port, '0.0.0.0', function () {
    console.log('listening on *:' + port);
});
// WARNING: app.listen(80) will NOT work here!
// konversi dari rest do\i broadcast ke socketio
app.post("/eh-water", function (req, res) {
    // clear();
    console.log(req.body);
    io.to("all").emit("eh-water", req.body);
    res.send("EH WATER OK");
});

app.post("/eh-water-alarm", function (req, res) {
    clear();
    console.log(req.body);
    io.to("all").emit("eh-water-alarm", req.body);
    res.send("EH ALARM SEND");
});

app.post("/eh-gateway-status", function (req, res) {
    clear();
    console.log(req.body);
    io.to("all").emit("eh-gateway-status", req.body);
    res.send("STATUS GATEWAY : " + req.body);
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
