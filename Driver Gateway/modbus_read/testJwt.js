const jwt = require('jwt-simple');
const query = require('./pgsqlquery');
const axios = require('axios');
// let url_klh = 'http://203.166.207.50/api/server-uji';


module.exports.sendJwt = function sendJwt(dateTime, server_url,payload,secret) {
    let dataApi ={};
    //----- encode
    var token = jwt.encode(payload, secret);
    let encode_payload = { 'token': token };

    axios.post(server_url, encode_payload)
        .then(function (response) {
            console.log(response.data);
            // ----- Insert Log
            dataApi['created_at'] = dateTime;
            dataApi['encode_payload'] = encode_payload;
            dataApi['decode_payload'] = payload;
            dataApi['response'] = response.data;
            // console.log(dataApi);
            query.insert('api_logs', dataApi, function (res) {
                console.log(res + ' (KLHK SEND :' + dateTime + ')');
            });
            console.log('KLH Send Success !');
        })
        .catch(function (error) {
            try {
                if (error.response.data !== 'undefined') {
                    dataApi['created_at'] = dateTime;
                    dataApi['encode_payload'] = encode_payload;
                    dataApi['decode_payload'] = payload;
                    dataApi['response'] = error.response.data;
                    // console.log(dataApi);
                    query.insert('api_logs', dataApi, function (res) {
                        console.log(res + ' (KLHK SEND :' + dateTime + ')');
                    });
                }
                return true;
            } catch (error) {
            }
            
            console.log('KLH Send Failed !');
            
        });

   

    
    
}