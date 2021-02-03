@extends('layouts.main')

@section('page_title',$page_title)
@section('css')
<style>
    a {
        color: inherit;
    }

    .card__one {
        transition: transform .5s;


    }

    .card__one::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: opacity 2s cubic-bezier(.165, .84, .44, 1);
        box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .15);
        content: '';
        opacity: 0;
        z-index: -1;
    }

    .card__one:hover,
    .card__one:focus {
        transform: scale3d(1.036, 1.036, 1);
        -webkit-box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
        -moz-box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
        box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);


    }



    a:hover {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }

</style>
@endsection

@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index.html">{{config('app.name')}}</a>
            <span class="breadcrumb-item active">{{$page_title}}</span>
        </nav>
    </div><!-- br-pageheader -->
    {{-- <div class="br-pagetitle">
        <i class="icon icon ion-stats-bars"></i>
        <div>
            <h4>{{$page_title}}</h4>
</div>
</div><!-- d-flex --> --}}

<div class="br-pagebody">
    <div class="row row-sm mg-t-20">
        <div class="col-md-6 mg-t-20">
            <div class="card bd-0 shadow-base  rounded-20">
                <div class="card-header tx-medium bd-0 tx-white bg-mantle d-flex justify-content-between align-items-center"
                    style="border-radius: 122px;border-bottom-left-radius: 0px;">
                    <h6 class="card-title tx-uppercase text-white tx-12 mg-b-0">{{$page_title}}</h6>
                    <span class="tx-12 tx-uppercase" id=""></span>
                </div><!-- card-header -->
                <div class="card-body  ">
                    <div class="">
                            @if(session()->has('update'))
                            <div class="alert alert-warning ">
                                {{ session()->get('update') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        <form action="" method="post">
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="icon ion-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div>
                            <input type="text" class="form-control fc-datepicker" value="" autocomplete="off"
                                    name="date">
                                <button href="#" class="btn btn-primary btn-icon  mg-md-l-10 mg-t-10 mg-md-t-0">
                                    <div><i class="fa fa-paper-plane"></i></div>
                                </button>
                            </div> --}}

                            @csrf
                            <div class="form-group">
                                <label for="">UID :</label>
                                 <input type="text"  value="{{$api_setting->idstasiun}}" name="idstasiun" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">JWT SECRET API :</label>
                            <input type="text" name="apisecret" value="{{$api_setting->apisecret}}" class="form-control">
                            </div>

                            {{-- <div class="form-group">
                                    <label for="">APISecret :</label>
                                        <input type="text" name="apisecret" value="{{$api_setting->apisecret}}" class="form-control">
                                </div> --}}

                                <button class="btn btn-sm btn-success" type="submit">Save</button>
 
                          

                        </form>

                    </div>

                </div><!-- card-body -->
            </div><!-- card -->
        </div>
      

    </div>







</div><!-- br-pagebody -->

@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection


@push('js')
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="{{url('/backend')}}/lib/jquery-ui/ui/widgets/datepicker.js"></script>
<script>
    let $select = jQuery("#bmg_monday_start_hour");

    var route_url = '{{url("api-page")}}'
    // Datepicker
    
   

</script>
@endpush
