// ================* MOTHLY *


function submitDate() {
    let daterange = $('#daterange').val();
    let date = $('#date').val()
    if (daterange == 'day' || daterange == 'minute') {
        date = $('#date').val()
    } else if (daterange == 'month') {
        date = $('#month').val()
    } else if (daterange == 'year') {
        date = $('#year').val()
    }
    $('#status').html('<span class="tx-12 align-self-center badge badge-warning">Loading ...</span>')
    toastr.warning(new Date().toLocaleString('en-US', {
            timeZone: 'Asia/Jakarta'
        }) +
        ": Loading..");
    axios.post('./api/consumption', {
            date: date,
            daterange: daterange,
        })
        .then(function (response) {
            toastr.success(new Date().toLocaleString('en-US', {
                timeZone: 'Asia/Jakarta'
            }) + ": Success !");
            $('#periode').text(response.data.date)
            $('#date').val(response.data.date)
            let dataCount = response.data.dataexist.tstamp.length;
            if (dataCount > 0) {
                $('#status').html(dataCount + ' data : ' + '<span class="tx-12 align-self-center badge badge-success">Success</span> ')
            } else {
                $('#status').html(dataCount + ' data : ' + '<span class="tx-12 align-self-center badge badge-danger">No Data Available</span> ')
            }
            dataExist(response.data.dataexist);
            dataTotal(response.data.datatotal);

            // Datatable Add

            // --dataexist
            table.clear();
            $.each(response.data.dataexist.all, function (i, key) {
                table.row.add([
                    i + 1,
                    response.data.dataexist.all[i].datetime,
                    response.data.dataexist.all[i].kwh_exist,
                    response.data.dataexist.all[i].kvarh_exist,
                    response.data.dataexist.all[i].kvah_exist,
                ])
            });
            table.draw();

            // --datatotal
            table2.clear();
            $.each(response.data.dataexist.all, function (i, key) {
                table2.row.add([
                    i + 1,
                    response.data.dataexist.all[i].datetime,
                    response.data.dataexist.all[i].kwh_total,
                    response.data.dataexist.all[i].kvarh_total,
                    response.data.dataexist.all[i].kvah_total,
                ])
            });
            table2.draw();

        })
        .catch(function (error) {

            toastr.error("Failed !");
            $('#status').html('<span class="tx-12 align-self-center badge badge-danger">Failed</span>')

            console.log(error);
        });
}
// ---DATA EXIST

