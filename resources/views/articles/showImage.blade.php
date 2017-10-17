@extends("layouts.application")
@section('content')
    <div class="col-sm-4">
                <div class="panel panel-primary text-center">
                    <div class="panel-heading">
                        <h4><strong>{{ substr($img->image,15) }}</strong></h4>
                    </div>
                    <div class="panel-body">
                        <img src="{{asset($img->image)}}" alt="" class=img-responsive style"height:250px;">
                    </div>
                </div>
            </div> 
@endsection