 

<div class="br-header">
    <div class="br-header-left">
        {{-- <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a>
        </div> --}}
        {{-- <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i
                    class="icon ion-navicon-round"></i></a></div> --}}

        <div class="input-group   wd-100p transition " style="  border-right: 0px !Important">
            <div class="wd-100p ht-100p   pd-5 pd-x-15">
                Endress+Hauser Environmental Smart System
            </div>
            {{-- <span class="tx-18"> EHESS</span> --}}
        </div>

    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">



        </nav>
        <div class="navicon-right" data-toggle="tooltip" data-placement="left" title="MyAccount">
            {{-- <button class="btn   btn-info float-right">Full Mode</button> --}}
            <a id="theButton" href="#" target="_blank" class="pos-relative" data-toggle="dropdown">
                <img src="{{asset('backend/images/icon/eh-icon.png')}}" class="ht-50" alt="">
               
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-100 pd-10">
                <a href="{{url('/login')}}" >
                    <button class="btn wd-100p btn-magenta tx-bold tx-white">LOGIN</button>
                </a>
            </div><!-- dropdown-menu -->
        </div><!-- navicon-right -->
    </div><!-- br-header-right -->
</div><!-- br-header -->
