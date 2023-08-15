@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if (empty(Auth::user()->profile->avatar))
                    <img src="{{ asset('avatar/man.jpg') }}"width="100" style="width:100%;">
                @else
                    <img src="{{ asset('uploads/avatar') }}/{{ Auth::user()->profile->avatar }}"width="100"
                        style="width:100%;">
                @endif

                <br><br>
                <form action="{{ route('avatar') }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header" style=color:#4997D0>
                            <h5><b>Update profile picture</h5></b>
                        </div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="avatar"><br>
                            <button class="btn btn-success float-right"
                                type="submit"style="background-color:#4997D0;">Update</button>

                        </div>

                    </div>
                    @if ($errors->has('avatar'))
                        <div class="alert alert-danger" style="color:red;" style="font:small;">
                            {{ $errors->first('avatar') }}
                        </div>
                    @endif
                </form>




            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header" style=color:#4997D0>
                        <h5><b>Update Your Profile</h5></b>
                    </div>

                    <form action="{{ route('profile.create') }}" method="POST">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for=""> <b> Address</b></label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ Auth::user()->profile->address }}">
                                @if ($errors->has('address'))
                                    <div class="alert alert-danger" style="color:red;">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif


                            </div>

                            <div class="form-group">
                                <label for=""><b>Phone number</b></label>
                                <input type="text" class="form-control" name="phone_number"
                                    value="{{ Auth::user()->profile->phone_number }}">
                                @if ($errors->has('phone_number'))
                                    <div class="alert alert-danger" style="color:red;">
                                        {{ $errors->first('phone_number') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for=""><b>Bio</b></label>
                                <textarea name="bio"class="form-control">

                 {{ Auth::user()->profile->bio }}
             </textarea>
                                @if ($errors->has('bio'))
                                    <div class="alert alert-danger" style="color:red;">
                                        {{ $errors->first('bio') }}
                                    </div>
                                @endif

                            </div>


                            <div class="form-group">
                                <label for=""><b>Experience</b></label>
                                <textarea name="experience"class="form-control">
                {{ Auth::user()->profile->experience }}
             </textarea>
                                @if ($errors->has('experience'))
                                    <div class="alert alert-danger" style="color:red;">
                                        {{ $errors->first('experience') }}
                                    </div>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for=""><b>Language</b></label>
                                <textarea name="language"class="form-control">

                 {{ Auth::user()->profile->language }}
             </textarea>
                                @if ($errors->has('Language'))
                                    <div class="alert alert-danger" style="color:red;">
                                        {{ $errors->first('Language') }}
                                    </div>
                                @endif

                            </div>


                            <div class="form-group">
                                <label for=""><b>Certificate</b></label>
                                <textarea name="certificate"class="form-control">

                 {{ Auth::user()->profile->certificate }}
             </textarea>
                                @if ($errors->has('Certificate'))
                                    <div class="alert alert-danger" style="color:red;">
                                        {{ $errors->first('Certificate') }}
                                    </div>
                                @endif

                            </div>


                            <div class="form-group">
                                <button class="btn btn-success"
                                    type="submit"style="background-color:#4997D0;">Update</button>

                            </div>




                        </div>




                </div>
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif

            </div>
            </form>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style=color:#4997D0>
                        <h5><b>Your Information</h5></b>
                    </div>
                    <div class="card-body">
                        <p><b><u>Name:</b></u>{{ Auth::user()->name }}</p>
                        <p><b><u>Email:</b></u>{{ Auth::user()->email }}</p>
                        <p><b><u>Phone number:</b></u>{{ Auth::user()->profile->phone_number }}
                        <p><b><u>Gender:</b></u>{{ Auth::user()->profile->gender }}</p>
                        <p><b><u>Experience:</b></u>{{ Auth::user()->profile->experience }}</p>
                        <p><b><u>languages:</b></u>{{ Auth::user()->profile->language }}</p>
                        <p><b><u>certificates:</b></u>{{ Auth::user()->profile->certificate }}</p>
                        <p><b><u>Member on:</b></u>{{ date('F d Y', strtotime(Auth::user()->profile->created_at)) }}</p>

                        @if (!empty(Auth::user()->profile->cover_letter))
                            <p><a href="{{ Storage::url(Auth::user()->profile->cover_letter) }}">Cover letter</a></p>
                        @else
                            <p>Please Upload Cover letter</p>
                        @endif


                        @if (!empty(Auth::user()->profile->resume))
                            <!--  <p><a href="{{ Storage::url(Auth::user()->profile->resume) }}">Resume</a></p>-->
                            <p><a
                                    href="http://localhost:81/job2/job/storage/app/public/files/RimL9khajzs1H9oPamMD6RvnpflizjoUPUkPVrwq.docx">Resume</a>
                            </p>
                        @else
                            <p>Please Upload resume</p>
                        @endif

                    </div>
                </div>
                <br>


                <form action="{{ route('cover.letter') }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header" style=color:#4997D0>
                            <h5><b>Update coverletter<h5><b>
                        </div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="cover_letter"><br>
                            <button class="btn btn-success float-right"
                                type="submit"style="background-color:#4997D0;">Update</button>
                            @if ($errors->has('cover_letter'))
                                <div class="alert alert-danger" style="color:red;">
                                    {{ $errors->first('cover_letter') }}
                            @endif
                        </div>
                    </div>
                </form>
                <br>
                <form action="{{ route('resume') }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header" style=color:#4997D0>
                            <h5><b>Update resume<h5><b>
                        </div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="resume"><br>
                            <button class="btn btn-success float-right" type="submit"
                                style="background-color:#4997D0;">Update</button>
                            @if ($errors->has('resume'))
                                <div class="alert alert-danger" style="color:red;">
                                    {{ $errors->first('resume') }}
                            @endif
                        </div>
                    </div>
                </form>



            </div>

        </div>
    </div>
@endsection
