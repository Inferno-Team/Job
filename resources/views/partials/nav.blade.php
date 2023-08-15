<div class="site-wrap">

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <div class="site-navbar-wrap js-site-navbar bg-white">

        <div class="container">
            <div class="site-navbar bg-light">
                <div class="py-1">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <img style="width:220px; height:165px;" src="/images/logo2.png"></img>
                        </div>
                        <div class="col-10">
                            <nav class="site-navigation text-right" role="navigation">
                                <div class="container">
                                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                            class="site-menu-toggle js-menu-toggle text-black"><span
                                                class="icon-menu h3"></span></a></div>

                                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        @if (!Auth::check())
                                            <li><a href="/register" style="color:black;"><b>For Job Seeker</b></a></li>
                                            <li>
                                                <a href="{{ route('employer.register') }}" style="color:black;"><b>For
                                                        Employer</b></a>

                                            </li>
                                        @else
                                            @if (Auth::check() && Auth::user()->user_type == 'employer')
                                                <li><a href="/home" style="color:black;"><b>Dashboard</b></a></li>
                                            @endif
                                            @if (Auth::check() && Auth::user()->user_type == 'seeker')
                                                <li><a href="/user/profile" style="color:black;"><b>Profile</b></a></li>
                                            @endif

                                        @endif
                                        <li><a href="{{ route('company') }}" style="color:black;"><b>Company</b></a>
                                        </li>
                                        <li><a href="contact.html" style="color:black;"><b>Contact</b></a></li>
                                        <li>
                                            @if (!Auth::check())
                                                <button type="button"
                                                    class="btn btn-primary  text-white py-3 px-4 rounded"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    style="background-color:#4997D0;">
                                                    Login
                                                </button>
                                            @else
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
 document.getElementById('logout-form').submit();"><b>
                                                        {{ __('Logout') }}
                                                    </b></a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;"> @csrf
                                                </form>
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--modal-->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"
                                style="color:black;">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"
                                style="color:black;">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="color:black">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">


                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
