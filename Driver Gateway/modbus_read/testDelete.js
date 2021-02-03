var datetime = require('node-datetime');
const pg = require('./coreQuery');


async function deleteError(id){
    const query = `DELETE FROM fail_api_logs where id = ` + id;
    var Delete = await pg.getQuery(query);
    console.log(Delete);
}

async function getError(){
    const queryErrorApi = `SELECT * FROM fail_api_logs`;
    let errorData = await pg.getQuery(queryErrorApi);

    console.log(errorData.length);

}

getError()

// let errorData = function(){
//     return new Promise((resolve,reject)=>{
//         return resolve(getError());
//     })
// }
// deleteError(67);
