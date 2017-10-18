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
	<link rel="stylesheet" type="text/css" href="{{asset('css/toastr.css')}}">
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
<script src="{{asset('js/toastr.min.js')}}"></script>
<script>
	toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": true,
			"positionClass": "toast-bottom-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "700",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		  }

	$(document).ready(function() {
		//load toast when page loaded
		//toastr.info('loaded');

			
			@if (Session::has('notice'))
				toastr.success("{{Session::get('notice')}}");
			@endif

			
			@if (Session::has('error'))
				toastr.error("{{Session::get('error')}}");
			@endif

			
			@if (Session::has('warning'))
				toastr.options.positionClass = 'toast-bottom-full-width';
				toastr.warning("{{Session::get('warning')}}");
			@endif
			
			
			
		});
</script>
</body>
</html>