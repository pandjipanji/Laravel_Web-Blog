@extends("layouts.application")
@section("content")
    <article class="row">
        <h2><i>{!! $article->title !!}</i></h2>
        <div>{!! $article->content !!}</div>
        <hr>
        @if(!empty($images))
            <div class="row text-center">
            @foreach($images as $image)
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><strong>{{ substr($image->image,15) }}</strong></h4>
                    </div>
                    <div class="panel-body">
                        <img src="{{asset($image->image)}}" alt="" class=img-responsive style"height:250px;">
                    </div>
                    <div class="panel-footer clearfix">
                {!! link_to_route('show_img', "Edit",$image->id, ['class' => 'btn btn-raised btn-info pull-right']) !!}
                    
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
        @endif
        
        
        
    </article>
    <div class="row">
    {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}
    
        {!! link_to(route('articles.index'), "Back", ['class' => 'btn btn-raised btn-info']) !!}
    
        {!! link_to(route('articles.edit', $article->id), 'Edit Article', ['class' => 'btn btn-raised btn-success']) !!}
    
        {!! Form::submit('Delete', array('class' => 'btn btn-raised btn-danger', "onclick" => "return confirm('are you sure?')")) !!}
    {!! Form::close() !!}
    </div>
    
    <hr>
    
    <h3><i>Give Comments</i></h3>
    
<div class="row container-fluid" style="background-color: white; border-radius: 2px; padding-bottom: 15px;">
    {!! Form::open(['route' => 'comments.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}

    <div class="form-group" style="margin-top: -10px;">
        <!--{!! Form::label('article_id', 'Title', array('class' => 'col-lg-3 control-label')) !!}-->
        <div class="col-lg-9">
            {!! Form::hidden('article_id', $value = $article->id, array('class' => 'form-control', 'readonly')) !!}
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
        {!! Form::label('content', 'Content', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-9">
            {!! Form::textarea('content', null, array('class' => 'form-control', 'rows' => 3, 'autofocus' => 'true')) !!}
            <p class="text-danger">{!! $errors->first('content') !!}</p>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
        {!! Form::label('user', 'User', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-9">
            {!! Form::text('user', null, array('class' => 'form-control')) !!}
        <p class="text-danger">{!! $errors->first('user') !!}</p> 
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
        <div class="col-lg-2"></div>
            <div class="col-lg-9">
            {!! Form::submit('Save', array('class' => 'btn btn-raised btn-primary')) !!}
            </div>
        <div class="clear"></div>
    </div>
    {!! Form::close() !!}

</div>

<hr style="background-color: rgb(124, 124, 124);">
    <h3>Comments</h3>
<div class="row">
    @foreach($comments as $comment)
        <div class="col-lg-9" style="margin:10px; padding-top:10px; background-color: white; border-radius: 3px;">
            <strong><i>{!! $comment->user !!}</i></strong>
            <p>{!! $comment->content !!}</p>
        </div>
    @endforeach
</div>
@stop