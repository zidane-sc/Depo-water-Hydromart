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
                <div class="card-body  d-xs-flex justify-content-between align-items-center">
                    <div class="d-md-flex pd-y-20 pd-md-y-0">
                           
                        <form action="" method="get">
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
                            <div class="form-group">
                                <label for="">Select Sensor :</label>
                                <small>Select All</small>

                                <input type="checkbox" id="checkbox">
                                <select name="sensors[]" required class="form-control select2" style="width:100%"
                                    id="e1" multiple>
                                    @foreach ($selectSensors as $selectSensor)
                                    <option value="{{$selectSensor->tag_name}}">{{$selectSensor->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                    <label for="">Select Connectivity :</label>
                                    <select name="connectivity" required class="form-control select2" style="width:100%">
                                         <option value="">--</option>
                                         <option value="ONLIMO">ONLIMO</option>
                                         <option value="SPARING">SPARING</option>
                                    </select>
                                </div>
                            <div class="form-group">

                                <input type="text" class="form-control fc-datepicker" value="{{$date_default}}"
                                    placeholder="{{$date}}" autocomplete="off" name="date">
                            </div>

                            <div class="form-group">

                                <select name="hour" id="bmg_monday_start_hour"
                                    class="form-control bmg-hrs-mins-input"></select>
                            </div>
                            <br>
                            <button class="btn btn-sm btn-primary" class="form-control">Generate API</button>
                            <hr>
                          

                        </form>

                    </div>

                </div><!-- card-body -->
            </div><!-- card -->
        </div>
        <div class="col-md-6 mg-t-20">
            <div class="card bd-0 shadow-base  rounded-20">
                <div class="card-header tx-medium bd-0 tx-white bg-mantle d-flex justify-content-between align-items-center"
                    style="border-radius: 122px;border-bottom-left-radius: 0px;">
                    <h6 class="card-title tx-uppercase text-white tx-12 mg-b-0">Preview</h6>
                    <span class="tx-12 tx-uppercase" id=""></span>
                </div><!-- card-header -->
                <div class="card-body  d-xs-flex justify-content-between align-items-center">
                    <div class=" wd-100p">
                    <p>Connectivity  : <span id="connectivity">{{$connectivity}}</span></p>
                        <p>Status : <span id="status"></span></p>
                            <pre id="data_json" class="hilang"><code class="javascript pd-20 wd-100p">
{
    data: {
        IDStasiun: '{{$api_setting->idstasiun}}',
        Tanggal: '{{$date_default}}',
        Jam: "{{$hour}}:00",
    @foreach($sensors as $sensor)
    {{$sensor->tag_name}}: {{number_format($sensor->value_avg,2,'.','.')}},
    @endforeach
},
    apikey: "{{$api_setting->apikey}}",
    apisecret: "{{$api_setting->apisecret}}"
} </code></pre>

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
    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeYear: true
    });

    $('#datepickerNoOfMonths').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        numberOfMonths: 2
    });
    for (let hr = 0; hr < 24; hr++) {

        // let hrStr = hr.toString().padStart(2, "0") + ":";
        let hrStr = hr.toString().padStart(2, "0") ;

        let val = hrStr + ":00";
        $select.append('<option value="' + hrStr + '">' + val + '</option>');

        // val = hrStr + "30";
        // $select.append('<option val="' + val + '">' + val + '</option>')

    }

    $("#e1").select2();
    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#e1 > option").prop("selected", "selected");
            $("#e1").trigger("change");
        } else {
            $("#e1 > option").removeAttr("selected");
            $("#e1").val("");
            $("#e1").trigger("change");
        }
    });

    $("#button").click(function () {
        alert($("#e1").val());
    });

    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });

    $("#e1").val([
        @foreach($sensors as $sensor) 
        {!!"'".$sensor->tag_name."'".','!!}
        @endforeach
    ]);
    
    <?php if($get): ?>
    setTimeout(function(){
        var data_json = $('#data_json').text();

        $.ajax({
            type: 'post',
            url: route_url + '/klhk',
            dataType: 'json',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            data: {
                "_token": "{{ csrf_token() }}",
                "data_json" : data_json
            },
            beforeSend:function(){
                toastr.options.timeOut = 30000;

                toastr.warning('Sending Data ...');

            },
            success: function (data) {
                toastr.remove()
                console.log(data);
                $('#data_json').removeClass('hilang');
                if(data.status.statusCode===200)
                {
                    $('#status').html('<span class="badge badge-success">Success</span>');
                    toastr.options.timeOut = 20000;
                    toastr.success('STATUS ONLIMO :'+'<br>'+data.status.statusCode+'<br>'+data.status.statusDesc )
                }else
                {
                    $('#status').html('<span class="badge badge-danger">Not Successful</span>');
                    toastr.options.timeOut = 20000;
                    toastr.error('STATUS ONLIMO :'+'<br>'+data.status.statusCode+'<br>'+data.status.statusDesc )
                }
            },
            error: function (data) {
                
                $.alert('Failed!');
                toastr.error(data.status.statusCode+'<br>'+data.status.statusDesc )

                console.log(data);
            }
        });
    },1000);
    <?php endif ?>


</script>
@endpush
