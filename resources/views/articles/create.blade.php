@extends('layouts.application')
@section('content')
<h3>Create a Article</h3>
    {!! Form::open(['route' => 'articles.store', 'class'=>'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
@include('articles.form')
    {!! Form::close()!!}
@endsection