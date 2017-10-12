@extends("layouts.application")
@section("content")
    <article class="row">
        <h2>{!! $article->title !!}</h2>
        <div>{!! $article->content !!}</div>
    </article>
<div>
    {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}

    {!! link_to(route('articles.index'), "Back", ['class' => 'btn btn-raised btn-info']) !!}

    {!! link_to(route('articles.edit', $article->id), 'Edit', ['class'=> 'btn btn-raised btn-warning']) !!}

    {!! Form::submit('Delete', array('class' => 'btn btn-raised btn-danger', "onclick" => "return confirm('are you sure?')")) !!}
    
    {!! Form::close() !!}
</div>
@stop