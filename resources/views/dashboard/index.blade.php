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

    .wrapper {
        background-color: #2d4e5a;
        height: 250px;
        width: 200px;
        position: relative;
    }

    /* .wrapper2 {
  background-color: #2d4e5a;
  height: 200px;
  width: 200px;
  position: relative;
} */

</style>
@endsection

@section('content')
<div class="br-mainpanel">
    <div class="br-pagebody">
        <div class="bg-crystal-clear text-white rounded-20 pd-20 mg-t-50 animated fadeInUp ">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-200 animated fadeInDown"
                style="margin-top: -40px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/dashboard/monitoring.png')}}" class="ht-50 rounded-circle" alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
                {{-- <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
                    <div class="d-flex  bg-white rounded-20 ht-100p col-lg-12 pd-10 tx-black shadow animated fadeIn"
                        style="   ">
                        <img src="{{asset('backend/images/icon/gateway-2.png')}}" class="ht-70 mg-r-20" alt="">
                        <table>
                            <tr class="ht-70">
                                <td class="wd-180">
                                    <h5 class="mg-b-0  mg-l-10 tx-20 " style="  letter-spacing: 1px;">Socket Status :
                                        <div id="socket-status" class="tx-left  mg-t-5">
                                        </div>
                                    </h5>
                                </td>
                                <!-- <td>
                                    <h5 class="mg-b-0  mg-l-10 tx-20 " style="   letter-spacing: 1px;">Device Status : <span
                                            class="tx-15"></span>
                                        <div id="device-status" class="tx-left  mg-t-5">
                                        </div>
                                    </h5>
                                </td> -->


                            </tr>
                            <tr>
                            </tr>
                        </table>
                    </div>
                </div> --}}
                <div class="col-md-8  mg-t-30">
                    <div class="d-flex  bg-white rounded-20 ht-100p col-lg-12 pd-10 tx-black shadow animated fadeIn"
                        style="   ">
                        <img src="{{asset('backend/images/icon/gateway-2.png')}}" class="ht-70 mg-r-20" alt="">
                        <table>
                            <tr class="ht-70">

                                <td>
                                    <h5 class="mg-b-0  mg-l-10 tx-20 " style="   letter-spacing: 1px;">Status  Perangkat:
                                        <div id="device-status" class="tx-left  mg-t-5 tx-15">
                                        </div>
                                    </h5>
                                </td>


                            </tr>
                            <tr>

                            </tr>
                        </table>
                    </div>

                </div>
                <div class="col-md-4  mg-t-30">
                    <div class="d-flex  bg-white rounded-20 ht-100p col-lg-12 pd-10 tx-black shadow animated fadeIn"
                        style="   ">
                        <i class="fa fa-clock fa-4x mg-t-7 mg-r-20"></i>
                        <table>
                            <tr class="ht-70">

                                <td>
                                    <h5 class="mg-b-0  mg-l-10 tx-20 " style="   letter-spacing: 1px;">Tanggal & Waktu :
                                        <div class=" tx-left  mg-t-5 tx-15 text-success" id="tstamp">
                                        </div>
                                    </h5>
                                </td>

                            </tr>
                            <tr>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
            <div class="row row-sm">
                {{-- @foreach ($sensors as $sensor)
                <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
                    <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
                        <div class="card-body">
                            <span class="tx-bold tx-20  d-block  tx-inverse ">{{$sensor->sensor_display}}</span>
                <div class="d-block tx-center">
                    <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital"
                        id="{{$sensor->sensor_name}}">-</span> <span class="tx-black">{{$sensor->unit}}</span>
                </div>
            </div><!-- card-body -->
        </div><!-- card -->
    </div>
    @endforeach --}}
    {{-- <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30 ">
                    <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
                        <div class="card-body">
                            <span class="tx-bold tx-20  d-block  tx-inverse ">TDS</span>
                            <div class="d-block tx-center">
                                <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital"
                                    id="TDS">-</span> <span class="tx-black">m3</span>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div> --}}
    {{-- <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30 ">
                    <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
                        <div class="card-body">
                            <span class="tx-bold tx-20  d-block  tx-inverse ">Totalizer</span>
                            <div class="d-block tx-center">
                                <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital"
                                    id="totalizer">-</span> <span class="tx-black">m3</span>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div> --}}


    <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
        <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
            <div class="card-body">
                <span class="tx-bold tx-20  d-block  tx-inverse ">TANK 1</span>
                <div class="d-block tx-center">
                    <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital" id="level_tank_1">-</span>
                    <span class="tx-black">Liter</span>
                </div>
            </div><!-- card-body -->
        </div><!-- card -->
    </div>
    <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
        <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
            <div class="card-body">
                <span class="tx-bold tx-20  d-block  tx-inverse ">TANK 2</span>
                <div class="d-block tx-center">
                    <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital" id="level_tank_2">-</span>
                    <span class="tx-black">Liter</span>
                </div>
            </div><!-- card-body -->
        </div><!-- card -->
    </div>
    <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
        <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
            <div class="card-body">
                <span class="tx-bold tx-20  d-block  tx-inverse ">TINGKAT ALIRAN</span>
                <div class="d-block tx-center">
                    <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital" id="flow_rate">-</span>
                    <span class="tx-black">L/mnt</span>
                </div>
            </div><!-- card-body -->
        </div><!-- card -->
    </div>
    <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
        <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
            <div class="card-body">
                <span class="tx-bold tx-20  d-block  tx-inverse ">KONSUMSI AIR</span>
                <div class="d-block tx-center">
                    <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital" id="totalizer">-</span>
                    <span class="tx-black">Liter</span>
                </div>
            </div><!-- card-body -->
        </div><!-- card -->
    </div>
    <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
        <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
            <div class="card-body">
                <span class="tx-bold tx-20  d-block  tx-inverse ">TOTAL GALLON</span>
                <div class="d-block tx-center">
                    <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital" id="total_gallons">-</span>
                    <span class="tx-black">Gallon</span>
                </div>
            </div><!-- card-body -->
        </div><!-- card -->
    </div>
    {{-- <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30 ">
        <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
            <div class="card-header tx-center tx-medium bg-grandeur stx-17" style=" border-radius: 20px 20px 0px 0px;">
                <span class="tx-center tx-18 tx-bold tx-digital">Support by</span>
            </div>
            <div class="card-body">
                <div class="d-block tx-center">

                     <img src="{{asset('backend/images/logo/goiot-logo.png')}}" alt="" class=" img-fluid wd-80p">
                </div>
            </div><!-- card-body -->
        </div><!-- card -->
    </div> --}}
