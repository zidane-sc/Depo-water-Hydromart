const datetime = require('node-datetime');


let dt = datetime.create();
let dateTime = dt.format('Y-m-d H:M:S');




// console.log(dataInsert);
// let valInit = '';
// let index = 1;
// const values = [];
// let columns = '';



const initOptions = {
    // pg-promise initialization options...
    connect(client, dc, useCount) {
        const cp = client.connectionParameters;
        console.log('Connected to database:', cp.database);
        // console.log(client);
    },
    // capSQL: true // capitalize all generated SQL

    
};
const pgp = require('pg-promise')(initOptions)
const db = pgp({ host: "localhost", port: 5432, database: 'jpa_eh', user: 'postgres',password:'root' });

// for (let index = 0; index < 10; index++) {
//     insert();
// }

let allRows = [];
let dataInsert = {};
dataInsert['tstamp'] = dateTime;
dataInsert['ph'] = 1;
dataInsert['tss'] = 2;
dataInsert['amonia'] = 3;
dataInsert['cod'] = 4;
dataInsert['flow_meter'] = 5;
dataInsert['controller_name'] = 6;

let dataInsert2 = {};
dataInsert2['tstamp'] = dateTime;
dataInsert2['ph'] = 1;
dataInsert2['tss'] = 2;
dataInsert2['amonia'] = 3;
dataInsert2['cod'] = 4;
dataInsert2['flow_meter'] = 5;
dataInsert2['controller_name'] = 6;

let dataInsert3 = {};
dataInsert3['tstamp'] = dateTime;
dataInsert3['ph'] = 1;
dataInsert3['tss'] = 2;
dataInsert3['amonia'] = 3;
dataInsert3['cod'] = 4;
dataInsert3['flow_meter'] = 5;
dataInsert3['controller_name'] = "PUSH CONT";

allRows.push(dataInsert);
allRows.push(dataInsert2);
allRows.push(dataInsert3);

// console.log(allRows);
insert();

async function insert(){
    // our set of columns, to be created only once (statically), and then reused,
    // to let it cache up its formatting templates for high performance:
    const cs = new pgp.helpers.ColumnSet(['tstamp', 'ph', 'tss', 'amonia', 'cod', 'flow_meter','controller_name'], { table: 'logs' });

    // data input values:
    // const values = allRows;
    const values = [{tstamp: dateTime, ph: 1,tss:2,amonia:3,cod:4,flow_meter:5,controller_name:'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
        { tstamp: dateTime, ph: 1, tss: 2, amonia: 3, cod: 4, flow_meter: 5, controller_name: 'MAZZETT' },
    ];

    // generating a multi-row insert query:
    const query = pgp.helpers.insert(values, cs) + 'RETURNING id';
    //=> INSERT INTO "tmp"("col_a","col_b") VALUES('a1','b1'),('a2','b2')

    // executing the query:
    const res = await db.many(query);
    console.log(res)
}

// -------------

