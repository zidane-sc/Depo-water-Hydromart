<div class="br-sideleft sideleft-scrollbar bg-white shadow tx-black-5 {{(!isset($monitor)) ?: 'hilang'}}">
    <ul class="br-sideleft-menu">
        <label class="sidebar-label pd-x-10 mg-t-20 op-3">NAMA TEMPAT : </label>
        <li class="br-menu-item" style="text-align: center;">
            <label  class=" ">
                <span class="">
                    <img style="width:150px;" class="img-fluid" src='{{asset('backend/images/logo/'.$global_setting->logo)}}' alt="">
                </span>
                <br>
            </label >
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <label  class="br-menu-link rounded-10 ">
                <span class="menu-item-label mg-l-0 tx-13">
                    <i class="menu-item-icon fa fa-industry tx-10"></i>
                    {{$global_setting->plant_name}}
                    <br>
                    <span class="tx-light tx-13">
                        <i class="menu-item-icon  fa fa-map-marker tx-23"></i>  {{$global_setting->location}}
                    </span>
                </span>
                <br>
            </label >
        </li><!-- br-menu-item -->
        <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigasi</label>

        <li class="br-menu-item">
            <a href="{{url('dashboard')}}" class="br-menu-link rounded-10">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">Dashboard</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->

        <li class="br-menu-item">
            <a href="{{url('trending/report')}}" class="br-menu-link rounded-10">
                <i class="menu-item-icon icon ion-arrow-graph-up-right tx-24"></i>
                <span class="menu-item-label">Laporan Trending</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        {{-- <li class="br-menu-item">
            <a href="{{url('alarm/alarm-list')}}" class="br-menu-link rounded-10">
                                <i class="menu-item-icon icon ion-ios-alarm-outline tx-20"></i>

                <span class="menu-item-label">Alarm</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->


        <li class="br-menu-item">
            <a href="{{url('api/logs')}}" class="br-menu-link rounded-10">
                <i class="menu-item-icon icon ion-ios-cloud-upload-outline tx-24"></i>
                <span class="menu-item-label">Api Logs</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="{{url('api/connection-logs')}}" class="br-menu-link rounded-10">
                <i class="menu-item-icon icon ion-wifi tx-24"></i>
                <span class="menu-item-label">Connection Logs</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item --> --}}

        <li class="br-menu-item">
            <a href="{{url('consumption')}}" class="br-menu-link rounded-10">
                <i class="menu-item-icon icon ion-ios-cloud-upload-outline tx-24"></i>
                <span class="menu-item-label">Konsumsi</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->

        <li class="br-menu-item">
            <a href="{{url('settings')}}" class="br-menu-link rounded-10">
                <i class="menu-item-icon ion-ios-cog-outline tx-24"></i>
                <span class="menu-item-label">Pengaturan</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <!-- <li class="br-menu-item">
            <a href="{{ route('logout') }}" class="br-menu-link rounded-10" onclick=" event.preventDefault();
                    var r = confirm('Are you sure want Logout?');
                if (r == true) {
                 document.getElementById('logout-form').submit();
                } else {
                 return false
                }
                 "><i class="menu-item-icon icon ion-power "></i>
                <span class="menu-item-label">Logout</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li> -->
        {{-- <li class="br-menu-item" >
            <a onclick="logOut()" class="br-menu-link rounded-10">
                <i class="menu-item-icon icon ion-power tx-20"></i>
                <span class="menu-item-label tx-bold">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li> --}}

    </ul><!-- br-sideleft-menu -->
            </form>

    	<label class="sidebar-label pd-x-10 mg-t-20 " style="position: absolute; bottom: 0px;">POWERED BY : <img src="{{asset('backend/images/logo/goiot-logo.png')}}" alt="" style="max-width: 100px;">  </label> 

<!--     <br>
    <div class="row">
        <div class="mx-auto mt-auto bg-grandeur" style="margin-auto:200px;">
            <img src="{{asset('backend/images/logo/goiot-logo.png')}}" alt="" class=" img-fluid float-right animated fadeIn mt-1" style="width: 5rem;">
            <span class="tx-center tx-20 tx-bold tx-digital float-right animated fadeIn ">Support by &nbsp;</span>
        </div>
    </div> -->
</div><!-- br-sideleft -->
