<div class="form-group">
    {!! Form::label('title', 'Title', array('class' => 'col-lg-3 control-label')) !!}
    <div class="col-lg-9">
        {!! Form::text('title', null, array('class' => 'form-control', 'autofocus' => 'true')) !!}
        <!--<div class="text-danger">{!! $errors->first('title') !!}</div>-->
    </div>
    <div class="clear"></div>
</div>

<div class="form-group">
    {!! Form::label('content', 'Content', array('class' => 'col-lg-3 control-label')) !!}
    <div class="col-lg-9">
         {!! Form::textarea('content', null, array('class' => 'form-control', 'rows' => 7)) !!}
        <!--<div class="text-danger">{!! $errors->first('content') !!}</div>-->
    </div>
    <div class="clear"></div>
</div>
@if($create == true)
    <div class="form-group">
        {!! Form::label('image', 'Image', array('class' => 'col-lg-3 control-label')) !!}
        <div class="col-lg-9">
            {{ Form::file('image[]', ['class' => 'image','multiple' => ""]) }}
            {{ Form::text('imageText',null, ['class' => 'form-control', 'placeholder' => "Browse"]) }}
        </div>
        <div class="clear"></div>
    </div>
@endif


<div class="form-group">
    <div class="col-lg-3"></div>
    <div class="col-lg-9">
        {!! Form::submit('Save', array('class' => 'btn btn-raised btn-primary')) !!}
            
           <!--{!! link_to( URL::previous(),"Back", ['class' => 'btn btn-raised btn-info']) !!}-->
           <!--The Other Way-->
           
           <a href="{{ url()->previous() }}" class="btn btn-raised btn-info">Back </a> 
    </div>
    <div class="clear"></div>
</div>