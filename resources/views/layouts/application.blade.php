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
				@if(Session::has('error'))
				<div class="alert alert-danger">
					{{Session::get('error')}}
				</div>
				@endif
				@if(Session::has('notice_create'))
					<div id="toast_create" class="alert alert-success hidden">
					</div>
				@endif
				@if(Session::has('notice_update'))
					<div id="toast_update" class="alert alert-success hidden">
					</div>
				@endif
				@if(Session::has('notice_delete'))
					<div id="toast_delete" class="alert alert-success hidden">
					</div>
				@endif
				@if(Session::has('notice_update_img'))
					<div id="toast_img_update" class="alert alert-success hidden">
					</div>
				@endif
				@if(Session::has('notice_delete_img'))
					<div id="toast_img_delete" class="alert alert-success hidden">
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
			if ($('#toast_create').length == 1) {
				toastr.success('New article Created');
			}

			if ($('#toast_update').length == 1) {
				toastr.success('Article Updated!!');
			}

			if ($('#toast_delete').length == 1) {
				toastr.success('Deleted Succesfully!!');
			}

			if ($('#toast_img_update').length == 1) {
				toastr.success('Image Updated Succesfully!!');
			}

			if ($('#toast_img_delete').length == 1) {
				toastr.success('Image Deleted Succesfully!!');
			}

		});
</script>
</body>
</html>