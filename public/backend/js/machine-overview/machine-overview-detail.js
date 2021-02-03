$(function () {

    $('.chart').easyPieChart({
        // The color of the curcular bar. You can pass either a css valid color string like rgb, rgba hex or string colors. But you can also pass a function that accepts the current percentage as a value to return a dynamically generated color.
        // easing: 'easeOutBounce',
        barColor: '#D90165',
        barColor: '#94C120',
        barColor: '#22448B',
        barColor: '#0DB3CF',
        scaleColor: false,
        // The color of the track for the bar, false to disable rendering.
        trackColor: '#e5e5e5',
        rotate: 180,

        lineWidth: 10,
        // Size of the pie chart in px. It will always be a square.
        size: 200,
        // Time in milliseconds for a eased animation of the bar growing, or false to deactivate.
        animate: 1000,
        // Callback function that is called at the start of any animation (only if animate is not false).
        onStart: $.noop,
        // Callback function that is called at the end of any animation (only if animate is not false).
        onStop: $.noop
    });
    setInterval(() => {
        let random1 = getRandomInt(50, 100);
        // OEE    
        $('.qty-product-1').data('easyPieChart').update(random1);
        $('span', $('.qty-product-1')).text(random1);


    }, 1000);




    function getRandomInt(min, max) {
        // return Math.floor(Math.random() * Math.floor(max + 1));
        return Math.floor(Math.random() * (max - min + 1) + min);

    }

    var time = [];
    var qty = [];
    var hours = 00;
    for (let index = 0; index < 24; index++) {
        time.push('00:'+ index);
        qty.push(getRandomInt(50, 100));
    }

    console.log(time);
    // TRENDING
    var current1 = echarts.init(document.getElementById('current1'));
    current1.clear();
    option1 = {
        legend: {
            data: ['Quality', ]
        },
        animation: true,
        tooltip: {
            formatter: "{a} <br/>{b} : {c} " + '%',
            trigger: 'axis',
            // position: function (pt) {
            //     return [pt[0], '10%'];
            // }
        },
        toolbox: {
            feature: {
                restore: {
                    title: 'Reset',
                },
                saveAsImage: {
                    title: 'Save Png',
                }
            }
        },
        title: {
            left: 'center',
            text: '',
        },
        xAxis: {
            type: 'category',
            logBase: 30,
            // boundaryGap: false,
            data: time
        },
        yAxis: {
            type: 'value',
            // splitNumber: 10,
            // splitArea: {
            //     interval: 10,
                
            // }

            // offset:100,
            // boundaryGap: [0, '5%']
        },
        grid: {
            x: 40,
            y: 20,
            x2: 40,
            y2: 80
        },
        dataZoom: [{
                type: 'inside',
                start: 0,
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
            name: 'Quality',
            type: 'line',
            smooth: true,
            // symbol: 'emptyCircle',
            // symbolSize: 8,
            // sampling: 'average',
            itemStyle: {
                normal: {
                    color: new echarts.graphic.LinearGradient(
                        0, 0, 0, 1,
                        [{
                                offset: 0,
                                color: '#0DB3Cd'
                            },
                            {
                                offset: 0.5,
                                color: '#0DB3CF'
                            },
                            {
                                offset: 1,
                                color: '#0DB3CF'
                            }
                        ]
                    )
                },
                emphasis: {
                    color: new echarts.graphic.LinearGradient(
                        0, 0, 0, 1,
                        [{
                                offset: 0,
                                color: '#2378f7'
                            },
                            {
                                offset: 0.7,
                                color: '#2378f7'
                            },
                            {
                                offset: 1,
                                color: '#83bff6'
                            }
                        ]
                    )
                }
            },
            data: qty

        }, ],
        // color: ['#0DB3CF']
    };
    current1.setOption(option1);



    new ResizeSensor(jQuery('#current1'), function () {
        console.log('Changed');
        current1.resize();

    })
    // window.onresize = function(){
    //     // alert('Rezise');
    //     current1.resize();
    // }
});
