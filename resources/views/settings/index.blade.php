@extends('layouts.main')
@section('page_title',$page_title)
@section('css')
<style>
    .extra-bold {
        text-shadow: 0px 1px, 1px 0px, 1px 1px;
        letter-spacing: 1px;
    }

    .dashboard-header {
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;
        background: #00597A;
    }

    .rounded-top-20 {
        border-top-left-radius: 20px !important;
        border-top-right-radius: 20px !important;
    }

    .table-responsive::-webkit-scrollbar {
        -webkit-appearance: none;
    }

    .table-responsive::-webkit-scrollbar:vertical {
        width: 12px;
    }

    .table-responsive::-webkit-scrollbar:horizontal {
        height: 12px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, .5);
        border-radius: 10px;
        border: 2px solid #ffffff;
    }

    .table-responsive::-webkit-scrollbar-track {
        border-radius: 10px;
        background-color: #ffffff;
    }

    .dpinfo {



        overflow: hidden;

    }


    .wordwrap {
        white-space: pre-wrap;
        /* CSS3 */
        white-space: -moz-pre-wrap;
        /* Firefox */
        white-space: -pre-wrap;
        /* Opera <7 */
        white-space: -o-pre-wrap;
        /* Opera 7 */
        word-wrap: break-word;
        /* IE */
    }

    .w74 {
        word-wrap: break-word;
    }
</style>
@endsection
@section('content')
<div class="br-mainpanel">

    <div class="br-pagebody">
        <div class=" text-white rounded-20 pd-t-20 mg-t-50 mg-b-30">
            <div class="d-flex  bg-royal rounded-20 pd-10 text-white wd-300 animated fadeInLeft"
                style="margin-top: -40px;    box-shadow: -2px 13px 16px 0px rgba(0, 0, 0, 0.21);">
                <img src="{{asset('backend/images/icon/setting.png')}}" class="ht-50 rounded-circle" alt="">
                <h4 class="mg-b-0 mg-t-10 mg-l-10 " style="   letter-spacing: 1px;">{{$page_title}}</h4>
            </div>
            <div class="row row-sm">
            </div>
        </div>

        <div class=" text-white">

            <div class="row row-sm mg-b-30 ">
                <div class="col-lg-3 mg-b-20 hilang " style="z-index:999">
                    <a href="{{url('settings/device')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/gateway.png')}}" class="img-fluid ht-50" alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Device</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Device Status,Device
                                        IP,Connection,Port,Tag Address</span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>
                <div class="col-lg-3 mg-b-20 hilang" style="z-index:999">
                    <a href="{{url('settings/sensor')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/sensor.png')}}" class="img-fluid ht-50" alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Sensors</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Sensor Name,Sensor display,
                                        Config Sensor</span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>

                <div class="col-lg-3 mg-b-20 hilang" style="z-index:999">
                    <a href="{{url('settings/api-config')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/api-setting.png')}}" class="img-fluid ht-50"
                                    alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">API</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Station ID,API JWT
                                        Key</span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>

                <div class="col-lg-3 mg-b-20 hilang" style="z-index:999">
                    <a href="{{url('settings/socket')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/socket.png')}}" class="img-fluid ht-50" alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Socket</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Websocket Setting,Realtime
                                        ,Interval Pool</span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>
                <div class="col-lg-3 mg-b-20 hilang" style="z-index:999">
                    <a href="{{url('alarm/alarm-setting')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/alarm.png')}}" class="img-fluid ht-50" alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Alarm</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Alarm Setting</span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>
                <div class="col-lg-3 mg-b-20 " style="z-index:999">
                    <a href="{{url('users')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/users.png')}}" class="img-fluid ht-50" alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Pengguna</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Buat, Baca, Perbarui,
                                         Hapus Pengguna </span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>

                <div class="col-lg-3 mg-b-20 " style="z-index:999">
                    <a href="{{url('departements')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/departement-2.png')}}" class="img-fluid ht-50"
                                    alt="">
                                <div class="mg-l-20 dpinfo">
                                    <span class="tx-bold tx-20   tx-inverse  ">Departemen</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Buat, Baca, Perbarui,
                                        Departemen dan Hak istimewa</span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>


                <div class="col-lg-3 mg-b-20" style="z-index:999">
                    <a href="{{url('settings/database')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/database.png')}}" class="img-fluid ht-50" alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Database</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Pengaturan Host, Nama Pengguna,
                                        Database, Interval Pencatat, Cadangkan</span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>

                @if (env('PRIVILEGE') == 'ON' || env('PRIVILEGE') == '1' )
                    <div class="col-lg-3 mg-b-20 hilang" style="z-index:999">
                        <a href="{{url('settings/privilege')}}">
                            <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                                <div class="card-body d-flex">
                                    <img src="{{asset('backend/images/icon/privilege.png')}}" class="img-fluid ht-50"
                                        alt="">
                                    <div class="mg-l-20">
                                        <span class="tx-bold tx-20  d-block  tx-inverse ">Privilege</span>
                                        <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Create, read, update
                                            privilege.</span>
                                    </div>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </a>
                    </div>
                @endif

                @if (env('MAINTENANCE') == 'ON' || env('MAINTENANCE') == '1' )
                <div class="col-lg-3 mg-b-20 hilang" style="z-index:999">
                    <a href="{{url('settings/maintenance')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/maintenance.png')}}" class="img-fluid ht-50"
                                    alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Maintenance </span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Set Manual Value for
                                        testing.</span>
                                </div>
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </a>
                </div>
                @endif

                @if (env('OTHER') == 'ON' || env('OTHER') == '1' )
                <div class="col-lg-3 mg-b-20" style="z-index:999">
                    <a href="{{url('settings/other')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/other.png')}}" class="img-fluid ht-50" alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Lainnya</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Nama Tempat</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if (env('GOIOT') == 'ON' || env('GOIOT') == '1' )
                <div class="col-lg-3 mg-b-20 hilang" style="z-index:999">
                    <a href="{{url('settings/goiot')}}">
                        <div class="card shadow-base card__one bd-0 ht-100p rounded-20 animated fadeInUp">
                            <div class="card-body d-flex">
                                <img src="{{asset('backend/images/icon/goiot.png')}}" class="img-fluid ht-50" alt="">
                                <div class="mg-l-20">
                                    <span class="tx-bold tx-20  d-block  tx-inverse ">Goiot</span>
                                    <span class="tx-bold tx-11  d-block mg-b-5 tx-gray-500 ">Cloud Setting, Database
                                        Sync, Cloud Logger</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif


            </div>


        </div>
    </div>
</div>
</div><!-- br-pagebody -->
@push('js')

<script>
    var table = $('.datatable').DataTable();
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        startView: 2,
        minViewMode: 0,
        language: "id",
        daysOfWeekHighlighted: "0",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true,
        container: '#datepicker-date-area'
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
        container: '#datepicker-month-area'
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
        container: '.datepicker-area'
    });

    $('#daterange').on('change', function () {
        val = $(this).val();
        if (val == 'day') {
            $('#datepicker-date-area').removeClass('hilang ');
            const element = document.querySelector('#datepicker-date-area')
            element.classList.add('animated', 'fadeIn')
            // Hilangkan Month
            $('#datepicker-month-area').addClass('hilang ');

        } else {
            $('#datepicker-month-area').removeClass('hilang');
            const element = document.querySelector('#datepicker-month-area')
            element.classList.add('animated', 'fadeIn')
            // Hilangkan Date
            $('#datepicker-date-area').addClass('hilang ');

        }
    })

</script>
@endpush
@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection
