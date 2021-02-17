@extends('layouts.main')

@section('page_title',$page_title)
@section('css')
{{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}

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

    .hilang {
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
                    <img src="{{asset('backend/images/icon/departement.png')}}" class="ht-50 " alt="">
                    <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
                </div>
                <div class="row row-sm">
                </div>
            </div>
        <div class="row row-sm mg-t-20">
            <div class="col-md-4 ">
                <div class="card bd-0 shadow-base rounded-30">
                    <div class="card-header tx-medium bd-0 stx-18" style="border-radius: 30px 30px 0px 0px;">
                        <i class="ion icon ion-calendar"></i> Filter Report
                    </div>
                    <div class="card-body  d-xs-flex justify-content-between align-items-center">
                        <div class="d-md-flex pd-y-20 pd-md-y-0">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <small>Select Periode :</small>
                                        <div class="input-group " id="datepicker-area">
                                            <span class="input-group-append">
                                                <select name="" class="form-control" id="daterange">
                                                    <option value="day">Day </option>
                                                    {{-- <option value="minute">Day (M) </option> --}}
                                                    <option value="month">Month</option>
                                                    <option value="year">Year</option>
                                                    {{-- <option value="hour">Hour</option>
                                                        <option value="minute">Minute</option> --}}
                                                </select>
                                            </span>
                                            <input type="text" name="date" id="date" value="{{$date}}" autocomplete="off"
                                                class="datepicker form-control   time" required>

                                            <input type="text" name="month" id="month" value="{{$month}}" autocomplete="off"
                                                class="datepicker-month form-control  hilang time" required>

                                            <input type="text" name="year" id="year" value="{{$year}}" autocomplete="off"
                                                class="datepicker-year form-control  hilang time" required>

                                            <span class="input-group-append">
                                                <button type="button" onclick="submitDate()" class="btn btn-info btn-flat">
                                                    <div><i class="fa fa-paper-plane"></i></div>
                                                </button>
                                            </span>
                                            <span class="input-group-append">
                                                <a href=" "><button type="button" class="btn btn-danger btn-flat">
                                                        <div><i class="fa fa-sync"></i></div>
                                                    </button></a>
                                            </span>
                                        </div>
                                        <small class="text-muted"><i>*Default ,this date</i></small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
            <div class="col-md-4 mg-t-20">
                <div class="card card widget-13 bd-0 shadow-base  rounded-20">

                    <div class="card-body  pd-10">
                        <div class=" ">
                            <ul class="list-group list-group-flush wd-100p">
                                <li class="list-group-item">
                                    <span class="tx-14 valign-top">
                                        Status :
                                    </span>
                                    <span id='status'></span>
                                </li>
                                <li class="list-group-item">
                                    <span class="tx-14 valign-top">
                                        Periode :
                                    </span>
                                    <span class="tx-12 align-self-center badge " id="periode">
                                        {{$date}}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <span class="tx-14 valign-top">
                                        Device :
                                    </span>
                                    <span class="tx-12 align-self-center badge " id="voltage-t-r">
                                        {{-- {{$deviceActive->name}} --}}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        </div>
        <div class="row row-sm mg-t-20">
            <div class="col-md-12 mg-t-20">
                <div class="card bd-0 shadow-base  rounded-30">
                    <div class="card-header tx-medium bd-0 tx-white bg-mantle d-flex justify-content-between align-items-center"
                        style="border-radius: 30px 30px 0px 0px;">
                        <h6 class="card-title tx-uppercase text-white tx-12 mg-b-0">DATA TOTAL : ppo
                        </h6>
                        <span class="tx-12 tx-uppercase" id="dateTag1"></span>
                    </div><!-- card-header -->
                    <div class="card-body pd-t-40 pd-b-20  justify-content-between align-items-center">
                        <div class="wd-100p ht-400" id="data-total" width=""></div>
                        <div class="">
                            <div id="buttons2" style="padding: 10px; margin-bottom: 10px;width: 25%;">
                                <p>Download :</p>
                            </div>
                            <table id="table-total" class="table table-bordered table-hover">
                                <thead>
                                    <th width="1%">No</th>
                                    <th width="15%">Date</th>
                                    <th>Totalizer Min</th>
                                    <th>Totalizer Max</th>
                                    <th>Totalizer</th>
                                    <th>Gallon</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
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
<script src="{{asset('backend/js/consumption/consumption.js')}}"></script>

<script>
    let gallon = {{ $global_setting->gallon }}

    submitDate();
    $('.datatableG').dataTable({
        "searching": false,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        startView: 2,
        minViewMode: 0,
        language: "id",
        daysOfWeekHighlighted: "0",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true,
        container: '#datepicker-area'
    });

    $('.datepicker-month').datepicker({
        format: "yyyy-mm",
        startView: 2,
        minViewMode: 1,
        language: "id",
        daysOfWeekHighlighted: "0",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true,
        container: '#datepicker-area'
    });

    $('.datepicker-year').datepicker({
        format: "yyyy",
        startView: 2,
        minViewMode: 2,
        language: "id",
        daysOfWeekHighlighted: "0",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true,
        container: '#datepicker-area'
    });

    $('#daterange').on('change', function () {
        val = $(this).val();
        // $('.time').val(' ');
        if (val == 'day' || val == 'minute') {
            $('.datepicker').removeClass('hilang');
            $('.datepicker-month').addClass('hilang');
            $('.datepicker-year').addClass('hilang');
        } else if (val == 'month') {
            $('.datepicker').addClass('hilang');
            $('.datepicker-month').removeClass('hilang');
            $('.datepicker-year').addClass('hilang');
        } else if (val == 'year') {
            $('.datepicker').addClass('hilang');
            $('.datepicker-month').addClass('hilang');
            $('.datepicker-year').removeClass('hilang');
        }

    })


    // DATATABLE
    var base_url = "{{asset('/backend/images/logo/logo-Hydromart.jpg')}}"
    var myGlyph = new Image();
    myGlyph.src = base_url;

    function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        return canvas.toDataURL("image/png");
    }

    // --data total
    var table2 = $('#table-total').DataTable();
    var buttons2 = new $.fn.dataTable.Buttons(table2, {
        buttons: [{
            extend: 'pdfHtml5',
            title: 'Gallon Consumption (Data Total)',
            orientation: 'potrait',
            pageSize: 'A4',
            className: 'btn btn-danger btn-sm btn-corner',
            text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF',
            titleAttr: 'Download as PDF',
            customize: function (doc) {
                doc.content.splice(0, 0, {
                    margin: [0, 0, 0, 12],
                    alignment: 'center',
                    image: getBase64Image(myGlyph),
                    width: 140,
                    height: 40,
                });
            }
        }, {
            extend: 'excelHtml5',
            title: 'Gallon Consumption (Data Total)',
            text: '<i class="fas fa-file-excel"></i>&nbsp; EXCEL',
            className: 'btn btn-success btn-sm btn-corner',
            titleAttr: 'Download as Excel'
        }, {
            extend: 'csv',
            title: 'Gallon Consumption (Data Total)',
            text: '<i class="fas fa-file-csv"></i>&nbsp; CSV',
            className: 'btn btn-info btn-sm btn-corner',
            titleAttr: 'Download as Csv'
        }, ],
    }).container().appendTo($('#buttons2'));
    // CHART

</script>
@endpush
