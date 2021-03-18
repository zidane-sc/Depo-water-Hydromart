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

</style>
@endsection
@section('content')

<div class="br-mainpanel">


    <div class="br-pagebody">

        <div class=" text-white rounded-20 pd-t-20 mg-t-50 mg-b-30">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-300 animated fadeInLeft"
                style="margin-top: -40px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/icon/gateway.png')}}" class="ht-50 " alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>

        

        <div class="row row-sm">
            <div class="col-lg-4">

                <div class="card  text-white rounded-20 pd-20 mg-t-10   shadow animated fadeIn">
                    {{-- <div class="text-center d-flex  bg-grandeur rounded-20 pd-10 text-white shadow"
                        style="width:fit-content;margin-top: -40px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                        <img src="{{asset('backend/images/icon/list-2.png')}}" class="ht-40 rounded-circle" alt="">
                    <span class="tx-bold mg-b-0 mg-t-10 mg-l-5 "
                        style="text-shadow: -3px 2px 9px #0000;letter-spacing: 1px;">List Controllers
                    </span>
                </div> --}}

                <div class="card-body">

                    <button class=" btn mg-b-10   btn-oblong btn-success btn-oblong shadow" data-toggle="modal"
                        data-target="#addController">
                        <i class="ion ion-plus-round"></i>
                        CREATE CONTROLLER</button>
                    <button class=" btn mg-b-10 float-right  btn-warning shadow" onclick="restartGateway()"
                        data-toggle="tooltip" data-placement="bottom" title="Restart Gateway">
                        <i class="ion ion-loop tx-18 "></i>
                    </button>



                    <ul class="list-group devices list-group-striped tx-black">
                        <div class="overlay-ajax" style="text-align:center">
                            <i class="tx-black   fa fa-spinner fa-spin spin-big"></i>
                        </div>
                    </ul>

                </div>

            </div>
        </div>
        <div class="col-lg-8">
            <div class="card royal rounded-20 pd-20 mg-t-10   shadow animated fadeInUp">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="status-tab" data-toggle="tab" href="#status" role="tab"
                            aria-controls="status" aria-selected="false">Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tags-tab" data-toggle="tab" href="#tags" role="tab" aria-controls="tags"
                            aria-selected="false">Tags</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane pd-20 fade show active" id="status" role="tabpanel"
                        aria-labelledby="status-tab">

                        <ul class="list-group list-group-striped">
                            <li class="list-group-item rounded-top-0">
                                <p class="mg-b-0"> <strong class="tx-inverse tx-medium">Controller Name : </strong>
                                    <span
                                        class="text-muted">{{ isset($device->controller_name) ? $device->controller_name : '' }}</span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="mg-b-0"> <strong class="tx-inverse tx-medium">TYPE :</strong> <span
                                        class="text-muted">{{ isset($device->controller_type) ? $device->controller_type : '' }}</span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="mg-b-0"> <strong class="tx-inverse tx-medium">IP :</strong> <span
                                        class="text-muted">{{ isset($device->controller_host) ? $device->controller_host : '' }}</span>
                                </p>
                            </li>

                            <li class="list-group-item">
                                <p class="mg-b-0"> <strong class="tx-inverse tx-medium">PORT :</strong> <span
                                        class="text-muted">{{ isset($device->controller_port) ? $device->controller_port : '' }}</span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="mg-b-0"> <strong class="tx-inverse tx-medium">DEVICE ID :</strong> <span
                                        class="text-muted">{{ isset($device->controller_device_id) ? $device->controller_device_id : '' }}</span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="mg-b-0">
                                    @if (isset($device->controller_status) ? $device->controller_status: '0')
                                    <strong class="tx-inverse tx-medium">STATUS :</strong> <span
                                        class="badge badge-success">ENABLED</span>
                                    @else
                                    <strong class="tx-inverse tx-medium">STATUS :</strong> <span
                                        class="badge badge-danger">DISABLED</span>
                                    @endif

                                </p>
                            </li>


                        </ul>

                        <button
                            onclick="testConnection('{{ isset($device->controller_host) ? $device->controller_host : '' }}','{{ isset($device->controller_port) ? $device->controller_port : '' }}','{{ isset($device->controller_deviceId) ? $device->controller_deviceId : '' }}')"
                            class="btn mg-t-10 btn-info">
                            <i class="ion ion-android-wifi"></i>
                            TEST CONNECTION</button>
                        <button class="btn mg-t-10 btn-warning" data-toggle="modal"
                            onclick="editController({{ isset($device->id) ? $device->id : '' }})"
                            data-target="#editController">
                            <i class="fa fa-edit"></i>
                            EDIT</button>

                        <button class="btn mg-t-10 btn-danger"
                            onclick="deleteController({{ isset($device->id) ? $device->id : '' }})">
                            <i class="fa fa-trash"></i>
                            DELETE</button>
                    </div>
                    <div class="tab-pane fade pd-20 " id="tags" role="tabpanel" aria-labelledby="tags-tab">
                        <button class="float-right btn mg-b-10 btn-sm btn-success" data-toggle="modal"
                            data-target="#addTag">
                            <i class="fa fa-plus"></i>
                            ADD TAG</button>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <th>No</th>
                                    <th>TagName</th>
                                    <th>data type</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @php
                                    $no=1;
                                    @endphp
                                    @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$tag->tag_name}}</td>
                                        <td>{{$tag->tag_data_type}}</td>
                                        <td>{{$tag->tag_address}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info"
                                                onclick="testAddress('{{$tag->tag_name}}','{{$tag->tag_data_type}}','{{$tag->tag_address}}')">Address
                                                Check</button>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#editTag"
                                                onclick="editTag('{{$tag->id}}','{{$tag->tag_name}}','{{$tag->tag_data_type}}','{{$tag->tag_address}}')">Edit</button>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteTag({{$tag->id}})">Delete</button>
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



</div><!-- br-pagebody -->

@push('js')

<div class="modal animated fadeIn" id="editController" tabindex="-1" role="dialog" aria-labelledby=""
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content rounded-20 shadow">
            <div class="modal-header pd-10 tx-center">
                <span class=" tx-17 " id="exampleModalLongTitle">Edit Controller </span>
                <button type="button" class=" btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formCreateController">
                    <div class="form-group">
                        <label for=""> NAME :</label>
                        <input type="text" class="form-control " id="editControllername" name="" value="">
                    </div>
                    <div class="form-group">
                        <label for=""> Type :</label>
                        <select class="selectpicker form-control" id="editControllertype" name=""
                            title="{{ isset($device->controller_type) ? $device->controller_type :'' }}">
                            <option value="TCP/IP">TCP/IP</option>
                            <option value="SERIAL">SERIAL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">HOST/IP :</label>
                        <input type="text" class="form-control " id="editControllerhost" name="" value="">
                    </div>
                    <div class="form-group">
                        <label for="">PORT :</label>
                        <input type="text" class="form-control " id="editControllerport" name="" value="">
                    </div>

                    <div class="form-group">
                        <label for="">DEVICE ID :</label>
                        <input type="text" class="form-control " id="editControllerdeviceid" name="controller_device_id"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="">STATUS :</label>
                        <select class="selectpicker form-control"
                            title="{{ !isset($device->controller_status) ? 'DISABLED' :   ($device->controller_status ? '' :'') }}"
                            id="editControllerstatus" name="controller_status">
                            <option value="1">ENABLE</option>
                            <option value="0">DISABLE</option>
                        </select>
                    </div>

                    <button type="button" class="btn  btn-magenta float-right " id="update-controller">UPDATE
                        CONTROLLER</button>


                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal animated fadeIn" id="addController" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content rounded-20 shadow">
            <div class="modal-header pd-10 tx-center">
                <span class=" tx-17 " id="exampleModalLongTitle">Create Controller </span>
                <button type="button" class=" btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formCreateController">
                    <div class="form-group">
                        <label for=""> NAME :</label>
                        <input type="text" class="form-control " id="addControllername" name="addControllername"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for=""> Type :</label>
                        <select class="selectpicker form-control" id="addControllertype" name="addControllertype">
                            <option value="TCP/IP">TCP/IP</option>
                            <option value="SERIAL">SERIAL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">HOST/IP :</label>
                        <input type="text" class="form-control " id="addControllerhost" name="controller_name"
                            value="127.0.0.1">
                    </div>
                    <div class="form-group">
                        <label for="">PORT :</label>
                        <input type="text" class="form-control " id="addControllerport" name="controller_port"
                            value="502">
                    </div>

                    <div class="form-group">
                        <label for="">DEVICE ID :</label>
                        <input type="text" class="form-control " id="addControllerdeviceid" name="controller_device_id"
                            value="">
                    </div>
                    <div class="form-group">
                        <label for="">STATUS :</label>
                        <select class="selectpicker form-control" id="addControllerstatus" name="controller_status">
                            <option value="1">ENABLE</option>
                            <option value="0">DISABLE</option>
                        </select>
                    </div>

                    <button type="button" class="btn  btn-magenta float-right " id="save-controller">SAVE
                        CONTROLLER</button>
                    <button type="button" class="btn btn-info float-right mg-r-10 " id="test-connection">TEST
                        CONNECTION</button>

                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal animated fadeIn" id="addTag" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content rounded-20 shadow">
            <div class="modal-header pd-10 tx-center">
                <span class=" tx-17 " id="exampleModalLongTitle">Create Tag </span>
                <button type="button" class=" btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formCreateController">
                    <div class="form-group">
                        <label for=""> NAME :</label>
                        <input type="text" class="form-control " id="addTagName" name="addControllername" value="">
                    </div>

                    <div class="form-group">
                        <label for=""> ADDRESS :</label>
                        <input type="text" class="form-control " id="addTagAddress" name="addControllername" value="">
                    </div>
                    <div class="form-group">
                        <label for=""> DATA TYPE :</label>
                        <select class="selectpicker form-control" id="addTagDataType" name="addControllertype">
                            <option value="FloatBE">FloatBE</option>
                            <option value="FloatLE">FloatLE</option>
                            <option value="Int16BE">Int16BE</option>
                        </select>
                    </div>




                    <button type="button" class="btn  btn-magenta float-right " id="save-tag">SAVE
                        TAG</button>
                    <button type="button" class="btn btn-info float-right mg-r-10 " onclick="testAddress()">ADDRESS
                        CHECK</button>

                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal animated fadeIn" id="editTag" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content rounded-20 shadow">
            <div class="modal-header pd-10 tx-center">
                <span class=" tx-17 " id="exampleModalLongTitle">Edit Tag </span>
                <button type="button" class=" btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formCreateController">
                    <input type="hidden" class="form-control " id="editTagId" name="" value="">
                    <div class="form-group">
                        <label for=""> NAME :</label>
                        <input type="text" class="form-control " id="editTagName" name="" value="">
                    </div>

                    <div class="form-group">
                        <label for=""> ADDRESS :</label>
                        <input type="text" class="form-control " id="editTagAddress" name="" value="">
                    </div>
                    <div class="form-group">
                        <label for=""> DATA TYPE :</label>
                        <select class="selectpicker form-control" title="" id="editTagDataType" name="">
                            <option value="FloatBE">FloatBE</option>
                            <option value="FloatLE">FloatLE</option>
                            <option value="Int16BE">Int16BE</option>
                        </select>
                    </div>




                    <button type="button" class="btn  btn-magenta float-right " id="update-tag">UPDATE
                        TAG</button>


                </form>
            </div>

        </div>
    </div>
</div>

<script src="{{asset('backend/js/sweetalert2@9.js')}}"></script>

<script>
    //==== TEST CONNECTION
    $('#test-connection').on('click', () => {
        let controllerData = {};
        controllerData['host'] = $('#addControllerhost').val();
        controllerData['port'] = $('#addControllerport').val();
        controllerData['deviceId'] = $('#addControllerdeviceid').val();

        $('#addController').modal('toggle');
        Swal.queue([{
            title: 'Check Connection',
            confirmButtonText: 'Check',
            text: 'Checking Connection Status for : ' + controllerData['host'] + ':' +
                controllerData['port'],
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return axios.post('http://{{$global_setting->host_ip}}:3000/test-connection', controllerData)
                    .then(function (response) {
                        if (response.data.status == 200) {
                            Swal.fire({
                                title: 'Success',
                                text: response.data.msg,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#800050',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                $('#addController').modal('toggle');
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to Connect',
                                text: response.data.msg,
                                confirmButtonColor: '#800050',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                $('#addController').modal('toggle');
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
                            $('#addController').modal('toggle');
                        })
                    });
            }
        }])
    })

    function testConnection(host, port, deviceId) {
        let controllerData = {};
        controllerData['host'] = host;
        controllerData['port'] = port;
        controllerData['deviceId'] = deviceId;

        Swal.queue([{
            title: 'Check Connection',
            confirmButtonText: 'Check',
            text: 'Checking Connection Status for : ' + controllerData['host'] + ':' + controllerData[
                'port'],
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return axios.post('http://{{$global_setting->host_ip}}:3000/test-connection', controllerData)
                    .then(function (response) {
                        if (response.data.status == 200) {
                            Swal.fire({
                                title: 'Success',
                                text: response.data.msg,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#800050',
                                confirmButtonText: 'Ok'
                            }).then((result) => {})
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to Connect',
                                text: response.data.msg,
                                confirmButtonColor: '#800050',
                                confirmButtonText: 'Ok'
                            }).then((result) => {})


                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Connect',
                            text: "Gateway/Socket Error !",
                            confirmButtonColor: '#800050',
                            confirmButtonText: 'Ok'
                        }).then((result) => {})
                    });
            }
        }])
    }


    //==== CREATE CONTROLLER SCIPRT
    $('#save-controller').on('click', () => {
        let controllerData = {};
        controllerData['controller_name'] = $('#addControllername').val();
        controllerData['controller_type'] = $('#addControllertype').val();
        controllerData['controller_host'] = $('#addControllerhost').val();
        controllerData['controller_port'] = $('#addControllerport').val();
        controllerData['controller_device_id'] = $('#addControllerdeviceid').val();
        controllerData['controller_status'] = $('#addControllerstatus').val();

        axios.post(`{{url('/')}}` + '/api/device', controllerData)
            .then(function (response) {
                if (response.data.status == 200) {
                    // $('#addController').addClass('fadeOut');
                    $('#addController').modal('toggle');
                    Swal.fire(
                        'Success',
                        'Controller Successfully Added !',
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


    // ===== GET CONTROLLER
    getController();

    function getController() {
        axios.get(`{{url('/')}}` + '/api/device')
            .then(function (response) {
                if (response.data.status == 200) {
                    let devices = response.data.msg;
                    let controllers = '';
                    for (const key in devices) {
                        controllers += `<a href="{{url('/settings/device/` + devices[key][`id`] + `')}}" class="">
                                <li class="list-group-item animated fadeIn  rounded-20 card__one shadow">
                                    <p class="mg-b-0"><i class="fa fa-microchip mg-r-8"></i><strong
                                            class="tx-medium">` + devices[key][`controller_name`] + `</strong> </p>
                                    <span> ` + devices[key][`controller_host`] + `</span>
                                </li>
                            </a>`;
                    }
                    $('.devices').html(controllers);

                    // ===== LINK ACTIVE

                    var path = window.location
                        .href; // because the 'href' property of the DOM element is the absolute path
                    var isFind = false
                    $('ul.devices a').each(function () {
                        if (this.href === path) {
                            $(this).find("li").addClass('active');
                            isFind = !isFind
                        }
                    });
                    if (!isFind) {
                        $('ul.devices a li').first().addClass('active');
                    }

                } else {
                    let errorMessage = JSON.parse(response.data.msg);
                    let msg = '';
                    for (const key in errorMessage) {
                        msg += '<span class="d-block tx-danger ">' + errorMessage[key][0] +
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


        var table = $('.datatable').DataTable();
    }

    // ====== EDIT CONTROLLER
    function editController(id) {
        $('#editControllername').val('');
        $('#editControllertype').val('');
        $('#editControllerhost').val('');
        $('#editControllerport').val('');
        $('#editControllerdeviceid').val('');
        $('#editControllerstatus').val('');
        axios.get(`{{url('/')}}` + '/api/device/' + id)
            .then(function (response) {
                console.log(response);
                if (response.data.status == 200) {
                    $('#editControllername').val(response.data.msg.controller_name);
                    $('#editControllertype').val(response.data.msg.controller_type);
                    $('#editControllerhost').val(response.data.msg.controller_host);
                    $('#editControllerport').val(response.data.msg.controller_port);
                    $('#editControllerdeviceid').val(response.data.msg.controller_device_id);
                    $('#editControllerstatus').val(response.data.msg.controller_status);

                } else {
                    $.alert({
                        title: 'Error',
                        content: errorMessage,
                    });
                }
            })
            .catch(function (error) {
                console.log(error);
            });


    }

    // ====== UPDATE CONTROLLER
    $('#update-controller').on('click', () => {
        let id = `{{ isset($device->id) ? $device->id : '' }}`;
        let controllerData = {};
        controllerData['controller_name'] = $('#editControllername').val();
        controllerData['controller_type'] = $('#editControllertype').val();
        controllerData['controller_host'] = $('#editControllerhost').val();
        controllerData['controller_port'] = $('#editControllerport').val();
        controllerData['controller_device_id'] = $('#editControllerdeviceid').val();
        controllerData['controller_status'] = $('#editControllerstatus').val();
        axios.put(`{{url('/')}}` + '/api/device/' + id, controllerData)
            .then(function (response) {
                if (response.data.status == 200) {
                    $('#editController').modal('toggle');
                    Swal.fire(
                        'Success',
                        'Controller Successfully Updated !',
                        'success'
                    ).then((result) => {
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


    // ====== DELETE CONTROLLER
    function deleteController(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will delete this controller ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                axios.delete(`{{url('/')}}` + '/api/device/' + id)
                    .then(function (response) {
                        if (response.data.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                'Controller has been deleted.',
                                'success'
                            ).then((result) => {
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
                        Swal.fire(
                            'Failed !',
                            'Deleted failed :.' + error,
                            'warning'
                        )
                    });

            }
        })
    }


    // ====== TAG ADDRESS
    function testAddress(tag_name = null, tag_data_type = null, tag_address = null) {
        var tagData = {};
        var isCheck = false;

        if (tag_name != null) {
            isCheck = true;
        }

        (isCheck == true) ? null: $('#addTag').modal('toggle');



        tagData['tag_name'] = (tag_name != null) ? tag_name : $('#addTagName').val();
        tagData['tag_data_type'] = (tag_data_type != null) ? tag_data_type : $('#addTagDataType').val();
        tagData['tag_address'] = (tag_address != null) ? tag_address : $('#addTagAddress').val();
        tagData['device_controller_id'] = `{{ isset($device->id) ? $device->id : '' }}`;

        var tags = tagData['tag_name'] + ':' + tagData['tag_data_type'];
        var requestAddress = {
            "options": {
                "host": "{{ isset($device->controller_host) ? $device->controller_host : '' }}",
                "port": "{{ isset($device->controller_port) ? $device->controller_port : '' }}",
                "deviceId": "{{ isset($device->controller_device_id) ? $device->controller_device_id : '' }}"
            },
            "tags": {


            }
        };
        requestAddress['tags'][tags] = tagData['tag_address'];

        Swal.queue([{
            title: 'Check Addres',
            confirmButtonText: 'Check',
            text: 'Checking Address Result',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return axios.post('http://{{$global_setting->host_ip}}:3000/test-address', requestAddress)
                    .then(function (response) {


                        Swal.fire({
                            title: '{{ isset($device->controller_name) ? $device->controller_name : '
                            ' }}',
                            text: tagData['tag_name'] + ' : ' + response.data[
                                '{{ isset($device->controller_device_id) ? $device->controller_device_id : '
                                ' }}'][tagData[
                                'tag_name']],
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#800050',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            (isCheck == true) ? false: $('#addTag').modal('toggle');
                        })

                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Connect',
                            text: "Gateway/Socket Error !",
                            confirmButtonColor: '#800050',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            (isCheck == true) ? false: $('#addTag').modal('toggle');
                        })
                    });
            }
        }])



    }



    // ====== SAVE TAG ADDRESS
    $('#save-tag').on('click', () => {
        let tagData = {};
        tagData['tag_name'] = $('#addTagName').val();
        tagData['tag_address'] = $('#addTagAddress').val();
        tagData['tag_data_type'] = $('#addTagDataType').val();
        tagData['device_controller_id'] = '{{ isset($device->id) ? $device->id : '
        ' }}';
        tagData['tag_status'] = 1;
        axios.post(`{{url('/')}}` + '/api/tag', tagData)
            .then(function (response) {
                console.log(response);
                if (response.data.status == 200) {
                    $('#addTag').modal('toggle');
                    Swal.fire(
                        'Success',
                        'Tag address Successfully Added !',
                        'success'
                    ).then((result) => {
                        location.reload();
                    })
                    // getController();
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


    // ====== DELETE TAG
    function deleteTag(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will delete this tag ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                axios.delete(`{{url('/')}}` + '/api/tag/' + id)
                    .then(function (response) {
                        if (response.data.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                'Tag has been deleted.',
                                'success'
                            ).then((result) => {
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
                        Swal.fire(
                            'Failed !',
                            'Deleted failed :.' + error,
                            'warning'
                        )
                    });

            }
        })
    }

    // ====== EDIT TAG
    function editTag(id, tag_name, tag_data_type, tag_address) {
        $('#editTagId').val('');
        $('#editTagName').val('');
        $('#editTagAddress').val('');
        $('#editTagDataType').val('');
        $('#editTagDataType').attr("title", "");

        $('#editTagId').val(id);
        $('#editTagName').val(tag_name);
        $('#editTagAddress').val(tag_address);
        $('#editTagDataType').val(tag_data_type);
        $('#editTagDataType').selectpicker("val", tag_data_type);
    }

    // ====== UPDATE TAG
    $('#update-tag').on('click', () => {
        let id = $('#editTagId').val();
        let tagData = {};
        tagData['tag_name'] = $('#editTagName').val();
        tagData['tag_address'] = $('#editTagAddress').val();
        tagData['tag_data_type'] = $('#editTagDataType').val();


        axios.put(`{{url('/')}}` + '/api/tag/' + id, tagData)
            .then(function (response) {
                if (response.data.status == 200) {
                    $('#editTag').modal('toggle');
                    Swal.fire(
                        'Success',
                        'Tag Successfully Updated !',
                        'success'
                    ).then((result) => {
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
                        Swal.fire(
                           {
                                icon: 'error',
                            title: 'Failed to Connect',
                            text: "Gateway/Socket Error !",
                            confirmButtonColor: '#800050',
                            confirmButtonText: 'Ok'
                           }
                        ).then((result) => {
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
