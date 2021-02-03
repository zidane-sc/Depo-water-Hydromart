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
                <img src="{{asset('backend/images/icon/database.png')}}" class="ht-50 " alt="">
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

                    <form action='{{url("settings/database/{$id}")}}' class="" method="post">
                        @csrf

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Database :</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" value="PostgreSQL 12" readonly>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Host DB :</label>
                                    <div class="input-group">

                                        <input type="text" readonly name="db_host" value="{{$db_host}}" class="form-control"
                                            placeholder="input host">

                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Logger Interval :</label>
                                    <div class="input-group">
                                        <input type="text" value="{{$db_log_interval}}" name="db_log_interval"
                                            class="form-control" placeholder="input interval">
                                        <div class="input-group-append">
                                            <span class="input-group-text">second</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h3>Backup</h3>

                                <div class="form-group">
                                    <label for="">Auto Backup:</label>
                                    <label for="">Path</label>
                                    <div class="input-group">
                                        <input type="text" name="path_backup" class="form-control" placeholder="{{storage_path('app/backup_csv')}}"
                                            value="{{$global_setting->path_backup}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <h3>Schedule</h3>
                                <div class="row row-sm">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Second :</label>
                                            <small>0-59</small>
                                            <div class="input-group">
                                                <input min='0' max="59" type="number" name="schedule_second" class="form-control" placeholder="*"
                                                    value="{{$global_setting->schedule_second}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Minute :</label>
                                            <small>0-59</small>
                                            <div class="input-group">
                                                <input  min='0' max="59" type="number" name="schedule_minute" class="form-control" placeholder="*"
                                                    value="{{$global_setting->schedule_minute}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Hour :</label>
                                            <small>0-23</small>

                                            <div class="input-group">
                                                <input  min='0' max="23" type="number" name="schedule_hour" class="form-control" placeholder="*"
                                                    value="{{$global_setting->schedule_hour}}">
                                            </div>
                                        </div>
                                    </div>
                                     
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row row-sm">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Day of Month :</label>
                                            <small>1-31</small>
                                            <div class="input-group">
                                                <input  min='1' max="31" type="number" name="schedule_day_of_month" class="form-control" placeholder="*"
                                                    value="{{$global_setting->schedule_day_of_month}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Month :</label>
                                            <small>1-12</small>
                                            <div class="input-group">
                                                <input  min='1' max="12" type="number" name="schedule_month" class="form-control" placeholder="*"
                                                    value="{{$global_setting->schedule_month}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            
                                            <label for="">Day of Week :</label>
                                            <small>0-7</small>
                                            <div class="input-group">
                                                <input  min='0' max="7" type="number" name="schedule_day_of_week" class="form-control" placeholder="*"
                                                    value="{{$global_setting->schedule_day_of_week}}">
                                            </div>
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
            <div class="col-lg-6">
                <div class="card royal rounded-20 pd-20 mg-t-10   shadow animated fadeInUp">
                    <form action="{{url('settings/database/backup')}}" method="post" class="">
                        <div class="row row-sm">
                            <form action="">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="form-group  " id="datepicker-date-area">
                                        <label for="">Backup Logs :</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">From</span>
                                            </div>
                                            <input type="text" name="date_from" id="date1" value="{{date('Y-m-d')}}"
                                                autocomplete="off" class="datepicker form-control time" required>


                                            <div class="input-group-append mg-l-10">
                                                <span class="input-group-text">To</span>
                                            </div>
                                            <input type="text" name="date_to" id="date2" value="{{date('Y-m-d')}}"
                                                autocomplete="off" class="datepicker form-control time  mg-r-10"
                                                required>
                                            <select name="type" class="form-control" id="">
                                                <option value="EXCEL">EXCEL</option>
                                                <option value="CSV">CSV</option>
                                                {{-- <option value="PDF">PDF</option> --}}
                                            </select>

                                        </div>
                                        <small>(Ph,Tss,Amonia,Cod,Flow Meter)</small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submimt" name="" data-toggle="tooltip" data-title="Sql"
                                            class="btn   btn-teal" id="update-controller">
                                            <i class="fas fa-database"></i> Backup
                                        </button>




                                    </div>

                                </div>
                            </form>
                            {{-- <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Backup Setting:</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control"
                                            value="Users, Departments, Setting , Etc" readonly>
                                        <button type="button" class="btn  btn-teal float-right mg-l-10"
                                            onclick="saveSetting()" data-toggle="tooltip" data-title="Sql"
                                            id="update-controller">
                                            <i class="fas fa-database"></i>
                                        </button>
                                    </div>
                                </div>

                            </div> --}}


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Reset/Delete Log Data:</label>
                                    <div class="input-group">


                                        <button type="button" class="btn  btn-danger float-right  "
                                            onclick="resetLogs()" data-toggle="tooltip" data-title="Sql"
                                            id="update-controller">
                                            <i class="fas fa-trash"></i> Reset All Data
                                        </button>
                                    </div>
                                    <small class="tx-danger">* Warning !!, This action will remove all sensor data
                                        permanently,Be Carefull !</small>
                                </div>

                            </div>
                        </div>
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



    // ====== RESET LOGS
    function resetLogs() {
        Swal.queue([{
            title: 'Are you sure?',
            text: "You will Remove all logs data ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!',
            showLoaderOnConfirm: true,
            preConfirm: () => {

                return axios.get(`{{url('/')}}` + '/api/database/reset')
                    .then(function (response) {

                        if (response.status == 200) {
                            Swal.fire(
                                'Success',
                                'Data Successfully Removed !',
                                'success'
                            ).then((result) => {
                                // location.reload();
                            })
                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Failed Reset',
                                text: 'Error',
                                confirmButtonColor: '#800050',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                // location.reload();
                            })
                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed Reset',
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
    function downloadBackup(type) {
        let dataPost = {};
        dataPost['date_from'] = $('#date1').val();
        dataPost['date_to'] = $('#date2').val();


        Swal.queue([{
            title: 'Are you sure?',
            text: "You will backup logs data ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Backup it!',
            showLoaderOnConfirm: true,
            preConfirm: () => {

                return axios.post(`{{url('/')}}` + '/api/database/backup', dataPost)
                    .then(function (response) {
                        console.log(response);
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        const fileName = `${+ new Date()}.xlsx` // whatever your file name .
                        link.setAttribute('download', fileName);
                        document.body.appendChild(link);
                        link.click();
                        link.remove(); // you need to remove that elelment which is created before.

                        if (response.status == 200) {
                            Swal.fire(
                                'Success',
                                'Sensor Successfully Updated !',
                                'success'
                            ).then((result) => {
                                // location.reload();
                            })
                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Failed Backup',
                                text: 'Error',
                                confirmButtonColor: '#800050',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                // location.reload();
                            })
                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed Backup',
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

</script>
@endpush
@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection
