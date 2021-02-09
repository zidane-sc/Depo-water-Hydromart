const {
    Client
} = require('pg')

const client = new Client({
    host: 'iotjpa.com',
    user: 'postgres',
    database: 'depo_air',
    password: 'Together1!',
    port: 5432,
});


// const client = new Client({
//     host: 'localhost',
//     user: 'postgres',
//     database: 'klhk',
//     password: 'root',
//     port: 5432,
// })

client.connect(function (err) {
    if (err) {
        console.log(err)
        process.exit(1);
    } else {
        console.log('Postgre Connected !')
    };
})

module.exports.client = client;
