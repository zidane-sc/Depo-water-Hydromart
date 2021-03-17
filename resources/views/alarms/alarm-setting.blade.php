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
                <img src="{{asset('backend/images/icon/alarm-setting.png')}}" class="ht-50 rounded-circle" alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>

        <div class=" text-white">
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card royal text-white rounded-20 pd-20 mg-t-10 shadow animated fadeInUpBig">

                        <div class="text-center  rounded-20 pd-10 text-white " style="width:100%;">

                            {{-- <img src="{{asset('backend/images/icon/setting.png')}}" class="ht-40 rounded-circle
                            float-left" alt="">
                            <span class="tx-bold mg-b-0 mg-t-10 mg-l-5  float-left"
                                style="text-shadow: -3px 2px 9px #0000;letter-spacing: 1px;">Alarm Setting
                            </span> --}}
                            <button onclick="addNew()" class="float-right btn btn-magenta btn-oblong mg-l-10">
                                <i class="ion ion-plus"></i>
                                Add New
                            </button>
                        </div>


                        {{-- <p class="hidden-sm-down" style="margin-top: -40px;">Tuesday ,21 April 2020</p> --}}



                        <div class="card-body">

                            <div class="table-responsive wd-100p">
                                <table class="table datatable ">
                                    <thead>
                                        <th>no</th>

                                        <th>SENSOR</th>
                                        <th>FORMULA</th>
                                        <th>SP</th>
                                        <th>TEXT</th>
                                        <th width="1%"></th>
                                    </thead>
                                    <tbody class="tx-black">
                                        @foreach ($alarm_settings as $alarm_setting)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$alarm_setting->sensor}}</td>
                                            <td>{{$alarm_setting->formula}}</td>
                                            <td>{{$alarm_setting->sp}}</td>
                                            <td>{{$alarm_setting->text}}</td>

                                            <td>
                                                <div class="d-flex">
                                                    <button
                                                        onclick="editAlarm({{$alarm_setting->id}},'{{$alarm_setting->sensor}}','{{$alarm_setting->formula}}','{{$alarm_setting->sp}}','{{$alarm_setting->text}}')"
                                                        data-toggle="tooltip" data-title="Edit"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="icon icon ion ion-edit"></i>
                                                    </button>
                                                    <button onclick="deleteAlarm({{$alarm_setting->id}})"
                                                        data-toggle="tooltip" data-title="Delete"
                                                        class="btn btn-sm btn-danger mg-l-5">
                                                        <i class="icon icon ion ion-ios-trash-outline"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- br-pagebody -->


@push('js')
<script src="{{asset('backend/js/sweetalert2@9.js')}}"></script>

