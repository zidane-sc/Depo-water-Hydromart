<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page_title') | {{ config('app.sub_name') }}</title>
    <link rel="shortcut icon" href="{{asset('backend/images/logo/logo-2.png')}}" />
    <link href="{{ asset('backend/') }}/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css">

    <meta name="mobile-web-app-capable" content="yes">
    {{-- COMPILED CSS --}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('icons/ionicons-2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icons/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/') }}/css/bracket.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/custom.css')}}" />





    @yield('css')
</head>


<body id="" class=" style-3">
    <div id="preloader">
        <div id="loader"></div>
    </div>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo tx-18 shadow" style="z-index: 10000;">
        <a href="{{url('/')}}" class="wd-100p text-center">
            <img style="width:160px;" class="img-fluid" src='{{asset('backend/images/logo/logo-3.png')}}' alt="">
        </a>
    </div>

    @include('layouts.partials.left_panel')

    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    @if (isset($monitor))
    @include('layouts.partials.head_panel_full')
    @else
    @include('layouts.partials.head_panel')
    @endif

    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    @include('layouts.partials.right_panel')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    @yield('content')
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{ asset('js/app.js') }}"></script>

    @if($errors->any())
    <script>
        toastr.success("{{$errors->first()}}");
        toastr.options = {
        timeOut: 0,
        extendedTimeOut: 0
    };

    </script>
    @endif
    @if (session()->has('privilege'))
    <script>
        $.alert("{{session()->get('privilege')}}");

    </script>
    @endif
    {{-- ADDON --}}

    {{-- <div class="modal animated fadeIn" id="selectDevice" tabindex="-1" role="dialog" aria-labelledby="selectDevice"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content rounded-20 shadow">
                <div class="modal-header pd-10 tx-center">
                    <span class=" tx-14 " id="exampleModalLongTitle">Select Device</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group devices list-group-striped">
                        <a href="http://">
                            <li class="list-group-item  active rounded-20 card__one shadow">
                                <p class="mg-b-0"><i class="fa fa-microchip mg-r-8"></i><strong class="tx-medium">MODBUS
                                        1</strong> <span class="float-right text-success"><span
                                            class="square-8 bg-success rounded-circle"></span> Connected</span></p>
                            </li>
                        </a>

                        <a href="http://">
                            <li class="list-group-item rounded-20 card__one  shadow">
                                <p class="mg-b-0"><i class="fa fa-microchip mg-r-8"></i><strong class="tx-medium">MODBUS
                                        2</strong> <span class="float-right text-success"><span
                                            class="square-8 bg-success rounded-circle"></span> Connected</span></p>
                            </li>
                        </a>

                    </ul>
                </div>

            </div>
        </div>
    </div> --}}
    <script src="{{asset('backend/js/socket.io.js')}}"></script>
    <script>
        const socket = io('{{$global_setting->websocket_host}}:{{$global_setting->websocket_port}}');

    </script>
    @stack('js')
    <script>
        socket.on('eh-water-alarm', (data) => {
            toastr.error(data.text, data.tstamp)

        });

        function deleteData(id) {
            $.confirm({
                theme: 'material',
                title: 'Confirm!',
                content: 'Are you sure you want to delete data ?',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: 'DELETE',
                            url: route_url + '/' + id,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                location.reload();
                            },
                            error: function (data) {
                                $.alert('Failed!');
                                console.log(data);
                            }
                        });
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    },
                }
            });
        }

        function logOut() {
            $.confirm({
                theme: 'supervan',
                title: 'Confirm!',

                content: 'Are you sure you want to exit the web?',
                buttons: {
                    confirm: function () {
                        // $.alert('OK!');
                        document.getElementById('logout-form').submit();
                    },
                    cancel: function () {
                        location.reload()
                    },
                }
            });
        }

    </script>

</body>

</html>
