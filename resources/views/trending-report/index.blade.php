@extends('layouts.main')
@section('page_title',$page_title)
@section('css')
<style>
    .extra-bold {
        text-shadow: 0px 1px, 1px 0px, 1px 1px;
        letter-spacing: 1px;
    }

    .dashboard-header {
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;
        background: #00597A;
    }

    .rounded-top-20 {
        border-top-left-radius: 20px !important;
        border-top-right-radius: 20px !important;
    }

    .table-responsive::-webkit-scrollbar {
        -webkit-appearance: none;
    }

    .table-responsive::-webkit-scrollbar:vertical {
        width: 12px;
    }

    .table-responsive::-webkit-scrollbar:horizontal {
        height: 12px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, .5);
        border-radius: 10px;
        border: 2px solid #ffffff;
    }

    .table-responsive::-webkit-scrollbar-track {
        border-radius: 10px;
        background-color: #ffffff;
    }

</style>
@endsection
@section('content')
<div class="br-mainpanel">

    <div class="br-pagebody">
        <div class=" text-white rounded-20 pd-t-20 mg-t-50 mg-b-30">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-300 animated fadeInLeft"
                style="margin-top: -40px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/dashboard/monitoring.png')}}" class="ht-50 rounded-circle" alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>

        <div class=" text-white">

            <div class="row row-sm mg-b-30 ">
                <div class="col-lg-8" style="z-index:99">
                    <div class="card mg-b-20 rounded-20  tx-black shadow animated fadeInUp">
                        <div class="card-header  rounded-top-20  tx-medium bd-0 stx-18">
                            <i class="ion icon ion-calendar"></i> Filter Report
                        </div>
                        <div class="card-body ">
                            <div class="row row-sm">
                                <div class="col-xl-4">
                                    <div class="form-group ">
                                        <label> period :</label>
                                        <select class="form-control select2" data-placeholder="Choose one"
                                            id="daterange">
                                            <option value="day">Daily</option>
                                            <option value="month">Monthly</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4" style="z-index: 9;">
                                    <div class="form-group  " id="datepicker-date-area">
                                        <label> Date :</label>
                                        <input type="text" name="date" id="date" value="{{date('Y-m-d')}}"
                                            autocomplete="off" class="datepicker form-control time" required>
                                    </div>
                                    <div class="form-group hilang" id="datepicker-month-area">
                                        <label> Month :</label>
                                        <input type="text" name="date" id="month" value="{{date('Y-m')}}"
                                            autocomplete="off" class="datepicker-month form-control   time" required>
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="form-group">
                                        <button class="btn btn-magenta btn-block mg-t-30"
                                            onclick="showChart()">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="z-index:99">
                    <div class="card  rounded-20  tx-black shadow animated fadeInUp">
                        <div class="card-header  rounded-top-20  tx-medium bd-0 stx-18">
                            <i class="ion icon ion-calendar"></i> Set Point Legend
                        </div>
                        <div class="card-body d-flex ">


                            <span class="float-right animated fadeIn wd-100p tx-20 mg-l-10 animated fadeIn">
                                <span class="square-8 rounded-circle d-block"
                                    style="background: #BD362F;width: 20px;height: 20px;"></span> > </span>
                            <span class="float-right animated fadeIn wd-100p tx-20 mg-l-10 animated fadeIn">
                                <span class="square-8 rounded-circle d-block"
                                    style="background: #C2185B;width: 20px;height: 20px;"></span> >= </span>
                            <span class="float-right animated fadeIn wd-100p tx-20 mg-l-10 animated fadeIn">
                                <span class="square-8 rounded-circle d-block"
                                    style="background: #52D83A;width: 20px;height: 20px;"></span> == </span>
                            <span class="float-right animated fadeIn wd-100p tx-20 mg-l-10 animated fadeIn">
                                <span class="square-8 rounded-circle d-block"
                                    style="background: #EAD239;width: 20px;height: 20px;"></span>
                                < </span> <span
                                    class="float-right animated fadeIn wd-100p tx-20 mg-l-10 animated fadeIn">
                                    <span class="square-8 rounded-circle d-block"
                                        style="background: #E3892B;width: 20px;height: 20px;"></span>
                                    <= </span> </div> </div> </div> </div> <div class="row row-sm">


                                        <div class="col-lg-12">
                                            @foreach ($sensors as $sensor)
                                            <div
                                                class="card royal text-white rounded-20 pd-20 mg-t-40 shadow animated fadeIn">
                                                 <div class="d-block text-right">
                                                            <button data-toggle="tooltip" title="save images" class="btn btn-sm btn-info right" onclick="downloadImage('{{$sensor->sensor_name}}','{{$sensor->sensor_display}}')" type="button"
                                                             ><i class="icon ion-ios-download tx-20"></i></button>
                                                    </div>
                                                <div class="text-center d-flex  bg-grandeur rounded-20 pd-10 text-white shadow"
                                                    style="width:fit-content;margin-top: -40px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                                                   
                                                    <img src="{{asset('backend/images/icon/water.png')}}"
                                                        class="ht-40 rounded-circle" alt="">
                                                    <span class="tx-bold mg-b-0 mg-t-10 mg-l-5 "
                                                        style="text-shadow: -3px 2px 9px #0000;letter-spacing: 1px;">{{$sensor->sensor_display}}
                                                    </span>
                                                </div>
                                                {{-- <p class="text-right hidden-sm-down" style="margin-top: -40px;">Tuesday ,21 April 2020</p> --}}


                                                <div class="bg-royal pd-10 rounded-20 wd-100p mg-t-20 ht-500"
                                                    id="{{$sensor->sensor_name}}" width="">
                                                </div>

                                            </div>
                                            @endforeach

                                            <div class="card royal text-white rounded-20 pd-20 mg-t-40 shadow animated fadeIn totalizer"
                                                id="full_totalizer">
                                               <div class="d-block text-right">
                                                    <button data-toggle="tooltip" title="save images" class="btn btn-sm btn-info right" onclick="downloadImage('totalizer','totalizer')" type="button"
                                                     ><i class="icon ion-ios-download tx-20"></i></button>
                                               </div>

                                                <div class="text-center d-flex  bg-grandeur rounded-20 pd-10 text-white shadow"
                                                    style="width:fit-content;margin-top: -40px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                                                    <img src="{{asset('backend/images/icon/water.png')}}"
                                                        class="ht-40 rounded-circle" alt="">
                                                    <span class="tx-bold mg-b-0 mg-t-10 mg-l-5 "
                                                        style="text-shadow: -3px 2px 9px #0000;letter-spacing: 1px;">Totalizer
                                                    </span>
                                                </div>
                                                {{-- <p class="text-right hidden-sm-down" style="margin-top: -40px;">Tuesday ,21 April 2020</p> --}}


                                                <div class="bg-royal pd-10 rounded-20 wd-100p mg-t-20 ht-500"
                                                    id="totalizer" width="">
                                                </div>
                                            </div>


                                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- br-pagebody -->
        @push('js')
        <script src="{{asset('backend/js/reports/trends.js')}}"></script>
        <script src="{{asset('backend/js/sweetalert2@9.js')}}"></script>
        <script src="{{asset('backend/js/jspdf.js')}}"></script>
        <script src="{{asset('backend/js/dom-to-image.min.js')}}"></script>
        <script src="{{asset('backend/js/FileSaver.min.js')}}"></script>

        <script>
            // ----

            function downloadImage(el,name){
                    domtoimage.toBlob(document.getElementById(el))
                        .then(function (blob) {
                            window.saveAs(blob, name+'.png');
                        });
            }
            

            // ----


            showChart();

            function showChart() {
                let daterange = $('#daterange').val();
                let typeGraph = 'line';
                if (daterange == 'day' || daterange == 'minute') {
                    // $('.totalizer').removeClass('hilang');
                    date = $('#date').val()
                    typeGraph = 'line';
                } else if (daterange == 'month') {
                    date = $('#month').val()
                    typeGraph = 'bar';
                    // $('.totalizer').addClass('hilang');
                } else if (daterange == 'year') {
                    date = $('#year').val()
                    typeGraph = 'line';
                }
                axios.get(`{{url('/')}}` + '/api/sensors')
                    .then(async function (response) {
                        let sensors = response.data;
                        let allDataChart = await dataChart(daterange, date);
                        // console.log(alarm);
                        // console.log(allDataChart);
                        for (const key in sensors) {
                            let sensor = sensors[key];
                            if ($('#' + sensor.sensor_name).length) {
                                let alarm = filterAlarm(allDataChart.alarms, sensor.sensor_name)
                                chart(sensor.sensor_name, sensor.sensor_display, allDataChart.global.tstamp,
                                    allDataChart.sensors[sensor.sensor_name], alarm);
                                resizeChart(sensor.sensor_name);
                            }
                        }
                        // console.log(allDataChart.sensors['totalizer_tstamp'].tstamp);
                        chartTotalizer('totalizer', 'Totalizer', allDataChart.sensors['totalizer_tstamp']
                            .tstamp, allDataChart.sensors['totalizer'], [], typeGraph);

                        Swal.fire(
                            'Success',
                            'Data Loaded Successfully  !',
                            'success'
                        ).then((result) => {
                            // location.reload();
                        })
                    })
                    .catch(function (error) {
                        Swal.fire(
                            'Failed',
                            'Fail Load Chart !',
                            'warning'
                        ).then((result) => {
                            // location.reload();
                        })
                    });
            }

            function filterAlarm(alarms, sensor) {
                let fa = alarms.filter(function (alarm) {
                    return alarm.sensor == sensor;
                });
                const mapMarkline = fa.map((x) => {
                    let color;
                    if (x.formula === '>') {
                        color = '#BD362F';
                    } else if (x.formula === '>=') {
                        color = '#C2185B';
                    } else if (x.formula === '==') {
                        color = '#52D83A';
                    } else if (x.formula === '<') {
                        color = '#EAD239';
                    } else if (x.formula === '<=') {
                        color = '#E3892B';
                    } else {
                        color = '#B70B0B';
                    }


                    return {
                        name: x.text,
                        yAxis: x.sp,
                        show: true,
                        lineStyle: {
                            color: color,
                            type: 'dashed',
                        },
                    };
                });
                return mapMarkline;
            }


            async function dataChart(daterange, date) {
                const data = await axios.post(`{{url('/')}}` + '/api/trending', {
                    daterange: daterange,
                    date: date
                });
                console.log(data.data)
                return data.data;

            }


            var table = $('.datatable').DataTable();
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                startView: 2,
                minViewMode: 0,
                language: "id",
                daysOfWeekHighlighted: "0",
                autoclose: true,
                todayHighlight: true,
                toggleActive: true,
                container: '#datepicker-date-area'
            });

            $('.datepicker-month').datepicker({
                format: "yyyy-mm",
                startView: 2,
                minViewMode: 1,
                language: "id",
                daysOfWeekHighlighted: "0",
                autoclose: true,
                todayHighlight: true,
                toggleActive: true,
                container: '#datepicker-month-area'
            });

            $('.datepicker-year').datepicker({
                format: "yyyy",
                startView: 2,
                minViewMode: 2,
                language: "id",
                daysOfWeekHighlighted: "0",
                autoclose: true,
                todayHighlight: true,
                toggleActive: true,
                container: '.datepicker-area'
            });

            $('#daterange').on('change', function () {
                val = $(this).val();
                if (val == 'day') {
                    $('#datepicker-date-area').removeClass('hilang ');
                    const element = document.querySelector('#datepicker-date-area')
                    element.classList.add('animated', 'fadeIn')
                    // Hilangkan Month
                    $('#datepicker-month-area').addClass('hilang ');

                } else {
                    $('#datepicker-month-area').removeClass('hilang');
                    const element = document.querySelector('#datepicker-month-area')
                    element.classList.add('animated', 'fadeIn')
                    // Hilangkan Date
                    $('#datepicker-date-area').addClass('hilang ');

                }
            })

        </script>
        @endpush
        @include('layouts.partials.footer')
    </div><!-- br-mainpanel -->
    @endsection
