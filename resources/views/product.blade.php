@extends ('index')
@section ('content')
	<section class="container product">
		<section class="title row">
			<section class="col-md-6 row">
				<section class="slide text-center col-md-3">
					@foreach ($hinhanh as $key => $value)
						<img id="{{$key}}" src="{{asset ('public/products-picture/'.$value)}}" class="img-thumbnail" onclick="show_slide({{$key}})">
					@endforeach
				</section>
				<section class="slide-show text-center col-md-9">
					<img id="show_slide" src="{{asset ('public/products-picture/'.$value)}}" class="rounded">
				</section>
			</section>
			<section class="price col-md-6">
				<section>
					{{$product->tensp}}
				</section>
				<section>
					{{number_format ($product->giasp, 0, ",", ".")." vnđ"}}
				</section>
				<section>	
					<a href="{{url ('addtocart/'. $product->masp)}}" class="btn btn-danger btn-lg">
						Thêm vào giỏ hàng
					</a>
				</section>
			</section>
		</section>

		<section class="content">
			<section>
				<h2>Thông số kỹ thuật:</h2>
			</section>
			<section>
				<table class="table table-striped">
					@foreach ($specifications as $value)
						<tr>
							<th scope="row">{{$value->phancung}}</th>
							<td>{{$value->thongso}}</td>
						</tr>
					@endforeach
				</table>
			</section>
		</section>
	</section>
@endsection
