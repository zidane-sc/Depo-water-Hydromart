@extends('layouts.main')

@section('page_title',$page_title)


@section('content')
<div class="br-mainpanel">



    <div class="br-pagebody">
        <div class=" text-white rounded-20 pd-t-20 mg-t-50 mg-b-30">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-300 animated fadeInLeft"
                style="margin-top: -40px;  width:fit-content;  box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/icon/privilege.png')}}" class="ht-50 " alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12 mg-b-20">
                <div class="br-section-wrapper rounded-20" style="padding: 30px 20px">
                    <div style="align">
                        <span class="tx-bold tx-18"><i class="icon ion ion-ios-cog-outline tx-22"></i>
                            {{$page_title}}</span>
                        <a href="{{url('settings/privilege/create') }}">
                            <button class="btn   btn-info float-right"><i class="icon ion ion-ios-plus-outline"></i>
                                New
                                Data</button>
                        </a>
                    </div>
                    <br>

                    <hr>

                    {{-- <x-alert type="error" class="mb-4">
                        <x-slot name="heading">
                            Alert content...
                        </x-slot>
                        Default slot content...
                    </x-alert> --}}


                    @if(session()->has('create'))
                    <div class="alert alert-success wd-50p">
                        {{ session()->get('create') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session()->has('update'))
                    <div class="alert alert-warning wd-50p">
                        {{ session()->get('update') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    @endif


                    @if(session()->has('delete'))
                    <div class="alert alert-danger wd-50p">
                        {{ session()->get('delete') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-wrapper ">
                        <table class="table display responsive nowrap" id="datatable1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($privileges as $privilege)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$privilege->name}}</td>
                                    <td>
                                        <a href="{{url('settings/privilege/'.$privilege->id.'/edit/') }}">
                                            <button class="btn btn-warning btn-sm text-white">
                                                <i class="icon icon ion ion-edit"></i> Edit
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-sm text-white"
                                            onclick="deleteData({{$privilege->id}})">
                                            <i class="icon icon ion ion-ios-trash-outline"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>

                        </table>
                    </div>
                    {{-- {{ $users->link    s() }} --}}
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
    var route_url = 'privilege';
    // // ====== RESTART GATEWAY

    // function restartGateway() {
    //     Swal.queue([{
    //         title: 'Are you sure?',
    //         text: "You will restart all Gateway ",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, Restart it!',
    //         showLoaderOnConfirm: true,
    //         preConfirm: () => {
    //             return axios.get('http://{{$global_setting->host_ip}}:3000/restart')
    //                 .then(function (response) {
    //                     if (response.data.status == 200) {
    //                         Swal.fire(
    //                             'Success Restarted',
    //                             response.data.msg,
    //                             'success'
    //                         ).then((result) => {
    //                             // location.reload();
    //                         })
    //                     } else {
    //                         Swal.fire(
    //                             'Failed',
    //                             response.data.msg,
    //                             'warning'
    //                         ).then((result) => {
    //                             // location.reload();
    //                         })

    //                     }
    //                 })
    //                 .catch(function (error) {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Failed to Connect',
    //                         text: "Gateway/Socket Error !",
    //                         confirmButtonColor: '#800050',
    //                         confirmButtonText: 'Ok'
    //                     }).then((result) => {
    //                         // location.reload();
    //                     })
    //                 });
    //         }
    //     }])
    // }

</script>
@endpush