</div>
</div>


{{-- -------------------------------------------------------------------------------------------------------------------------------- --}}

<div class="bg-crystal-clear text-white rounded-20 pd-20 mg-t-50 animated fadeInUp hilang ">
    <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-200 animated fadeInDown mx-auto d-block"
        style="margin-top: -50px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
        <img src="{{asset('backend/images/dashboard/monitoring.png')}}" class="ht-50 rounded-circle" alt="">
        <h4 class="mg-b-0 mg-t-10 mg-l-10" style="   letter-spacing: 1px;">{{$page_title2}}</h4>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-xs-12 col-sm-12 mg-t-30">
            <div class="row row-sm">
                <div class="col-lg-12 col-xs-12 col-sm-12  mg-t-30">
                    <div id="wrapper" class="wrapper mx-auto">
                    </div>
                </div>
                {{-- <div class="col-lg-6 col-xs-12 col-sm-12  mg-t-30">
                            <div id="wrapper" class="wrapper">
                            </div>
                        </div> --}}
            </div>
        </div>
    </div>

</div>




</div>


</div>
</div>







</div><!-- br-pagebody -->


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.3/d3.js"></script>
<script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
<!-- <script src="{{asset('backend/js/water-tank/water-tank.js')}}"></script> -->


<script>
    $('#socket-status').html(
        `<span class="float-right wd-100p tx-16 text-danger mg-l-10 animated fadeIn">Socket Offline<span class="square-8 bg-danger rounded-circle"></span> </span>`
    )

    $('#device-status').html(
        `<span class="float-right wd-100p tx-16 text-danger mg-l-10 animated fadeIn">Device Offline<span class="square-8 bg-danger rounded-circle"></span> </span>`
    )
    $('#tstamp').html(
        `<span class="float-right wd-100p tx-16 text-danger mg-l-10 animated fadeIn">Offline<span class="square-8 bg-danger rounded-circle"></span> </span>`
    )
    var isConnect = false;
    socket.on('air-depo', (data) => {
        console.log(data)
        isConnect = true;
        $('#device-status').html(
            `<span class="float-right wd-100p tx-16 text-success mg-l-10 ">Online<span class="square-8 bg-success rounded-circle"></span> </span>`
        )

        $('#tstamp').html(
            `<span class="float-right wd-100p tx-16 text-danger mg-l-10 animated fadeIn">Offline<span class="square-8 bg-danger rounded-circle"></span> </span>`
        )

        function pad2(n) { return n < 10 ? '0' + n : n }

        var date = new Date();

        $('#tstamp').text(date.getFullYear().toString() +'-'+ pad2(date.getMonth() + 1) +'-'+ pad2( date.getDate()) +' '+ pad2( date.getHours() ) +':'+ pad2( date.getMinutes() ) +':'+ pad2( date.getSeconds() ))
        if (data.tag_name === 'ultrasonic_sensor11') {
            $('#level_tank_1').text(fix_val(data.value, 0))
        } else if (data.tag_name === 'ultrasonic_sensor12') {
            $('#level_tank_2').text(fix_val(data.value, 0))
        } else if (data.tag_name === 'liter_permenit1') {
            $('#flow_rate').text(fix_val(data.value, 0))
        } else if (data.tag_name === 'totalizer'){
            $('#totalizer').text(fix_val(data.value, 0))
            $('#total_gallons').text(Math.floor(data.value / {{ $global_setting->gallon }}))

        }
		console.log(data.tag_name);
        // let totalizer;
        // totalizer = (data.flow_meter / 3600) * 10;
        // $('#totalizer').text(fix_val(totalizer , 1))
    });

    socket.on('connect', (socket) => {
        setTimeout(() => {
            if (!isConnect) {
                $('#device-status').html(
                    `<span class="float-right animated fadeIn wd-100p tx-16 text-danger mg-l-10 animated fadeIn">Offline<span class="square-8 bg-danger rounded-circle"></span> </span>`
                )
            }
        }, 2000);
    });

    socket.on("disconnect", function () {
        isConnect = false;
        $('#socket-status').html(
            `<span class="float-right animated fadeIn wd-100p tx-16 text-danger mg-l-10">Socket Offline<span class="square-8 bg-danger rounded-circle"></span> </span>`
        )
        // console.log("Socket server disconnected");

    });


    socket.on('eh-gateway-status', (data) => {
        // console.log(data.status);
        if (data.status === 'socket-connect') {
            $('#socket-status').html(
                `<span class="float-right wd-100p tx-16 text-success mg-l-10  ">Online<span class="square-8 animated fadeIn bg-success rounded-circle"></span> </span>`
            )
            $('tstamp').html(
                `<span class="float-right wd-100p tx-16 text-success mg-l-10  ">Online<span class="square-8 animated fadeIn bg-success rounded-circle"></span> </span>`
            )
        }

        if (data.status === 'socket-disconnect') {
            $('#socket-status').html(
                `<span class="float-right wd-100p tx-16 text-danger mg-l-10  ">Gateway Offline<span class="square-8 animated fadeIn bg-danger rounded-circle"></span> </span>`
            )
            $('#tstamp').html(
                `<span class="float-right wd-100p tx-16 text-danger mg-l-10  ">Offline<span class="square-8 animated fadeIn bg-danger rounded-circle"></span> </span>`
            )
        }

        if (data.status === 'device-connect') {
            $('#device-status').html(
                `<span class="float-right wd-100p tx-16 text-success mg-l-10 ">Online<span class="square-8 bg-success animated fadeIn rounded-circle"></span> </span>`
            )
        }

        if (data.status === 'device-disconnect') {
            $('#device-status').html(
                `<span class="float-right wd-100p tx-16 text-danger mg-l-10  ">Device Offline<span class="square-8 animated fadeIn bg-danger rounded-circle"></span> </span>`
            )
        }


    });

    function fix_val(val, del = 2) {
         val = parseInt(val)
        if (val != undefined || val != null) {
            var rounded = val.toFixed(del).toString().replace('.', ","); // Round Number
            return numberWithCommas(rounded); // Output Result
        }

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }


    // --- Totalizer
    let interval = '{{$global_setting->db_log_interval}}' * 10000;



</script>
@endpush
@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection
