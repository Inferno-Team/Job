@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ $show ? route('applicant') : route('jobs.show_all') }} ">

            <button style="margin-bottom:10px" class="btn btn-info">
                {{ $show ? 'show filtered applicants' : 'show all applicants' }}</button>
        </a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    @foreach ($applicants as $applicant)
                        <div class="card-header"><a
                                href="{{ route('jobs.show', [$applicant->id, $applicant->slug]) }}">{{ $applicant->title }}</a>
                        </div>

                        <div class="card-body">
                            @foreach ($applicant->users as $user)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Name:</b>{{ $user->name }}</td>
                                            <td><b>Email:</b>{{ $user->email }}</td>
                                            <td><b>Address:</b>{{ $user->profile->address }}</td>
                                            <td><b>Gender:</b>{{ $user->profile->gender }}</td>
                                            <td><b>Bio:</b>{{ $user->profile->bio }}</td>
                                            <td><b>Experience:</b>{{ $user->profile->experience }}</td>
                                            <td><b>Age:</b>{{ $user->profile->age }}</td>
                                            <td><a href="{{ Storage::url($user->profile->resume) }}">Resume</a></td>
                                            <td><a href="{{ Storage::url($user->profile->cover_letter) }}">Cover letter</a>
                                            </td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>



                        </div>
                    @endforeach
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
