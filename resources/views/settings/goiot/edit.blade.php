@extends('layouts.main')

@section('page_title',$page_title)

@section('css')
<style>
    .select2-results__option[aria-selected=true] {
        display: none;
    }

</style>

@endsection

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

            <div class="col-lg-6 mg-b-20">
                <div class="br-section-wrapper rounded-20" style="padding: 30px 20px">
                    <div style="align">
                        <span class="tx-bold tx-18">{{$page_title}}</span>
                        {{-- <a href="{{url('departements/create')}}"> <button
                            class="btn btn-sm btn-danger float-right"><i class="icon ion ion-ios-plus-outline"></i>
                            New
                            Data</button>
                        </a> --}}
                        <hr>
                        <form method="POST" action="{{ route('maintenance.update',$maintenance->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="form-group   {{ $errors->has('sensor') ? ' has-danger' : '' }}">
                                <label for="">Sensor</label>
                                <br>
                                <input readonly type="text" class="form-control" value="{{$maintenance->sensor}}" >
                                @if ($errors->has('sensor'))
                                <small class="text-danger">{{ $errors->first('sensor') }}</small>
                                @endif
                            </div>


                            <div class="form-group ">
                                <label for="">Value</label>
                                <input type="number" step="0.01" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" type="text"
                                    name="value" placeholder="input value" value="{{$maintenance->value}}">
                                @if ($errors->has('value'))
                                <small class="text-danger">{{ $errors->first('value') }}</small>
                                @endif
                            </div>

                            <div class="form-group  {{ $errors->has('status') ? ' has-danger' : '' }}">
                                <label for="">Status</label>
                                <br>
                                <select class="form-control select2 " name="status" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    
                                    <option value="0" @if ($maintenance->status === 0)
                                        {{ 'selected=selected'}}
                                        @endif
                                        >Disable</option>
                                    <option value="1" @if ($maintenance->status === 1)
                                        {{ 'selected=selected'}}
                                        @endif
                                        >Enable</option>

                                </select>
                                @if ($errors->has('status'))
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn   btn-success" type="submit"><i class="far fa-save"></i>
                                    Save</button>
                                <a href="{{ url('settings/maintenance') }}"><button class="btn   btn-danger" type="button"><i
                                            class="far fa-arrow-alt-circle-left"></i> Cancel</button></a>
                            </div>
                        </form>
                    </div>
                    <hr>

                </div>

            </div>

        </div>

    </div><!-- br-pagebody -->

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection
