@extends("layouts.application")
@section('content')
    <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-primary text-center">
                    <div class="panel-heading">
                        <h4><strong>Change Image</strong></h4>
                    </div>
        {!! Form::open(['route' => ['change_img', $img->id], 'method' => 'put', 'class' => 'form-horizontal', 'role' =>'form', 'enctype' => 'multipart/form-data']) !!}        
                    <div class="panel-body">
                        <div class="col-sm-offset-2 col-sm-10" style="padding: 15px;">
                            <img src="{{asset($img->image)}}" alt="" class="img-responsive">                                      
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Image', array('class' => 'col-lg-3 control-label')) !!}
                            <div class="col-lg-9">
                                {{ Form::file('image', ['class' => 'image','multiple' => ""]) }}
                                {{ Form::text('imageText',null, ['class' => 'form-control', 'placeholder' => "Browse"]) }}
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        {{ link_to(url()->previous(), 'Back',['class' => 'btn btn-raised btn-primary pull-left']) }}
                        {!! Form::submit('Change', ['Class'=>'btn btn-raised btn-success pull-right']) !!}
                        
                        
                    </div>
        {!! Form::close() !!}
        
                </div>
            </div> 
@endsection