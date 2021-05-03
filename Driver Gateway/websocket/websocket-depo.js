var app = require("express")();
var bodyParser = require("body-parser");
app.use(bodyParser.urlencoded({
    extended: false
}));
app.use(bodyParser.json());
var server = require("http").Server(app);
var io = require("socket.io")(server);
var clear = require('clear');
const schedule = require('node-schedule');
const axios = require('axios').default;

let allValues = []
const job = schedule.scheduleJob('*/60 * * * * *', function () {
    console.log(allValues.length)
    console.log(allValues)
    if(allValues.length > 0){
        axios.post('https://hydromart-galaxy.grooject.com/api/webhook-save', allValues)
            .then(function (response) {
                console.log(response.data);
                allValues = []
            })
            .catch(function (error) {
                console.log(error);
            });
    }
   
    // console.log('The answer to life, the universe, and everything!');
});
function search(nameKey, myArray) {
  for (var i = 0; i < myArray.length; i++) {
    if (myArray[i].tag_name === nameKey) {
      // console.log(nameKey, "TRUE");
      return true;
    }
  }
}


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
    // console.log(req.body);
    let searchVal = search(req.body.tag_name,allValues)
    if (typeof searchVal === "undefined") {
        allValues.push(req.body)
    }else if (searchVal === true){
        allValues = allValues.map(
            (obj) => {
                if(obj.tag_name === req.body.tag_name){
                    return req.body
                }else{
                    return obj
                }
            }
        );
    }
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
