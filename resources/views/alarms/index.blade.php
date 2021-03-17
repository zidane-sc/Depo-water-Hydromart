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
                        {{-- <span class="tx-bold tx-18"><i class="  icon ion-android-options tx-22"></i> {{$page_title}}</span> --}}
                        <span class="tx-bold tx-18"><i class="  icon ion-clock tx-22"></i> {{$page_title}}</span>
                        {{-- <a href="{{url('alarm/create') }}">
                            <button class="btn btn-sm btn-info float-right"><i
                                    class="icon ion ion-ios-plus-outline"></i>
                                New
                                Data</button>
                        </a> --}}
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
                        <table class="table display responsive nowrap"  >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tstamp</th>
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
                
                                @foreach ($alarm_lists as $key => $alarm_list)
                                <tr>
                                    {{-- <td>{{$no++}}</td> --}}
                                    <td>{{$alarm_lists->firstItem() + $key }}</td>
                                    <td>{{$alarm_list->tstamp}}</td>
                                    <td>{{$alarm_list->tag_name}}</td>
                                    <td>{{$alarm_list->formula}}</td>
                                    <td>{{$alarm_list->sp}}</td>
                                    <td>{{$alarm_list->text}}</td>
                                    <td>
                                        @if ($alarm_list->status)
                                            <span class="badge badge-success">Noticed</span>
                                        @else
                                            <span class="badge badge-danger">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        
                                       

                                        @if ($alarm_list->status)
                                            
                                            <button class="btn btn-secondary btn-sm text-white" disabled>
                                                <i class="icon icon ion ion-checkmark-round"></i> Ack
                                            </button>
                                        @else
                                            <a href="{{url('alarm/'.$alarm_list->id.'/acknowledge/') }}">
                                                <button class="btn btn-success btn-sm text-white">
                                                    <i class="icon icon ion ion-checkmark-round"></i> Ack

                                                </button>
                                            </a>
                                        @endif
                                        
                                    </td>
                                </tr>
                                    
                                @endforeach
                                 
                            </tbody>

                        </table>
                    </div>
                    {{ $alarm_lists->links() }}
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
