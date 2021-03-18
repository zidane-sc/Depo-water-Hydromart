<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="{{asset('backend/images/logo/logo-2.png')}}" />
	<title>Please Log In to {{ env('APP_SUBNAME') }} Environmental Smart System</title>
    <!-- vendor css -->
    <link href="{{ asset('backend/') }}/lib/%40fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('backend/') }}/css/bracket.css">
    <link rel="stylesheet" href="{{ asset('backend/') }}/css/custom.css">
</head>

<body>

    <div class="d-flex align-items-center justify-content-center ht-100v">
        <video id="headVideo" class="pos-absolute a-0 wd-100p ht-100p object-fit-cover" autoplay muted loop>
            <source src="{{asset('videos/video9.mp4')}}" type="video/mp4">
            <source src="{{asset('videos/video1.ogv')}}" type="video/ogg">
            <source src="{{asset('videos/video1.webm')}}" type="video/webm">
        </video><!-- /video -->
        <div class="overlay-body bg-black-6 d-flex align-items-center justify-content-center tx-black">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 rounded-30 bg-white">
                <img src="{{asset('backend/images/logo/logo-Hydromart.jpg')}}" class="img-fluid mg-b-30" alt="">
                <div class=" tx-center tx-18  mg-b-5 ">
                    <span class="tx-normal">Sign In </span>
                </div>

                @if(session()->has('validate'))
                <span class="text-danger" role="alert">
                    <strong>{{ session()->get('validate') }}</strong>
                </span>

                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="text"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} " name="email"
                            value="{{ old('email') }}" placeholder="Enter your Email / Username" required autofocus>

                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                        {{-- <input type="text" class="form-control fc-outline-dark" placeholder="Enter your username"> --}}
                    </div><!-- form-group -->
                    <div class="form-group">
                        <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}  " name="password"
                            placeholder="Enter your password" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                        {{-- <input type="password" class="form-control fc-outline-dark" placeholder="Enter your password"> --}}
                        {{-- <a href="#" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a> --}}
                    </div><!-- form-group -->

                    <div class="form-group row">
                        <div class="col-md-12  ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-login btn-block" style="">Sign In</button>
						<div class="mg-t-60 tx-center">Powered by:<a href="goiot.id" class="tx-info">
                            <img src="{{asset('backend/images/logo/goiot-logo.png')}}" alt="" style="max-width: 100px;">
                        </a></div>
                    {{-- <div class="mg-t-60 tx-center">Not yet a member? <a href="#" class="tx-info">Sign Up</a></div> --}}
                </form>

            </div><!-- login-wrapper -->
        </div><!-- overlay-body -->
    </div><!-- d-flex -->

    <script src="{{ asset('backend/') }}/lib/jquery/jquery.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="{{ asset('backend/') }}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function () {
            'use strict';

            // Check if video can play, and play it
            var video = document.getElementById('headVideo');
            video.addEventListener('canplay', function () {
                video.play();
            });

        });

    </script>

</body>

</html>
