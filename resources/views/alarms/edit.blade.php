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
    <div class="br-pageheader">
        <div w>
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
                        <span class="tx-bold tx-18">{{$page_title}}</span>
                        {{-- <a href="{{url('departements/create')}}"> <button
                            class="btn btn-sm btn-danger float-right"><i class="icon ion ion-ios-plus-outline"></i>
                            New
                            Data</button>
                        </a> --}}
                        <hr>
                        <form method="POST" action="{{ route('alarm.update', $alarm->id) }}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Sensor</label>
                                        <select class="select2 form-control{{ $errors->has('sensor') ? ' is-invalid' : '' }}"
                                            name="sensor" id="">
                                            <option value="">--</option>
                                            @foreach ($sensors as $sensor)
                                            <option  @if ($alarm->tag_name == $sensor->tag_name)
                                                    {{ 'selected=selected'}}
                                                    @endif value="{{$sensor->tag_name}}">{{$sensor->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('sensor'))
                                        <small class="text-danger">{{ $errors->first('sensor') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="">Formula</label>
                                        <select class="form-control{{ $errors->has('formula') ? ' is-invalid' : '' }}" name="formula" id="">
                                            <option value="==" 
                                            @if ($alarm->formula == '==')
                                        {{ 'selected=selected'}}
                                        @endif> == </option>
                                            <option value=">" 
                                                @if ($alarm->formula == '>')
                                        {{ 'selected=selected'}}
                                        @endif> > </option>
                                            <option value=">=" 
                                                @if ($alarm->formula == '>=')
                                        {{ 'selected=selected'}}
                                        @endif> >=</option>
                                            <option value="<" 
                                            @if ($alarm->formula == '<')
                                        {{ 'selected=selected'}}
                                        @endif> < </option>
                                            <option value="<=" 
                                            @if ($alarm->formula == '<=')
                                        {{ 'selected=selected'}}
                                        @endif> <= </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">SP</label>
                                         <input type="number" value="{{$alarm->sp}}"  class="form-control{{ $errors->has('sp') ? ' is-invalid' : '' }}" name="sp">
                                         @if ($errors->has('sp'))
                                         <small class="text-danger">{{ $errors->first('sp') }}</small>
                                         @endif
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Text </label>
                                        <input type="text" value='{{$alarm->text}}'  class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" name="text">
                                             @if ($errors->has('text'))
                                             <small class="text-danger">{{ $errors->first('text') }}</small>
                                             @endif
                                        </div>
                                    </div>
                            </div>


                            <div class="form-group">
                                <button class="btn   btn-success" type="submit"><i class="far fa-save"></i>
                                    Save</button>
                                <a href="{{ url('alarm/setting') }}"><button class="btn   btn-danger" type="button"><i
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


@section('js')
<script>
    $("#e1").select2();
   
</script>


@endsection
