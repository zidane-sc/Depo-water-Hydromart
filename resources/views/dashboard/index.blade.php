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
                <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
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
                    
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
                    <div class="d-flex  bg-white rounded-20 ht-100p col-lg-12 pd-10 tx-black shadow animated fadeIn"
                        style="   ">
                        <img src="{{asset('backend/images/icon/gateway-2.png')}}" class="ht-70 mg-r-20" alt="">
                        <table>
                            <tr class="ht-70">
                               
                                <td>
                                    <h5 class="mg-b-0  mg-l-10 tx-20 " style="   letter-spacing: 1px;">Device Status : 
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
                <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
                    <div class="d-flex  bg-white rounded-20 ht-100p col-lg-12 pd-10 tx-black shadow animated fadeIn"
                        style="   ">
                        <i class="fa fa-clock fa-4x mg-t-7 mg-r-20"></i> 
                        <table>
                            <tr class="ht-70">
                                
                                <td>
                                    <h5 class="mg-b-0  mg-l-10 tx-20 " style="   letter-spacing: 1px;">Datetime : 
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
                @foreach ($sensors as $sensor)
                <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30">
                    <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
                        <div class="card-body">
                            <span class="tx-bold tx-20  d-block  tx-inverse ">{{$sensor->sensor_display}}</span>
                            <div class="d-block tx-center">
                                <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital"
                                    id="{{$sensor->sensor_name}}">-</span> <span
                                    class="tx-black">{{$sensor->unit}}</span>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div>
                @endforeach
                <div class="col-lg-4 col-xs-12 col-sm-12  mg-t-30 ">
                    <div class="card shadow-base card__one bd-0 ht-100p rounded-20  animated fadeIn">
                        <div class="card-body">
                            <span class="tx-bold tx-20  d-block  tx-inverse ">Totalizer</span>
                            <div class="d-block tx-center">
                                <span class="tx-center tx-50 tx-bold   tx-gray-800 hover-info tx-digital"
                                    id="totalizer">-</span> <span class="tx-black">m3</span>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div>

            </div>
        </div>




    </div>


</div>
</div>







</div><!-- br-pagebody -->


@push('js')

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
    socket.on('eh-water', (data) => {
        isConnect = true;
        $('#device-status').html(
            `<span class="float-right wd-100p tx-16 text-success mg-l-10 ">Online<span class="square-8 bg-success rounded-circle"></span> </span>`
        )
        $('#tstamp').text(data.tstamp)
        $('#ph').text(fix_val(data.ph, 2))
        $('#tss').text(fix_val(data.tss, 1))
        $('#amonia').text(fix_val(data.amonia, 2))
        $('#cod').text(fix_val(data.cod, 1))
        $('#flow_meter').text(fix_val(data.flow_meter, 2))

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
        if (val != undefined || val != null) {
            var rounded = val.toFixed(del).toString().replace('.', ","); // Round Number
            return numberWithCommas(rounded); // Output Result
        }

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }


    // --- Totalizer
    let interval  = '{{$global_setting->db_log_interval}}'*10000;
    readTotalizer();
    setInterval(() => {
        readTotalizer();
    }, interval);
    
    function readTotalizer() {
        axios.get(`{{url('/')}}` + '/api/totalizer')
            .then(function (response) {
                if (response.data.status == 200) {
                     $('#totalizer').text(response.data.msg.totalizer)
                } else {
                    let errorMessage = JSON.parse(response.data.msg);
                    let msg = '';
                    for (const key in errorMessage) {
                        msg += '<span class="d-block tx-danger mg-b-10">' + errorMessage[
                                key][0] +
                            '</span class="d-block tx-danger">';
                    }
                    $.alert({
                        title: 'Error',
                        content: msg,
                    });
                }
            })
            .catch(function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed Update',
                    text: error,
                    confirmButtonColor: '#800050',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    // location.reload();
                })
            });
    }

</script>
@endpush
@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection
