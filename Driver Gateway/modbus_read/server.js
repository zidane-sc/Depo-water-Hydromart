const modbus = require('jsmodbus')
const net = require('net')
const netServer = new net.Server()
const server = new modbus.server.TCP(netServer)
server.on('connection', function (data) {
    console.log("ModbusTCP listening on modbus://0.0.0.0:502")
})
netServer.listen(502)
