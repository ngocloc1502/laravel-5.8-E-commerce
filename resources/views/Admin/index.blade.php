<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đồ án laravel - Admin</title>

	<link rel="stylesheet" type="text/css" href="{{asset('public/css/app.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/admin-style.css')}}">
</head>
<body>
	<section>
		<section class="nav">
			<section class="a">
				<a href="signin">
					@if (session('admin'))
						{{session('admin')}}
					@else
						<script>
							alert('Bạn cần đăng nhập trước');
							location ='{{url("/admin")}}';
						</script>
					@endif
				</a>
			</section>
		</section>
		
		<hr>
		
		<header>
			<section>
				Logo
			</section>
		</header>

		<hr>
		
		<section>
			<aside>
				<a href="{{url ('admin/sanpham')}}" class="btn">Sản phẩm</a>
				<a href="{{url ('admin/hangsx')}}" class="btn">Thương hiệu</a>
				<a href="{{url ('admin/linhkien')}}" class="btn">Linh kiện</a>
				<a href="{{url ('admin/collections')}}" class="btn">Từ khóa</a>
			</aside>
			
			<hr>

			<article>
				@yield('content')
			</article>
		</section>

		<hr>
		
		<footer>
			Dev by NgocLoc
		</footer>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script type="text/javascript" src="{{asset('public/js/script-admin.js')}}"></script>
</body>
</html>