@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>Dashboard</b></div>

                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td>
                                            @if (empty(Auth::user()->company->logo))
                                                <img src="{{ asset('avatar/man.jpg') }}"width="100" style="width:100%;">
                                            @else
                                                <img
                                                    src="{{ asset('uploads/logo') }}/{{ Auth::user()->company->logo }}"style="width:50%;">
                                            @endif

                                        <td><b>Position:</b>{{ $job->position }}
                                            <br>
                                            <i class="fa fa-clock-o" aria-hidden="true">
                                            </i>&nbsp;Fulltime


                                        </td>
                                        <td><i class="fa fa-map-marker"
                                                aria-hidden="true"></i>&nbsp;<b>Adress:</b>{{ $job->address }}</td>
                                        <td><i class="fa fa-globe"
                                                aria-hidden="true"></i>&nbsp;<b>Date:</b>{{ $job->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <a href="{{ route('jobs.show', [$job->id, $job->slug]) }}">
                                                <button class="btn btn-success btn-sm"
                                                    style="width:77px;margin-top:7px">Show Info</button>
                                            </a>
                                            <a href="{{ route('job.edit', [$job->id]) }}">
                                                <button class="btn btn-dark btn-sm" style="width:77px;margin-top:7px">Edit</button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>







                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
