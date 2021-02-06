<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down" style="z-index: 10000;"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i
                    class="icon ion-navicon-round"></i></a></div>

        <div class="input-group   wd-100p transition " style="margin: auto;position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-52%);border-right: 0px !Important;left: 60px;">
            
            <div class="wd-100p ht-100p   pd-5 pd-x-15">
                {{-- Endress+Hauser Environmental Smart System --}}
                {{-- <img style="width:100px;" class="img-fluid" src="{{asset('Pertamina.png')}}" alt=""> --}}
            </div>
            {{-- <span class="tx-18"> EHESS</span> --}}
        </div>

    </div><!-- br-header-left -->
    <div class="br-header-right">
        <div class="input-group   wd-200 transition " style="    border-right: 0px !Important">
            {{-- <div class="wd-100p ht-100p   pd-5 pd-x-15">
                <img class="img-fluid " style="height:-webkit-fill-available" src="{{asset('backend/EH_Logo-d9672165.svg')}}"
                    alt="">
            </div> --}}
            {{-- <span> BAGGING C<i class=" icon ion-ios-timer-outline"></i>UNTING SYSTEM --}}
        </div>
        <nav class="nav" data-toggle="tooltip" data-placement="left" title="{{ Auth::user()->name }}">



            <div class="dropdown">
               <a id="theButton" href="#" target="_blank" class="pos-relative" data-toggle="dropdown">
                <img src="{{asset('backend/images/icon/eh-icon.png')}}" class="ht-50" alt="">
                
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-250 animated rounded-20">
                    <div class="tx-center">
                        <a href="#"><img src="{{ asset('backend/')}}/images/users/{{ Auth::user()->avatar }}"
                                class="wd-80 rounded-circle" alt=""></a>
                        <h6 class="logged-fullname">{{ Auth::user()->name }}</h6>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <hr>
                    <div class="tx-center">
                        <span class="profile-earning-label">{{ Auth::user()->departement->name }}</span>

                    </div>
                    <hr>

                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="{{url('users/'.Auth::user()->id.'/edit')}}"><i class="icon ion-ios-person"></i>
                                Edit Profile</a></li>

                        <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="icon ion-power"></i> Sign Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
        {{-- <div class="navicon-right">
            <a id="theButton" href="{{url('monitor')}}" target="_blank" class="pos-relative">
                <button class="btn pd-y-5  btn-info " data-toggle="tooltip" data-placement="bottom"
                    title="Full Monitoring">
                    <i class="tx-20 icon  ion-ios-monitor-outline"></i>
                </button>
            </a>
        </div><!-- navicon-right --> --}}
    </div><!-- br-header-right -->
</div><!-- br-header -->
