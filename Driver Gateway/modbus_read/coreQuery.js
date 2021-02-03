const conn = require('./pgsqlconnection');



module.exports = {
    'getQuery': async function getQuery(query) {
        var result;
        await new Promise((resolve, reject) => {
            conn.client.query(query, (err, res) => {
                if (err) {
                    reject(err.stack)
                    console.log(err.stack)
                } else {
                    result = res.rows
                    resolve(result);
                }
            })
        })
        return result;
    }
}