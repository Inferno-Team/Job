@extends('layouts.main')
@section('content')
<br><br><br><br><br><br><br>
   <div class="album text-muted">
     <div class="container">
      @if(Session::has('message'))

      <div class="alert alert-success">{{Session::get('message')}}</div>
      @endif
        @if(Session::has('err_message'))

      <div class="alert alert-danger">{{Session::get('err_message')}}</div>
      @endif
      @if(isset($errors)&&count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>

      @endif

       <div class="row" id="app">
          <div class="title" style="margin-top: 20px;">
                <h2>{{$job->title}}</h2> 

          </div>

      <img src="{{asset('hero-job-image.jpg')}}" style="width: 100%;">

          <div class="col-lg-8">
            
            
            <div class="p-4 mb-8 bg-white">
              <!-- icon-book mr-3-->
              <h3 class="h5 text-black mb-3"><i class="fa fa-book" style="color: blue;">&nbsp;</i>Description <a href="#"data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-envelope-square" style="font-size: 34px;float:right;color:green;"></i></a></h3>
              <p> {{$job->description}}.</p>
              
            </div>
            <div class="p-4 mb-8 bg-white">
              <!--icon-align-left mr-3-->
              <h3 class="h5 text-black mb-3"><i class="fa fa-user" style="color: blue;">&nbsp;</i>Roles and Responsibilities</h3>
              <p>{{$job->roles}} .</p>
              
            </div>
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3"><i class="fa fa-users" style="color: blue;">&nbsp;</i>Number of vacancy</h3>
              <p>{{$job->number_of_vacancy }} .</p>
              
            </div>
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3"><i class="fa fa-clock-o" style="color: blue;">&nbsp;</i>Experience</h3>
              <p>{{$job->experience}}&nbsp;years</p>
              
            </div>
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3"><i class="fa fa-venus-mars" style="color: blue;">&nbsp;</i>Gender</h3>
              <p>{{$job->gender}} </p>
              
            </div>
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3"><i class="fa fa-dollar" style="color: blue;">&nbsp;</i>Salary</h3>
              <p>{{$job->salary}}</p>
            </div>

          </div>

          
            <div class="col-md-4 p-4 site-section bg-light">
              <h3 class="h5 text-black mb-3 text-center"><b>Short Info</h3></b>
                  <p><b>Company name:</b>{{$job->company->cname}}</p>
                <p><b>Address:</b>{{$job->address}}</p>
                    <p><b>Employment Type:</b>{{$job->type}}</p>
                    <p><b>Position:</b>{{$job->position}}</p>
                    <p><b>Posted:</b>{{$job->created_at->diffForHumans()}}</p>
                    <p><b>Last date to apply:</b>{{ date('F d, Y', strtotime($job->last_date)) }}</p>



              <p><a href="{{route('company.index',[$job->company->id,$job->company->slug])}}" class="btn btn-warning" style="width: 100%;">Visit Company Page</a></p>
              <p>
        @if(Auth::check()&&Auth::user()->user_type=='seeker')
           

            @if(!$job->checkApplication())
            
            <apply-component :jobid={{$job->id}}></apply-component>
            @else
            <center><span style="color: #000;">You applied this job</span></center>
            @endif
<br>
            <favourite-component :jobid={{$job->id}} :favorited={{$job->checkSaved()?'true':'false'}}  ></favourite-component>
            @else
           <b><u> Please login to apply this job</b></u>

            @endif

 </p>
</div>
@foreach($jobRecommendations as $jobRecommendation)
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <p class="badge badge-success">{{$jobRecommendation->type}}</p>
    <h5 class="card-title">{{$jobRecommendation->position}}</h5>
    <p class="card-text">{{str_limit($jobRecommendation->description,30)}}</p>
   <center> <a href="{{route('jobs.show',[$jobRecommendation->id,$jobRecommendation->slug])}}" class="btn btn-success">Apply</a></center>
  </div>
</div>
@endforeach




<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sent job to your friend</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('mail')}}" method="POST">@csrf
      <div class="modal-body">
      	<input type="hidden" name="job_id" value="{{$job->id}}">
      	<input type="hidden" name="job_slug" value="{{$job->slug}}">
       <div class="form-group">	
        <label>Your name *</label>
        <input type="text" name="your_name" class="form-control" required="">
      </div>
      <div class="form-group">	
        <label>Your email *</label>
        <input type="email" name="your_email" class="form-control" required="">
      </div>
      <div class="form-group">	
        <label>Friend name *</label>
        <input type="text" name="friend_name" class="form-control" required="">
      </div>
      <div class="form-group">	
        <label>Friend email *</label>
        <input type="email" name="friend_email" class="form-control" required="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Mail this job</button>
      </div>
  </form>
    </div>
  </div>
</div>

</div>

</div>
</div>
</div>

<script src="{‌{ asset('js/app.js') }}"></script> 
@endsection