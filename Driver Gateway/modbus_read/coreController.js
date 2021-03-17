const pg = require('./coreQuery');


module.exports.getController = async function getController(callbacks) {
    const query = `SELECT * FROM device_controllers AS dc WHERE controller_status = 1`
    // const query = `SELECT * FROM device_controllers AS dc INNER JOIN device_controller_tags as dct ON dc.id = dct.device_controller_id WHERE controller_status = 1`
    var controller = {};
    var listControllers = await pg.getQuery(query);


    var tagName,
        tagAddress,
        tags = {};

    for (const key in listControllers) {
        let ctl = listControllers[key];
        const subquery = `SELECT * FROM device_controller_tags AS dc WHERE device_controller_id = ` + ctl['id'];
        var listTags = await pg.getQuery(subquery);
        tags = {};

        // CEK APAKAH INI GATEWAY YANG DITUJU
        const sensorsQuery = `SELECT * FROM sensors AS ss WHERE gateway_id = '${ctl['id']}' and sensor_status = '1'`;
        var listSensors = await pg.getQuery(sensorsQuery);
        //- JIKA IYA CEK TAG YANG AKTIF
        if (listSensors.length > 0) {
            for (const sensor in listSensors) {
                //- CARI TAG ID DARI SENSOR YANG AKTIF
                const tagQuery = `SELECT * FROM device_controller_tags AS dct WHERE id = ` + listSensors[sensor].tag_id;
                var tagActive = await pg.getQuery(tagQuery);



                //- SET TAG UNTUK JADI PARAMETER TAGS 
                for (const keyTags in tagActive) {
                    let tag = tagActive[keyTags];
                    tagName = listSensors[sensor].sensor_name + ':' + tag['tag_data_type'];
                    tagAddress = tag['tag_address'];
                    tags[tagName] = tagAddress;
                }
                // tagName = tagActive[0].tag_name + ':' + tagActive[0].tag_data_type;
                // tagAddress = tagActive[0].tag_address;
                // tags[tagName] = tagAddress;
                // SET CONTROLLER YANG BACA
                controller[ctl['controller_name']] = {
                    "options": {
                        "host": ctl['controller_host'],
                        "port": ctl['controller_port'],
                        "deviceId": ctl['controller_device_id']
                    },
                    "tags": tags
                };
            }

        }


        // SEND REQUEST LAMA SEMUA TAG DI REQUEST
        // for (const keyTags in listTags) {
        //     let tag = listTags[keyTags];
        //     tagName = tag['tag_name'] + ':' + tag['tag_data_type'];
        //     tagAddress = tag['tag_address'];
        //     tags[tagName] = tagAddress;
        // }





    }
    callbacks(controller);
};