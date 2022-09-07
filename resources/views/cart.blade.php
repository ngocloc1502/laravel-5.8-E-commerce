@extends ('index')
@section ('content')
	<section class="container cart">
		<section>
			<h1>Giỏ hàng</h1>
		</section>
		<section class="col">
			<?php $total = 0; ?>
			@if ($data != NULL)
				@foreach ($data as $row)
					<?php
						$total += $row->giasp * session("cart.$row->masp");
					?>
					<section class="row">
						<section class="col-md-5">
							<p>
								{{$row->tensp}}
							</p>
						</section>
						<section class="col-md-1">
							<p>
								{{$row->giasp}}
							</p>
						</section>
						<section class="col-md-1">
							<p>
								{{session("cart.$row->masp")}}
							</p>
						</section>
						<section class="col-md-2">
							<img src="{{asset('public/products-picture/'.$row->hinhanh)}}" alt="{{$row->tensp}}" class="img-rounded">
						</section>
						<section class="col-md-1">
							<p>
								{{$row->giasp * session("cart.$row->masp")}}
							</p>
						</section>
						<section class="col-md-1">
							<a href="delitem/{{$row->masp}}">
								Xóa
							</a>
						</section>
					</section>
				@endforeach
			@endif
		</section>
		<section class="f">
			<section class="col-md-3">
				Tổng tiền:
			</section>
			<section class="col-md-6">
				{{$total}}
			</section>
			<section class="col-md-3">
				<a href="checkout">
					@if (session('cart'))
						{{"Đặt hàng"}}
					@else
						{{""}}
					@endif
				</a>
			</section>
		</section>
	</section>
@endsection