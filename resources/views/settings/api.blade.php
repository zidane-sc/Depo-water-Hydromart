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

    .br-mailbox-list {
        position: inherit;
        top: 0px;
        bottom: 0;
        left: 0px;
        width: 100%;
        background-color: #fff;
        z-index: 100;
        border-right: 1px solid #ced4da;
        transition: all 0.2s ease-in-out;
    }

    .select2-container {
        width: 100% !important;
        padding: 0;
    }


    /* ======== */

</style>
@endsection
@section('content')

<div class="br-mainpanel">


    <div class="br-pagebody">

        <div class=" text-white rounded-20 pd-t-20 mg-t-50 mg-b-30">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-300 animated fadeInLeft"
                style="margin-top: -40px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/icon/api-setting.png')}}" class="ht-50 " alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>

        </div>

        <div class="row row-sm">
            <div class="col-lg-6">
                @if(session()->has('create'))
                <div class="alert alert-success alert-bordered rounded-20 shadow shadow animated fadeInLeft">
                    {{ session()->get('create') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card royal rounded-20 pd-20 mg-t-10   shadow animated fadeInUp">

                    <form action='{{url("settings/api-config/{$api_setting->id}")}}' class="" method="post">
                        @csrf

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Server Url KLH :</label>
                                    <div class="input-group">
                                        {{-- <div class="input-group-append">
                                            <span class="input-group-text">http://</span>
                                        </div> --}}
                                        <input type="text" class="form-control" placeholder="input server url"
                                            name="server_url" value="{{$api_setting->server_url}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">UID :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="input uid"
                                            name="uid" value="{{$api_setting->uid}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">JWT SECRET API :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="input jwt secret"
                                            name="jwt_secret" value="{{$api_setting->jwt_secret}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Send Interval :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="input interval"
                                            name="send_interval"
                                            value="{{$api_setting->send_interval}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Second</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn  btn-magenta float-right mg-l-10" id="update-controller">UPDATE
                            SETTING</button>
                        <button type="button" class=" btn mg-b-10 float-right  btn-warning shadow "
                            onclick="restartGateway()" data-toggle="tooltip" data-placement="bottom"
                            title="Restart Gateway">
                            <i class="ion ion-loop tx-18 "></i>
                        </button>



                    </form>



                </div>
            </div>
        </div>

    </div>
</div>



</div><!-- br-pagebody -->

@push('js')
<div class="modal animated fadeIn" id="setting-sensor" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content rounded-20 shadow">
            <div class="modal-header pd-10 tx-center">
                <span class=" tx-17 " id="exampleModalLongTitle">Setting Sensor </span>
                <button type="button" class=" btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formCreateController">
                    <input type="hidden" class="form-control " id="sensor-id" name="" value="" readonly>
                    <div class="form-group">
                        <label for=""> Sensor Name :</label>
                        <input type="text" class="form-control " id="sensor-name" name="" value="" readonly>
                    </div>

                    <div class="form-group">
                        <label for=""> Sensor Display :</label>
                        <input type="text" class="form-control " id="sensor-display" name="" value="">
                    </div>


                    <div class="form-group">
                        <label for=""> Tag :</label>

                        <select class="form-control wd-100p d-block select2-show-search"
                            data-placeholder="Choose one (with searchbox)" id="sensor-tag">


                        </select>
                    </div>



                    <div class="form-group">
                        <label for=""> Sensor Status :</label>
                        <select class="selectpicker form-control" id="sensor-status" name="">
                            <option value="1">ENABLE</option>
                            <option value="0">DISABLE</option>
                        </select>
                    </div>

                    <button type="button" class="btn  btn-magenta float-right " onclick="saveSetting()"
                        id="update-controller">UPDATE
                        SETTING</button>


                </form>
            </div>

        </div>
    </div>
</div>

<script src="{{asset('backend/js/sweetalert2@9.js')}}"></script>

<script>
    $('#table-sensor').dataTable();

    // ====== SETTING SENSOR
    function settingSensor(sensor) {
        $('#setting-sensor').modal('toggle');
        $('#sensor-id').val(sensor.id);
        $('#sensor-name').val(sensor.sensor_name);
        $('#sensor-display').val(sensor.sensor_display);
        $('#sensor-tag').val(sensor.tag_id);
        $("#sensor-tag").select2({
            dropdownParent: $("#setting-sensor"),
        });
        $('#sensor-status').selectpicker("val", sensor.sensor_status);


    }
    // ====== SAVE SETTING
    function saveSetting() {
        $('#setting-sensor').modal('toggle');
        let id = $('#sensor-id').val();
        let sensorData = {};
        sensorData['sensor_display'] = $('#sensor-display').val();
        sensorData['tag_id'] = $('#sensor-tag').val();
        sensorData['sensor_status'] = $('#sensor-status').val();
        Swal.queue([{
            title: 'Are you sure?',
            text: "You will update sensor setting ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save it!',
            showLoaderOnConfirm: true,
            preConfirm: () => {

                return axios.put(`{{url('/')}}` + '/api/sensor/' + id, sensorData)
                    .then(function (response) {
                        if (response.data.status == 200) {
                            Swal.fire(
                                'Success',
                                'Sensor Successfully Updated !',
                                'success'
                            ).then((result) => {
                                location.reload();
                            })
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
        }])
    }


    // ====== RESTART GATEWAY

    function restartGateway() {
        Swal.queue([{
            title: 'Are you sure?',
            text: "You will restart all Gateway ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Restart it!',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return axios.get('http://{{$global_setting->host_ip}}:3000/restart')
                    .then(function (response) {
                        if (response.data.status == 200) {
                            Swal.fire(
                                'Success Restarted',
                                response.data.msg,
                                'success'
                            ).then((result) => {
                                // location.reload();
                            })
                        } else {
                            Swal.fire(
                                'Failed',
                                response.data.msg,
                                'warning'
                            ).then((result) => {
                                // location.reload();
                            })

                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Connect',
                            text: "Gateway/Socket Error !",
                            confirmButtonColor: '#800050',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            // location.reload();
                        })
                    });
            }
        }])
    }

</script>
@endpush
@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection
