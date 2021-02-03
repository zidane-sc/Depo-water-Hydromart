 

// var buffer = new ArrayBuffer(4);
// var view = new DataView(buffer);
// //-- BIG EDIAN (LSRF)
// // result : 12.3564
// // view.setInt16(0, 16709, false);
// // view.setInt16(2, 46032, false);
// // console.log(view.getFloat32(0, false));


// // 16917, 64906

// //-- litle EDIAN
// // result : 7.895000
// view.setInt16(2, 128, false);
// view.setInt16(0, 17750, false);
// console.log(view.getFloat32(0, false));
const getmac = require('getmac')

const callMac = () => {
    return getmac.default()
}

console.log(callMac());




