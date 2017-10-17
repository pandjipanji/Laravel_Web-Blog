<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
	<title>Laravel 5</title>
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-material-design.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/ripples.css')}}">
	<style>
	body{
		background-color: #ebebeb;
		padding-top: 60px;
	}
	</style>
</head>
<body>
<!--bagian navigation-->
@include('shared.head_nav')
<!--bagian content -->
<div class="container clearfix">
	<div class="row row-offcanvas">
		<div id="main-content" class="col-xs-12 col-sm-12 main">
			<div class="panel-body">
				@if(Session::has('error'))
				<div class="alert alert-danger">
					{{Session::get('error')}}
				</div>
				@endif
				@if(Session::has('notice'))
					<div class="alert alert-success">
						{{Session::get('notice')}}
					</div>
				@endif
				@if(count($errors) > 0)
					<div class="alert alert-danger">
					@foreach($errors->all() as $message)
							{!! $message !!} <br>
					@endforeach
					</div>
				@endif
				@yield("content")
			</div>
		</div>
	</div>
</div>
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/material.js')}}"></script>
<script src="{{asset('js/ripples.js')}}"></script>
</body>
</html>