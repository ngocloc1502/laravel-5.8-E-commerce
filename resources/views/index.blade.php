<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đồ án laravel</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/app.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/classed.css')}}">
</head>
<body>
	<header class="container-fluid">
		<section class="position">
			<section class="container">
				<section class="logo">
					<a href="{{url ('/')}}"><img src="{{asset ('public/logo/logo1.jpg')}}" alt="logo web" class="img-rounded"></a>
				</section>
				<section class="nav">
					<section>
						<a href="{{url('home')}}" class="btn btn-primary btn-lg active">Home</a></section>
					<section>
						<a href="{{url('order')}}" class="btn btn-primary btn-lg active">Order</a></section>
					<section>
						<a href="{{url('cart')}}" class="btn btn-primary btn-lg active">Cart</a></section>
					<section>
						<a href="{{url('signin')}}" class="btn btn-primary btn-lg active">
							@if (session('signin'))
								{{'Sign out'}}
							@else
								{{'Sign in'}}
							@endif
						</a>
					</section>
					<section>
						<a href="{{url('register')}}" class="btn btn-primary btn-lg active">
							@if (session('signin'))
								{{'Profile'}}
							@else
								{{'Register'}}
							@endif
						</a>
					</section>
				</section>
			</section>

			<section class="container-fluid row select">
				@foreach ($select as $block)
					@if ($block->maphanloai < 5)
						<section class="dropdown">
							<a class="btn btn-secondary" href="{{url ('collect/'.$block->tenphanloai)}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    	{{$block->tenphanloai}}
						  	</a>
							<section class="dropdown-content">
								@foreach ($listprice as $menu)
									@if ($menu->tenphanloai == $block->tenphanloai)
										<section>
											<a href="{{url ('collect/'.$block->tenphanloai.'/'.$menu->keyword)}}">
												{{$menu->mucgia}}
											</a>
										</section>
									@endif
								@endforeach
							</section>
						</section>
					@endif
				@endforeach
				<section class="dropdown">
					<a class="btn btn-secondary" href="{{url ('collect/'.$block->tenphanloai)}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    	Another
					</a>
						@foreach ($select as $block)
							@if ($block->maphanloai >= 5)
								<section class="dropdown-content">	
									<section>
										<a href="{{url ('collect/'.$block->tenphanloai.'/')}}">
											{{$block->tenphanloai}}
										</a>
									</section>
								</section>
							@endif
						@endforeach
					</section>
			</section>
		</section>
	</header>

	<section class="container">
		<article>
			@yield('content')
		</article>
	</section>	
	
	<footer>
		Dev by NgocLoc
	</footer>
</body>

<script type="text/javascript" src="{{asset('public/js/script-user.js')}}"></script>
</html>