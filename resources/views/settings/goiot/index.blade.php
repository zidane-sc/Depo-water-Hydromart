@extends('layouts.main')

@section('page_title',$page_title)


@section('content')
<div class="br-mainpanel">



    <div class="br-pagebody">
        <div class=" text-white rounded-20 pd-t-20 mg-t-50 mg-b-30">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-300 animated fadeInLeft"
                style="margin-top: -40px;  width:fit-content;  box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/icon/maintenance.png')}}" class="ht-50 " alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('create'))
                <div class="alert alert-success alert-bordered rounded-20 shadow shadow animated fadeInLeft">
                    {{ session()->get('create') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('update'))
                <div class="alert alert-success alert-bordered rounded-20 shadow shadow animated fadeInLeft">
                    {{ session()->get('update') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('danger'))
                <div class="alert alert-danger alert-bordered rounded-20 shadow shadow animated fadeInLeft">
                    {{ session()->get('danger') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="card royal rounded-20 pd-20 mg-t-10   shadow animated fadeInUp">
                    <form action='{{url("settings/goiot/")}}' class="" method="post">
                        @csrf

                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Host :</label>
                                    <div class="input-group">
                                        <input type="text" name="host" class="form-control" placeholder="host name"
                                            value="{{$goiot_setting->host}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Device :</label>
                                    <div class="input-group">
                                        <input type="text" name="deviceid" class="form-control" placeholder="device id "
                                            value="{{$goiot_setting->deviceid}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Client Id :</label>
                                    <div class="input-group">
                                        <input type="text" name="clientid" class="form-control" placeholder="projectid#deviceid# "
                                            value="{{$goiot_setting->clientid}}">
                                    </div>
                                    <small>projectid#deviceid#</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Username :</label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" placeholder="username"
                                            value="{{$goiot_setting->username}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Password/Mqtt Token :</label>
                                    <div class="input-group">
                                        <input type="text" name="password" class="form-control" placeholder="password"
                                            value="{{$goiot_setting->password}}">
                                    </div>
                                </div>
                                <hr>

                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="">PH Tag :</label>
                                    <div class="input-group">
                                        <input type="text" name="ph_tag" class="form-control" placeholder="ph tag"
                                            value="{{$goiot_setting->ph_tag}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">TSS Tag :</label>
                                    <div class="input-group">
                                        <input type="text" name="tss_tag" class="form-control" placeholder="tss tag"
                                            value="{{$goiot_setting->tss_tag}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Amonia Tag :</label>
                                    <div class="input-group">
                                        <input type="text" name="amonia_tag" class="form-control"
                                            placeholder="Amonia tag" value="{{$goiot_setting->amonia_tag}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Cod Tag :</label>
                                    <div class="input-group">
                                        <input type="text" name="cod_tag" class="form-control" placeholder="Cod tag"
                                            value="{{$goiot_setting->cod_tag}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Flowmeter Tag :</label>
                                    <div class="input-group">
                                        <input type="text" name="flowmeter_tag" class="form-control"
                                            placeholder="Flowmeter tag" value="{{$goiot_setting->flowmeter_tag}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn  btn-magenta float-right mg-l-10" id="update-controller">UPDATE
                            SETTING</button>
                        <button type="button" class="mg-r-5 btn mg-b-10 float-right  btn-warning shadow "
                            onclick="restartGateway()" data-toggle="tooltip" data-placement="bottom"
                            title="Restart Gateway">
                            <i class="ion ion-loop tx-18 "></i>
                        </button>

                    </form>
                </div>
            </div>


        </div>

    </div><!-- br-pagebody -->

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection

@push('js')
<script src="{{asset('backend/js/sweetalert2@9.js')}}"></script>

<script>
    $('#datatable1').DataTable();
    var route_url = 'maintenance';
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
