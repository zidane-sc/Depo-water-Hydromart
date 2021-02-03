@extends('layouts.main')

@section('page_title',$page_title)


@section('content')
<div class="br-mainpanel">
    

    <div class="br-pagebody">
        <div class=" text-white rounded-20 pd-t-20 mg-t-50 mg-b-30">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-300 animated fadeInLeft"
                style="margin-top: -40px;  width:fit-content;  box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/icon/departement.png')}}" class="ht-50 " alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>

        <div class="row">

            <div class="col-lg-10 mg-b-20">
                <div class="br-section-wrapper rounded-20 animated fadeInUp" style="padding: 30px 20px">
                    <div style="align">
                        <span class="tx-bold tx-18"><i class="icon ion ion-ios-people tx-22"></i> {{$page_title}}</span>
                        <a href="{{url('departements/create') }}">
                            <button class="btn btn-sm btn-info float-right"><i
                                    class="icon ion ion-ios-plus-outline"></i>
                                New
                                Data</button>
                        </a>
                    </div>
                    <hr>
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
                                    <th>Privilege</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp
                                @foreach ($departements as $departement)


                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $departement->name }}</td>
                                    <td>
                                        <button onclick="detailPrivileges({{$departement->id}})" class="btn btn-info btn-sm"><i class="ion ion-eye"></i> View
                                            Privileges</button>
                                    </td>

                                    <td>
                                        <a href="{{url('departements/'.$departement->id.'/edit/') }}">
                                            <button class="btn btn-warning btn-sm text-white">
                                                <i class="icon icon ion ion-edit"></i> Edit

                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-sm text-white"
                                            onclick="deleteData({{$departement->id}})">
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
</div><!-- br-mainpanel -->\

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@push('js')
<script>
    
    var route_url= 'departements'; 
    var table = $('#datatable1').DataTable();
    function detailPrivileges(id) {
        $.confirm({
            title: 'Detail Privilege',
            theme : 'material',
            backgroundDismiss: true, // this will just close the modal
            content: 'url:departements/'+id,
            onContentReady: function () {
                var self = this;
                // this.setContentPrepend('<div>Prepended text</div>');
                // setTimeout(function () {
                //     self.setContentAppend('<div>Appended text after 2 seconds</div>');
                // }, 2000);
            },
            columnClass: 'medium',
        });
    }

</script>
@endpush
