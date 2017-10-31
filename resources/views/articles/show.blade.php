@extends("layouts.application")
@section("content")
    <article class="row" style="background-color:rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; padding-bottom: 20px; border-radius: 2px;">
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
                {!! link_to_route('show_img', "Edit",$image->id, ['class' => 'btn btn-sm btn-raised btn-info pull-right']) !!}

                {!! Form::open(array('route' => array('delete_img', $image->id), 'method' => 'delete')) !!}
                
                {!! Form::submit('delete', ['class' =>'btn btn-sm btn-raised btn-danger pull-right', 'style' => 'margin-right: 10px;', 'onclick' => "return confirm('sure want to delete this image?')"]) !!}
                
                {!! Form::close() !!}
                
                    
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
        @endif  
        <div class="row">
            {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}
            
                {!! link_to(route('articles.index'), "Back", ['class' => 'btn btn-raised btn-info']) !!}
            
                {!! link_to(route('articles.edit', $article->id), 'Edit Article', ['class' => 'btn btn-raised btn-success']) !!}
            
                {!! Form::submit('Delete', array('class' => 'btn btn-raised btn-danger', "onclick" => "return confirm('are you sure?')")) !!}
            {!! Form::close() !!}
        </div>
    </article>
    
    
    <hr>
    
    
<div class="row container-fluid" style="background-color: white; border-radius: 2px; padding-bottom: 15px;">
<div class="row">
    <div class="col-lg-4">
    <h3><i>Give Comments</i></h3>
    <!--{!! Form::open(['class' => 'form-horizontal', 'id' => 'form_comments']) !!}-->    
            {!! Form::hidden('article_id', $value = $article->id, array('class' => 'form-control', 'id' => 'article_id' , 'readonly')) !!}
    <div class="form-group">
        {!! Form::label('content', 'Content', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-9">
            {!! Form::textarea('content', null, array('class' => 'form-control', 'id' => 'content',  'rows' => 3)) !!}
            <p class="text-danger">{!! $errors->first('content') !!}</p>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
        {!! Form::label('user', 'User', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-9">
            {!! Form::text('user', null, array('class' => 'form-control', 'id' => 'user')) !!}
        <p class="text-danger">{!! $errors->first('user') !!}</p> 
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-group">
        <div class="col-lg-2"></div>
            <div class="col-lg-9">
                <button class ="btn btn-raised btn-primary" onclick="comments()">Submit</button>
            </div>
        <div class="clear"></div>
    </div>
    <!--{!! Form::close() !!}-->
    </div>
    <div class="col-lg-8">
            <h3>Comments</h3>
            
            <div class="row" id="comment_ajax">
            
                @foreach($comments as $comment)
                    <div class="col-lg-11" style="margin:10px; padding-top:10px; background-color: #ebebeb; border-radius: 3px;">
                        <strong><i>{!! $comment->user !!}</i></strong>
                        <p>{!! $comment->content !!}</p>
                    </div>
                @endforeach
                <div id="add_comment"></div>
            </div>
    </div>
</div>
</div>

<hr style="background-color: rgb(124, 124, 124);">
    
@stop

@if(!empty($toast))
    <div id="toast_update"></div>
@endif