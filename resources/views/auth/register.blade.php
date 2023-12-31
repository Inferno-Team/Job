@extends('layouts.main')

@section('content')
    <script>
        function handleEvt(e, ) {
            return (e.charCode >= 48 && e.charCode <= 57) || e.charCode === 47;
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">{{ __('Job Seeker Registration') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <input type="hidden" value="seeker" name="user_type">
                            <br> <br><br><br><br>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"
                                    style="color:black;">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"
                                    style="color:black;">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <!----dob--->
                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right"
                                    style="color:black;">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input type="text" onkeypress="return handleEvt(event)" id="datepicker"
                                        class="form-control @error('dob')
is-invalid
@enderror" name="dob"
                                        value="{{ old('dob') }}" required autocomplete="dob">

                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!---end--->



                            <!---gender--->

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right"
                                    style="color:black;">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <input type="radio" name="gender" value="male" required="">Male
                                    <input type="radio" name="gender" value="female">Female


                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!---end--->











                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"
                                    style="color:black;">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"
                                    style="color:black;">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="background-color:#4997D0;">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
