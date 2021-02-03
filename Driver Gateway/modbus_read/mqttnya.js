
const pg = require('./coreQuery');
var mqtt = require('mqtt')
// ----- GET GLOBAL SETTING


const getmqttClient = async function () {
    
    return new Promise((resolve, reject) => {
        if (global.mqttkita !== undefined) {
            return resolve(global.mqttkita)
        }

        global.mqttkita = mqtt.connect("", {
            host: goiotSetting[0].host,
            protocol:"mqtt",
            clientId: goiotSetting[0].clientid,
            username: goiotSetting[0].username,
            password: goiotSetting[0].password,
            port: goiotSetting[0].port,
            keepalive: goiotSetting[0].keepalive
        })
        global.mqttkita.on('connect', function () {
            return resolve(global.mqttkita)
        })
        global.mqttkita.on('error', function (err) {
            reject(err)
        })
    })


}

module.exports.getmqttClient = getmqttClient;