function randomIntFromInterval(min, max) { // min and max included 
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function chart(divId, nameIndex, tstamp = [], dataLog = [] ,dataAlarm =[]) {

    // ------- SET POINT
    let setpoint = {
        
        label:{
            show:true,
            position:'end',
        },
        
        data: dataAlarm,
    };
    // ------- SET POINT
    console.log(nameIndex);
    var consumption = echarts.init(document.getElementById(divId));
    consumption.clear();
    option1 = {
        legend: {
            data: [nameIndex],
            textStyle: {
                color: "#ffffff"
            }
        },
        animation: true,
        tooltip: {
            trigger: 'axis',

            textStyle: {
                color: "#ffffff"
            }
        },
        toolbox: {

            feature: {
                // restore: {
                //     title: 'Reset',

                // },
                // saveAsImage: {
                //     title: 'Save Png',
                // },

            }
        },
        title: {
            left: 'center',
            text: '',

        },
        yAxis: {

            type: 'value',
            axisLabel: {
                formatter: function (val) {
                    return (val) + '%';
                }
            },

        },
        xAxis: {

            type: 'category',
            data: tstamp,
            splitLine: {
                show: true,
                onGap: null,
                // Garis Pebatas
                lineStyle: {
                    color: 'rgba(245, 245, 245, 0.10)',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(245, 245, 245, 0.10)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },

            },
            axisLabel: {
                color: "#ffffff"
            }

        },
        yAxis: {
            type: 'value',
            boundaryGap: [0, '5%'],
            axisLabel: {
                color: "#ffffff"
            },
            splitLine: {
                show: true,
                onGap: null,
                // Garis Pebatas
                lineStyle: {
                    color: 'rgba(245, 245, 245, 0.10)',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(245, 245, 245, 0.10)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },

            },
        },
        grid: {
            x: 60,
            y: 20,
            x2: 40,
            y2: 80
        },
        dataZoom: [{
                type: 'inside',
                start: 0,
            },
            {
                type: 'slider',
                fillerColor: '#E9ECEF'
            },
            {
                start: 0,
                handleSize: '100%',
                handleStyle: {
                    color: '#fff',
                    shadowBlur: 10,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                }
            }
        ],
        series: [{
            name: nameIndex,
            type: 'line',
            smooth: true,
            barGap: '10%',
            data: dataLog,
            // data: [randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000)],
            itemStyle: {
                shadowColor: '#DEE2E6',
                shadowBlur: 2,
            },
            // color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
            //     offset: 0,
            //     color: getRandomColor() // color at 0% position
            // }, {
            //     offset: 1,
            //         color: getRandomColor() // color at 100% position
            // }], false)
            color: getRandomColor(),
            markLine: setpoint
        }],
    };
    consumption.setOption(option1);

}

function chartTotalizer(divId, nameIndex, tstamp = [], dataLog = [], dataAlarm = [], typeGraph='line') {

     
     
    // ------- SET POINT
    console.log(dataAlarm);
    var consumption = echarts.init(document.getElementById(divId));
    consumption.clear();
    option1 = {
        legend: {
            data: [nameIndex],
            textStyle: {
                color: "#ffffff"
            }
        },
        animation: true,
        tooltip: {
            trigger: 'axis',

            textStyle: {
                color: "#ffffff"
            }
        },
        toolbox: {

            feature: {
                // restore: {
                //     title: 'Reset',

                // },
                // saveAsImage: {
                //     title: 'Save Png',
                // },

            }
        },
        title: {
            left: 'center',
            text: '',

        },
        yAxis: {

            type: 'value',
            axisLabel: {
                formatter: function (val) {
                    return (val) + '%';
                }
            },

        },
        xAxis: {

            type: 'category',
            data: tstamp,
            splitLine: {
                show: true,
                onGap: null,
                // Garis Pebatas
                lineStyle: {
                    color: 'rgba(245, 245, 245, 0.10)',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(245, 245, 245, 0.10)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },

            },
            axisLabel: {
                color: "#ffffff"
            }

        },
        yAxis: {
            type: 'value',
            boundaryGap: [0, '5%'],
            axisLabel: {
                color: "#ffffff"
            },
            splitLine: {
                show: true,
                onGap: null,
                // Garis Pebatas
                lineStyle: {
                    color: 'rgba(245, 245, 245, 0.10)',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(245, 245, 245, 0.10)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },

            },
        },
        grid: {
            x: 60,
            y: 20,
            x2: 40,
            y2: 80
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
        },
        {
            type: 'slider',
            fillerColor: '#E9ECEF'
        },
        {
            start: 0,
            handleSize: '100%',
            handleStyle: {
                color: '#fff',
                shadowBlur: 10,
                shadowColor: 'rgba(0, 0, 0, 0.6)',
                shadowOffsetX: 2,
                shadowOffsetY: 2
            }
        }
        ],
        series: [{
            name: nameIndex,
            type: typeGraph,
            smooth: true,
            barGap: '10%',
            data: dataLog,
            // data: [randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000), randomIntFromInterval(1000, 2000)],
            itemStyle: {
                shadowColor: '#DEE2E6',
                shadowBlur: 2,
            },
            // color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
            //     offset: 0,
            //     color: getRandomColor() // color at 0% position
            // }, {
            //     offset: 1,
            //         color: getRandomColor() // color at 100% position
            // }], false)
            color: '#FE8007'
           
        }],
    };
    consumption.setOption(option1);

}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function resizeChart(divId) {
    var chart = echarts.init(document.getElementById(divId));
    new ResizeSensor(jQuery('#' + divId), function () {
        chart.resize();
    })
}
