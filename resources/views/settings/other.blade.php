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
                    <form action='{{url("settings/other/{$id}")}}' class="" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Plant Name :</label>
                                    <div class="input-group">
                                        <input type="text" name="plant_name" class="form-control"
                                            placeholder="plant name" value="{{$global_setting->plant_name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Location :</label>
                                    <div class="input-group">
                                        <input type="text" name="location" class="form-control"
                                            placeholder="location name" value="{{$global_setting->location}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Logo:</label>
                                    <div class="input-group">
                                    <img width='150' class="p-2" src="{{asset('backend/images/logo/'.$global_setting->logo)}}">
                                    </div>
                                    <div class="input-group">
                                        <input class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}"  type="file"
                                    name="logo" value="{{$global_setting->logo}}">
                                @if ($errors->has('logo'))
                                    <small class="text-danger">{{ $errors->first('logo') }}</small>
                                @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn  btn-magenta float-right mg-l-10" id="update-controller">UPDATE
                            SETTING</button>



                    </form>



                </div>
            </div>
            <div class="col-lg-6">
                @if(session()->has('reset_totalizer'))
                <div class="alert alert-success alert-bordered rounded-20 shadow shadow animated fadeInLeft">
                    {{ session()->get('reset_totalizer') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card royal rounded-20 pd-20 mg-t-10   shadow animated fadeInUp">
                    <form action='' class="" method="post">
                        @csrf

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Reset Totalizer :</label>
                                    {{-- <div class="input-group">
                                        <input type="text" name="plant_name" class="form-control" placeholder="plant name"
                                            value="{{$global_setting->plant_name}}">
                                </div> --}}
                            </div>
                        </div>
                </div>

                <button type="button" class="btn  btn-danger mg-l-10 mg-b-20" onclick="resetTotalizer()">RESET VALUE
                    TOTALIZER</button>
                <table class="table mg-t-20">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>logs id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reset_histories as $rs)
                        <tr>
                            <td>{{$loop->iteration}}
                            </td>
                            <td>{{$rs->created_at}}</td>
                            <td>{{$rs->logs_id}}</td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
                </form>



            </div>
        </div>

    </div>

</div>
</div>



</div><!-- br-pagebody -->

@push('js')


<script src="{{asset('backend/js/sweetalert2@9.js')}}"></script>

<script>
    // ====== RESET LOGS
    function resetTotalizer() {
        Swal.queue([{
            title: 'Are you sure?',
            text: "You will reset totalizer display ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!',
            showLoaderOnConfirm: true,
            preConfirm: () => {

                return axios.get(`{{url('/')}}` + '/api/totalizer/reset')
                    .then(function (response) {
                        console.log(response);
                        if (response.status == 200) {
                            Swal.fire(
                                'Success',
                                'Data Successfully Reseted !',
                                'success'
                            ).then((result) => {
                                location.reload();
                            })
                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Failed Reset',
                                text: 'Error',
                                confirmButtonColor: '#800050',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                location.reload();
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
    $('.table').dataTable();
</script>
@endpush
@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection
