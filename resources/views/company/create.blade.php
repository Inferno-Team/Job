@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->company->logo))
        <img src="{{asset('avatar/man.jpg')}}"width="100" style="width:100%;">
        @else 
 <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}"style="width:100%;">
        @endif

        <br><br>
  <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">@csrf
             <div class="card">
            <div class="card-header"><font color=#4997D0><h5><b>Update Company Logo</h5></b></font></b></div>
            <div class="card-body">
               <input type="file" class="form-control" name="company_logo"><br>
               <button class="btn btn-success float-right" type="submit"style="background-color:#4997D0;">Update</button>
           
            </div>

           </div>
                  @if($errors->has('avatar'))
           <div class="alert alert-danger" style="color:red;" style="font:small;">
            {{$errors->first('avatar')}}
        </div>
            @endif
       </form>




        </div>
        
        <div class="col-md-5">
        <div class="card">
        <div class="card-header"><font color=#4997D0><h5><b>Update Your Company Information</h5></b></font></div>

        <form action="{{route('company.store')}}" method="POST">@csrf
        <div class="card-body">
            <div class="form-group">
             <label for=""><b>Address</b></label>
             <input type="text" class="form-control" name="address" value="{{Auth::user()->company->address}}" >
              </div>

            <div class="form-group">
             <label for=""><b>Phone number</b></label>
             <input type="text" class="form-control" name="phone" value="{{Auth::user()->company->phone}}">
        </div>

           <div class="form-group">
             <label for=""><b>Website</b></label>
             <input type="text" name="website"class="form-control" value="{{Auth::user()->company->website}}">
          

            </div>

            <div class="form-group">
             <label for=""><b>Slogan</b></label>
            <input type="text" name="slogan"class="form-control" value="{{Auth::user()->company->slogan}}">
            </div>

            <div class="form-group">
             <label for=""><b>Description</b></label>
          <textarea name="description" class="form-control" >
            {{Auth::user()->company->description}}
          </textarea>
            </div>



             <div class="form-group">
             <button class="btn btn-success" type="submit"style="background-color:#4997D0;">Update</button>

            </div>




         </div>   




        </div>    
        @if(Session::has('message'))
        <div class="alert alert-success">
         {{Session::get('message')}}
         </div>
        @endif
         
         </div>   
</form>
         <div class="col-md-4">
           <div class="card">
            <div class="card-header"><font color=#4997D0><h5><b>Your Information</h5></b></font></div>
            <div class="card-body">
           <p><b><u>Company name: </b></u>{{Auth::user()->company->cname}}</p>
           <p><b><u>Company Address: </b></u>{{Auth::user()->company->address}}</p>
           <p><b><u>Company phone: </b></u> {{Auth::user()->company->phone}}</p>
           <p><b><u>Company Website: </b></u>{{Auth::user()->company->website}}</p>
       <p><a href="company/{{Auth::user()->company->slug}}">View</a></p>




            
            </div>
           </div>
           <br>


<form action="{{route('cover.photo')}}" method="POST" enctype="multipart/form-data">@csrf
           <div class="card">
            <div class="card-header"><font color=#4997D0><h5><b>Update coverletter</h5></b></font></div>
            <div class="card-body">
               <input type="file" class="form-control" name="cover_photo"><br>
               <button class="btn btn-success float-right" type="submit"style="background-color:#4997D0;">Update</button>
                @if($errors->has('cover_letter'))
           <div class="alert alert-danger" style="color:red;">
            {{$errors->first('cover_letter')}}
            @endif
            </div>
           </div>
   </form>        




         </div>
        
    </div>
</div>
@endsection