<div class="modal animated fadeIn" id="addAlarmSetting" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content rounded-20 shadow">
            <div class="modal-header pd-10 tx-center">
                <span class=" tx-17 " id="exampleModalLongTitle">Add Alarm Setting </span>
                <button type="button" class=" btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="">
                    <div class="form-group">
                        <label for=""> Sensor :</label>
                        <select class="form-control wd-100p d-block select2-show-search"
                            data-placeholder="Choose one (with searchbox)" id="sensor">
                            @foreach ($sensors as $sensor)
                            <option value="{{$sensor->sensor_name}}"> {{$sensor->sensor_display}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-control " id="sensor-tag" name="" value="" > --}}
                    </div>
                    <div class="form-group">
                        <label for=""> Formula :</label>
                        <select class="form-control wd-100p d-block select2-show-search"
                            data-placeholder="Choose one (with searchbox)" id="formula">
                            <option value="==">==</option>
                            <option value=">">></option>
                            <option value=">=">>=</option>
                            <option value="<">
                                <</option> <option value="<=">
                                    <=</option> </select>
                                        {{-- <input type="text" class="form-control " id="sensor-tag" name="" value="" > --}}
                                        </div> <div class="form-group">
                                        <label for="">Set Point :</label>
                                        <input type="number" step="0.01" class="form-control " id="set-point" name=""
                                            value="">
                    </div>
                    <div class="form-group">
                        <label for="">Text :</label>
                        <textarea name="" class="form-control" id="text" cols="30" rows="4"></textarea>
                    </div>
                    <button type="button" class="btn  btn-magenta float-right " id="save-setting">SAVE SETTING</button>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal animated fadeIn" id="editAlarmSetting" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content rounded-20 shadow">
            <div class="modal-header pd-10 tx-center">
                <span class=" tx-17 " id="exampleModalLongTitle">Edit Alarm Setting </span>
                <button type="button" class=" btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="">
                    <div class="form-group">
                        <input type="hidden" id="idEdit" value="">
                        <label for=""> Sensor :</label>
                        <select class="form-control wd-100p d-block select2-show-search"
                            data-placeholder="Choose one (with searchbox)" id="sensorEdit">
                            @foreach ($sensors as $sensor)
                            <option value="{{$sensor->sensor_name}}"> {{$sensor->sensor_display}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-control " id="sensor-tag" name="" value="" > --}}
                    </div>
                    <div class="form-group">
                        <label for=""> Formula :</label>
                        <select class="form-control wd-100p d-block select2-show-search"
                            data-placeholder="Choose one (with searchbox)" id="formulaEdit">
                            <option value="==">==</option>
                            <option value=">">></option>
                            <option value=">=">>=</option>
                            <option value="<">
                                <</option> <option value="<=">
                                    <=</option> </select>
                                        {{-- <input type="text" class="form-control " id="sensor-tag" name="" value="" > --}}
                                        </div> <div class="form-group">
                                        <label for="">Set Point :</label>
                                        <input type="number" step="0.01" class="form-control " id="set-pointEdit"
                                            name="" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Text :</label>
                        <textarea name="" class="form-control" id="textEdit" cols="30" rows="4"></textarea>
                    </div>
                    <button type="button" class="btn  btn-magenta float-right " id="update-setting">SAVE
                        SETTING</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function addNew() {
        $('#addAlarmSetting').modal('toggle');
        $("#sensor").select2({
            dropdownParent: $("#addAlarmSetting"),
        });
        $("#formula").select2({
            dropdownParent: $("#addAlarmSetting"),
        });
    }

    // ====== ADD ALARM
    $('#save-setting').on('click', () => {
        let dataSetting = {};
        dataSetting['sensor'] = $('#sensor').val();
        dataSetting['formula'] = $('#formula').val();
        dataSetting['sp'] = $('#set-point').val();
        dataSetting['text'] = $('#text').val();

        axios.post(`{{url('/')}}` + '/api/alarm-setting', dataSetting)
            .then(function (response) {
                if (response.data.status == 200) {
                    $('#addAlarmSetting').modal('toggle');
                    Swal.fire(
                        'Success',
                        'Alarm Successfully Added !',
                        'success'
                    ).then(() => {
                        location.reload();
                    })
                } else {
                    let errorMessage = JSON.parse(response.data.msg);
                    let msg = '';
                    for (const key in errorMessage) {
                        msg += '<span class="d-block tx-danger mg-b-10">' + errorMessage[key][0] +
                            '</span class="d-block tx-danger">';
                    }
                    $.alert({
                        title: 'Error',
                        content: msg,
                    });
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    })

    // ====== DELETE ALARM
    function deleteAlarm(id) {

        Swal.queue([{
            title: 'Are you sure?',
            text: "You will delete alarm setting ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!',
            showLoaderOnConfirm: true,
            preConfirm: (event) => {
                console.log(event);
                return axios.delete(`{{url('/')}}` + '/api/alarm-setting/' + id)
                    .then(function (response) {
                        if (response.data.status == 200) {
                            Swal.fire(
                                'Success',
                                'Alarm Successfully Deleted !',
                                'success'
                            ).then(() => {
                                location.reload();
                            })
                        } else {
                            Swal.fire(
                                'Failed !',
                                'Deleted failed :.' + response.data.msg,
                                'warning'
                            )
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

    // ====== EDIT ALARM
    function editAlarm(id, sensor, formula, setPoint, text) {


        $('#editAlarmSetting').modal('toggle');

        $('#idEdit').val(id);
        $('#sensorEdit').val(sensor);
        $("#sensorEdit").select2({
            dropdownParent: $("#editAlarmSetting"),
        });

        $('#formulaEdit').val(formula);
        $("#formulaEdit").select2({
            dropdownParent: $("#editAlarmSetting"),
        });

        $('#set-pointEdit').val(setPoint);
        $('#textEdit').val(text);

        //-----
        let dataSetting = {};
        dataSetting['sensor']   = sensor;
        dataSetting['formula']  = formula;
        dataSetting['sp']       = setPoint;
        dataSetting['text']     = text;

        


    }


    // ====== UPDATE ALARM
    $('#update-setting').on('click', () => {
        let dataSetting = {};
        let id = $('#idEdit').val();
        dataSetting['sensor'] = $('#sensorEdit').val();
        dataSetting['formula'] = $('#formulaEdit').val();
        dataSetting['sp'] = $('#set-pointEdit').val();
        dataSetting['text'] = $('#textEdit').val();

        axios.put(`{{url('/')}}` + '/api/alarm-setting/'+id, dataSetting)
            .then(function (response) {
                if (response.data.status == 200) {
                    $('#editAlarmSetting').modal('toggle');
                    Swal.fire(
                        'Success',
                        'Alarm Successfully Updated !',
                        'success'
                    ).then(() => {
                        location.reload();
                    })
                } else {
                    let errorMessage = JSON.parse(response.data.msg);
                    let msg = '';
                    for (const key in errorMessage) {
                        msg += '<span class="d-block tx-danger mg-b-10">' + errorMessage[key][0] +
                            '</span class="d-block tx-danger">';
                    }
                    $.alert({
                        title: 'Error',
                        content: msg,
                    });
                }
            })
            .catch(function (error) {
                console.log(error);
            });

    })

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
