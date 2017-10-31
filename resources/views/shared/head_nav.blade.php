<div class="navbar navbar-fixed-top navbar-default" role="navigation">
		<div class="container">
		<div class="navbar-header">
		
		<button type="button" class="navbar-toggle" data-
		toggle="collapse" data-target=".navbar-collapse">
		
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"/>
		<span class="icon-bar"/>
		<span class="icon-bar"/>
		</button>
		<a href="#" class = "navbar-brand">Laravel 5 App</a>
		</div>
		<div class="collapse navbar-collapse">
	    <ul class="nav navbar-nav navbar-left">
	      <li><a href="{{url('/')}}">Home</a></li>
	      <li>{!! link_to(route('articles.index'), "Articles") !!}</li>
	    </ul>
		<ul class="nav navbar-nav navbar-right">
			@if (Sentinel::check())
				<li>{!! link_to(route('logout'), 'Logout') !!}</li>
				<li><a>Welcome {!! Sentinel::getUser()->first_name !!}</a></li>
			@else
				<li>{!! link_to(route('signup'), 'Signup') !!}</li>
				<li>{!! link_to(route('login'), 'Login') !!}</li>
			@endif
		</ul>
		</div>
	</div>
	</div>

	