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
                <img src="{{asset('backend/images/icon/users-2.png')}}" class="ht-50 " alt="">
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
                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="form-group ">
                                <label for="">Full Name</label>
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"
                                    name="name" placeholder="input user full name" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>

                             <div class="form-group ">
                                <label for="">User Name</label>
                                <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" type="text"
                                    name="username" placeholder="input username" value="{{old('username')}}">
                                @if ($errors->has('username'))
                                <small class="text-danger">{{ $errors->first('username') }}</small>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="">Email</label>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"
                                    name="email" placeholder="input user email" value="{{old('email')}}">
                                @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="password" class=" ">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" placeholder="input password" >

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" placeholder="same with password" s>
                            </div>



                            <div class="form-group   {{ $errors->has('departement_id') ? ' has-danger' : '' }}">
                                <label for="">Departement</label>
                                <br>
                                <select class="form-control select2 " name="departement_id"
                                    data-placeholder="Choose one  ">
                                    <option label="Choose one"></option>
                                    @foreach ($departements as $departement)
                                    <option value="{{$departement->id}}"
                                        @if (old('departement_id') == $departement->id)
                                            {{ 'selected=selected'}}
                                        @endif
                                        >{{$departement->name}}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('privileges') }}</small>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="">Avatar</label>
                                <input class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}"  type="file"
                                    name="avatar"   value="{{old('avatar')}}">
                                @if ($errors->has('avatar'))
                                    <small class="text-danger">{{ $errors->first('avatar') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn   btn-success" type="submit"><i class="far fa-save"></i>
                                    Save</button>
                                <a href="{{ url('users') }}"><button class="btn   btn-danger" type="button"><i
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
