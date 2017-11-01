<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Laravel 5</title>
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-material-design.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/buttons.dataTables.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/ripples.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/toastr.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
<div class="container-fluid clearfix">
	<div class="row row-offcanvas">
		<div id="main-content" class="col-xs-12 col-sm-12 main">
			<div class="panel-body">
				<!--@if(count($errors) > 0)
					<div class="alert alert-danger">
					@foreach($errors->all() as $message)
							{!! $message !!} <br>
 					@endforeach
					</div>
				@endif-->
				@yield('search_sort')
				
				<div id="data-content">
					@yield('content')
				</div>
				<input id="direction" type="hidden" value="asc">
			</div>
		</div>
	</div>
</div>
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script src="{{asset('js/material.js')}}"></script>
<script src="{{asset('js/ripples.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script>
	$.material.init();
	$.material.checkbox();
</script>

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
		$('#articles').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "{{ route('datatable') }}",
			"columns": [
				{data: 'id', name: 'id'},
				{data: 'title', name: 'title'},
				{data: 'content', name: 'content'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
			]
		});

			
			@if (Session::has('notice'))
				toastr.success("{{Session::get('notice')}}","Success");
			@endif

			
			@if (Session::has('error'))
				toastr.error("{{Session::get('error')}}","Failed");
			@endif

			
			@if (Session::has('warning'))
				toastr.warning("{{Session::get('warning')}}","Warning",{
					positionClass : 'toast-bottom-full-width'
				});
			@endif
			
			
			@if(count($errors) > 0)
				toastr.error("@foreach($errors->all() as $message) {!! $message !!} <br> @endforeach","Failed",{
					allowHtml : true,
					positionClass : 'toast-bottom-full-width',
					timeOut : '50000',
					progressBar : false
				});
			@endif
			
		});

		//function konfirmasi(){
		//	if()confirm('Are you sure?');
		//}
</script>

<!-- Handle ajax link in header menu-->
<script>
	$('#article_link').click(function(e){
		e.preventDefault();
		$.ajax({
			url:'/articles',
			type:"GET",
			dataType: "json",
			success: function (data)
			{
				$('#article-list').html(data['view']);
			},
			error: function (xhr, status)
			{
				console.log(xhr.error);
			}
		});
	});
</script>

<!--Hande ajax pagination-->
<script>
	$(document).ready(function() {
		$(document).on('click', '.pagination a', function(e) {
			get_page($(this).attr('href').split('page=')[1]);
			e.preventDefault();
		});
	});

	function get_page(page) {
		$.ajax({
			url : '/articles?page=' + page,
			type : 'GET',
			dataType : 'json',
			data : {
				'keywords' : $('#keywords').val(),
				'direction' : $('#direction').val()
			},
			success : function(data) {
				$('#article-list').html(data['view']);
				$('#keywords').val(data['keywords']);
				$('#direction').val(data['direction']);
			},
			error : function(xhr, status, error) {
				console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
			},
			complete : function() {
				alreadyloading = false;
			}
		});
	}
</script>

<!--Handle ajax search-->
<script>
	$('#keywords').on('keyup', function(event){
		$.ajax({
			url : '/articles',
			type : 'GET',
			dataType : 'json',
			data : {
				'keywords' : $('#keywords').val(),
				'direction' : $('#direction').val()
			},
			success : function(data) {
				$('#article-list').html(data['view']);
				$('#direction').val(data['direction']);
			},
			error : function(xhr, status) {
				console.log(xhr.error + " ERROR STATUS : " + status);
			},
			complete : function() {
				alreadyloading = false;
			}
		});
	});
</script>

<!--Handle ajax sorting-->
<script>
	

	
		$('#id').on('click', function() {
			$.ajax({
				url : '/articles',
				type : 'GET',
				dataType : 'json',
				data : {
					'keywords' : $('#keywords').val(),
					'direction' : $('#direction').val()
				},
				success : function(data) {
					$('#article-list').html(data['view']);
					$('#keywords').val(data['keywords']);
					$('#direction').val(data['direction']);

					if(data['direction'] == 'asc') {
						$('i#ic-direction').attr({class: "fa fa-arrow-up"});
					} else {
						$('i#ic-direction').attr({class: "fa fa-arrow-down"});
					}
				},
				error : function(xhr, status, error) {
					console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
				},
				complete : function() {
					alreadyloading = false;
				}
			});
		});
</script>

<script>
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		
	function comments(){
		$.ajax({
                type : "POST",
                url : "/comments",
				dataType : 'json',
            	data:{
                        'article_id' : $('#article_id').val(),
						'content'	 : $('#content').val(),
						'user'		 : $('#user').val()
                },
                success: function(success){
						if (success['status'] == "Success") {
							$('#content').val("");
							$('#user').val("");
							var tag_awal = '<div class="col-lg-11 animated slideInRight" style="margin:10px; padding-top:10px; background-color: #ebebeb; border-radius: 3px;">';
							var user = '<strong><i>'+success['user']+'</i></strong>';
							var content = '<p>'+success['content']+'</p>';
							var tag_akhir = '</div>';	
							$("#add_comment").append(tag_awal+user+content+tag_akhir);
							toastr.success(success['flash'],success['status']);
						} else {
							toastr.error(success['flash'],success['status']);
						}
						
                },
                error : function(xhr, status, error) {
					console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
				},
				complete : function() {
					alreadyloading = false;
				}
		});
				
	}
</script>
</body>
</html>