@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style=color:#4997D0>
                        <h3><b>Create a job</h3></b>
                    </div>
                    <div class="card-body">


                        <form action="{{ route('job.store') }}" method="POST">@csrf

                            <div class="form-group">
                                <label for="title"><b>Title:</b></label>
                                <input type="text" name="title"
                                    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                    value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description"><b>Category:</b></label>
                                <select name="category" class="form-control">
                                    @foreach (App\Category::all() as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="role"><b>Role:</b></label>
                                <textarea name="roles" class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}">{{ old('roles') }}</textarea>
                                @if ($errors->has('roles'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="description"><b>Description:</b></label>
                                <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="position"><b>Position:</b></label>
                                <input type="text" name="position"
                                    class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}"
                                    value="{{ old('position') }}">
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address"><b>Address:</b></label>
                                <input type="text" name="address"
                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                    value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address"><b>No of vacancy:</b></label>
                                <input type="text" name="number_of_vacancy"
                                    class="form-control {{ $errors->has('number_of_vacancy') ? 'is-invalid' : '' }}"
                                    value="{{ old('number_of_vacancy') }}">
                                @if ($errors->has('number_of_vacancy'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('number_of_vacancy') }}</strong>
                                    </span>
                                @endif
                                <div class="form-group">
                                    <label for="address"><b>Years of experience:</b></label>
                                    <input type="text" name="experience"
                                        class="form-control {{ $errors->has('experience') ? 'is-invalid' : '' }}"
                                        value="{{ old('experience') }}">
                                    @if ($errors->has('experience'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('experience') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label for="type"><b>Gender:</b></label>
                                    <select class="form-control" name="gender">
                                        <option value="any">Any</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="type"><b>Salary:</b></label>
                                    <select class="form-control" name="salary">
                                        <option value="negotiable">Negotiable</option>
                                        <option value="2000-5000">2000-5000</option>
                                        <option value="5000-10000">5000-10000</option>
                                        <option value="10000-20000">10000-20000</option>
                                        <option value="30000-500000">30000-500000</option>
                                        <option value="500000-600000">500000-500000</option>
                                        <option value="600000 plus">600000 plus</option>
                                    </select>
                                </div>



                            </div>



                            <div class="form-group">
                                <label for="type"><b>Type:</b></label>
                                <select class="form-control" name="type">
                                    <option value="fulltime">fulltime</option>
                                    <option value="parttime">parttime</option>
                                    <option value="casual">casual</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status"><b>Status:</b></label>
                                <select class="form-control" name="status">
                                    <option value="1">live</option>
                                    <option value="0">draft</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="lastdate"><b>Last date:</b></label>
                                <input type="text" id="datepicker" name="last_date"
                                    class="form-control {{ $errors->has('last_date') ? 'is-invalid' : '' }}"
                                    value="{{ old('last_date') }}">
                                @if ($errors->has('last_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_date') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group" style="display: flex;align-items: baseline;">
                                <label for="lastdate"><b>Age:</b></label>
                                <div style="width: 400px;display: inline-block;margin-left: 3rem">
                                    <b id="age_min"></b>
                                    <input name="age_min" type="hidden" id="age_min_input">
                                    <div id="slider-range"
                                        style="display: inline-block; margin-left: 10px ; margin-right: 10px; width: 300px">
                                    </div>
                                    <b id="age_max"></b>
                                    <input name="age_max" type="hidden" id="age_max_input">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success"
                                    style=background-color:#4997D0>Submit</button>
                            </div>

                            @if (Session::has('message'))
                                <div class="alert alert-success">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
