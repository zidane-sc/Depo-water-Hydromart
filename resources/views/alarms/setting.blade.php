@extends('layouts.main')

@section('page_title',$page_title)


@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader">
        <div>
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="index.html">{{config('app.name')}}</a>
                <span class="breadcrumb-item active">{{$page_title}}</span>

            </nav>

        </div>
    </div><!-- br-pageheader -->


    <div class="br-pagebody">

        <div class="row">

            <div class="col-lg-12 mg-b-20">
                <div class="br-section-wrapper" style="padding: 30px 20px">
                    <div style="align">
                        <span class="tx-bold tx-18"><i class="  icon ion-android-options tx-22"></i> {{$page_title}}</span>
                        {{-- <span class="tx-bold tx-18"><i class="  icon ion-clock tx-22"></i> {{$page_title}}</span> --}}
                        <a href="{{url('alarm/create') }}">
                            <button class="btn btn-sm btn-info float-right"><i
                                    class="icon ion ion-ios-plus-outline"></i>
                                New
                                Data</button>
                        </a>
                    </div>
                    <hr>
                    @if(session()->has('create'))
                    <div class="alert alert-success wd-100p">
                        {{ session()->get('create') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session()->has('update'))
                    <div class="alert alert-warning wd-100p">
                        {{ session()->get('update') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    @endif


                    @if(session()->has('delete'))
                    <div class="alert alert-danger wd-100p">
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
                                    <th>Sensor</th>
                                    <th>Formula</th>
                                    <th>SP</th>
                                    <th>Text</th>
                                    <th>Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp
                
                                @foreach ($alarm_settings as $alarm_setting)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$alarm_setting->tag_name}}</td>
                                    <td>{{$alarm_setting->formula}}</td>
                                    <td>{{$alarm_setting->sp}}</td>
                                    <td>{{$alarm_setting->text}}</td>
                                    <td>
                                        @if ($alarm_setting->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Non-Active</span>
                                        @endif
                                    <td>
                                        <a href="{{url('alarm/'.$alarm_setting->id.'/edit/') }}">
                                            <button class="btn btn-warning btn-sm text-white">
                                                <i class="icon icon ion ion-edit"></i> Edit

                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-sm text-white"
                                            onclick="deleteData({{$alarm_setting->id}})">
                                            <i class="icon icon ion ion-ios-trash-outline"></i> Delete
                                        </button>

                                        @if ($alarm_setting->status)
                                            
                                            <a href="{{url('alarm/'.$alarm_setting->id.'/deactivate/') }}">
                                                <button class="btn btn-pink btn-sm text-white">
                                                    <i class="icon icon ion ion-close-round"></i> Deactivate

                                                </button>
                                            </a>
                                        @else
                                            <a href="{{url('alarm/'.$alarm_setting->id.'/activate/') }}">
                                                <button class="btn btn-success btn-sm text-white">
                                                    <i class="icon icon ion ion-checkmark-round"></i> Activate

                                                </button>
                                            </a>
                                        @endif
                                        
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
    <script>
    var route_url= '{{url("alarm")}}'; 
    </script>
@endpush
