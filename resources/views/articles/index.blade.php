@extends('layouts.application')

@section('search_sort')
    <div class="row">
        <div class="form-group  label-floating">
            <label class="col-lg-2" for="keywords">Search Article</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" id="keywords" placeholder="Type search keywords">
            </div>
            <div class="clear"></div>
        </div>
    </div> <br /> 
    <p>Sort articles by : <a id="id">ID &nbsp;<i id="ic-direction" class="fa fa-arrow-down"></i></a></p> <br />

    <div class="row">
    {!! Form::open(['route' => 'import', 'method' => 'post', 'role' =>'form', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group  label-floating">
            <label class="col-lg-2" for="import">Import Article</label>
            <div class="col-lg-3">
                {{ Form::file('import') }}
                {{ Form::text('importText',null, ['class' => 'form-control', 'placeholder' => "File of type .xlsx only"]) }}
            </div>
            <div class="col-lg-3">
                
                {!! Form::submit("Import", ['class'=>'btn btn-raised btn-info']) !!}
                
            </div>
            <div class="clear"></div>
        </div>
    {!! Form::close() !!}
    </div> <br /> 
@endsection

@section('content')
    <div id="article-list">
        @include('articles.list')
    </div>
@endsection