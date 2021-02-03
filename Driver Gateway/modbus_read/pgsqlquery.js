    
    var datetime = require('node-datetime');
    const conn = require('./pgsqlconnection');

    module.exports.insert = async function insert(table, data,callback) {
        let dt = datetime.create();
        let dateTime = dt.format('Y-m-d H:M:S');
        const values = [];
        let columns = '';
        let valInit = '';
        let index = 1;
        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                const val = data[key];
                columns += key + ',';
                valInit += '$' + index++ +',';
                values.push(val)
            }
        }
        columns = columns.slice(0, -1);
        valInit = valInit.slice(0, -1);
        // console.log('INSERT INTO dummy(' + columns + ') VALUES(' + valInit + ') RETURNING *');
       
        const text = 'INSERT INTO ' + table + '(' + columns + ') VALUES(' + valInit + ') RETURNING *'

        // callback
        await new Promise((resolve, reject) => {
            conn.client.query(text, values, (err, res) => {
                if (err) {
                    reject(err.stack)
                    // console.log(err.stack)
                } else {
                    callback(dateTime + ' SUCCESSFULLY INSERT INTO ' + table)
                    // console.log(dateTime+' SUCCESSFULLY INSERT INTO '+table);
                    // resolve(res.rows[0])
                    // console.log(res.rows[0])
                }
            })
        })
        

    }