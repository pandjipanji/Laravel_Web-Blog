@extends("layouts.application")
@section("content")
<h3>Edit Article</h3>
{!! Form::model($article, ['route' => ['articles.update', $article->id], 'method' => 'put', 'class' => 'form-horizontal', 'role' =>'form']) !!}

<!-- Menggunakan form yang sama untuk melakukan edit 
     Menggunakan Form::model
-->

@include('articles.form')

{!! Form::close() !!}
@stop