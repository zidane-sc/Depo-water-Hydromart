  // GAUGE 1 CURRENT AVERAGE
  function optionSetting(valData, gaugeName, unit,min=0,max=100) {
      let option = {
          tooltip: {
              formatter: "{a} <br/>{b} : {c} " + unit
          },
          toolbox: {
              show: true,
              orient: 'horizontal',
              x: 'right',
              y: 'top',
              feature: {
                  restore: {
                      show: true,
                      title: 'Reset',
                  },
                  saveAsImage: {
                      name: gaugeName,
                      show: true,
                      title: 'Save Png',
                  }
              }
          },
          series: [{
              name: gaugeName,
              type: 'gauge',
              min: min,
              max: max,
              splitNumber: 10,
              axisLine: {
                  lineStyle: {
                      color: [
                          [0.2, '#228B22'],
                          [0.8, '#4488BB'],
                          [1, '#FF4500']
                      ],
                      width: 8
                  }
              },
              axisTick: {
                  splitNumber: 10,
                  length: 12,
                  lineStyle: {
                      color: 'auto'
                  }
              },
              axisLabel: {
                  textStyle: {
                      color: 'auto'
                  }
              },
              splitLine: {
                  show: true,
                  length: 30,
                  lineStyle: {
                      color: 'auto'
                  }
              },
              title: {
                  show: true,
                  offsetCenter: [0, '-40%'],
                  textStyle: {
                      fontWeight: 'bolder'
                  }
              },
              detail: {
                  formatter: '{value} ' + unit,
                  offsetCenter: [0, '90%'],
                  textStyle: {
                      color: 'auto',
                      // fontWeight: 'bolder'
                  }
              },
              data: [{
                  value: valData,
                  name: ''
              }, ],
          }],
      };
      return option;
  }


//   var device = 'SOCOMEC';
  function changeDevice(device){
      alert(device)
      device = device;
  }


  var gauge1 = echarts.init(document.getElementById('current-avg'));
  var gauge2 = echarts.init(document.getElementById('voltage-pn'));
  var gauge3 = echarts.init(document.getElementById('voltage-pp'));
  var gauge4 = echarts.init(document.getElementById('active-power'));
  var gauge5 = echarts.init(document.getElementById('reactive-power'));
  var gauge6 = echarts.init(document.getElementById('apparent-power'));

  gauge1.setOption(optionSetting(0, 'Current AVG', 'A'), true);
  gauge2.setOption(optionSetting(0, 'Voltage PN', 'V'), true);
  gauge3.setOption(optionSetting(0, 'Voltage PP', 'V'), true);
  gauge4.setOption(optionSetting(0, 'Active Pwr', 'W'), true);
  gauge5.setOption(optionSetting(0, 'Reactive Pwr', 'VAR'), true);
  gauge6.setOption(optionSetting(0, 'Apparent Pwr', 'VA'), true);

  window.socketio.on('modbus', function (data) {
    //   console.log(device);
      data = data.data[device];
      if (typeof data !== 'undefined') {
        console.log(data);
        // CURRENT
          $('#phase-r').text(fix_val(data.current_r, 5));
          $('#phase-s').text(fix_val(data.current_s, 5));
          $('#phase-t').text(fix_val(data.current_t, 5));
          $('#phase-n').text(fix_val(data.current_n, 5));
          $('#phase-avg').text(fix_val(data.current_avg, 5));
        // VOLTAGE PN
          $('#voltage-r-n').text(fix_val(data.voltage_rn, 5));
          $('#voltage-s-n').text(fix_val(data.voltage_sn, 5));
          $('#voltage-t-n').text(fix_val(data.voltage_tn, 5));
          $('#voltage-ln-rvg').text(fix_val(data.voltage_ln_rvg, 5));
        // VOLTAGE PN
        $('#voltage-r-s').text(fix_val(data.voltage_rs, 5));
        $('#voltage-s-t').text(fix_val(data.voltage_st, 5));
        $('#voltage-t-r').text(fix_val(data.voltage_tr, 5));
        $('#voltage-ll-rvg').text(fix_val(data.voltage_ll_rvg, 5));
         

          gauge1.setOption(optionSetting(fix_val(data.current_avg, 5), 'Current AVG', 'A',0,3), true);
          gauge2.setOption(optionSetting(fix_val(data.voltage_ln_rvg, 5), 'Voltage PN', 'V', 200, 300), true);
          gauge3.setOption(optionSetting(fix_val(data.voltage_ll_rvg, 5), 'Voltage PP', 'V', 200,500 ), true);
          gauge4.setOption(optionSetting(fix_val(data.active_power_total, 5), 'Active Pwr', 'W',0.7,2), true);
          gauge5.setOption(optionSetting(fix_val(data.reactive_power_total, 5), 'Reactive Pwr', 'VAR',-0.5,2), true);
          gauge6.setOption(optionSetting(fix_val(data.apparent_power_total, 5), 'Apparent Pwr', 'VA',0,1.20), true);
      }
  });

  function fix_val(val, del = 2) {
      var rounded = val.toFixed(del); // Round Number
      return rounded; // Output Result
  }
