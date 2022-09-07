@extends ('index')
@section ('content')
	<section>
		<section>
			<section>Địa chỉ nhận hàng:</section>
			<section>{{$info->ho." ".$info->ten}}</section>
			<section>{{$info->diachi}}</section>
			<section>{{$info->sdt}}</section>
			<section><a href="#">Thay đổi</a></section>
		</section>
		<section>
			<hr>
		</section>
		<section>
			<table>
				<?php $total = 0; ?>
				@foreach ($cart as $row)
					<tr>
						<?php
							$total += $row->giasp * session("cart.$row->masp");
						?>
						<td><img src="{{asset('public/products-picture/'.$row->hinhanh)}}"></td>
						<td>{{$row->tensp}}</td>
						<td>{{$row->giasp}}</td>
						<td>{{session("cart.$row->masp")}}</td>
						<td>{{$row->giasp * session("cart.$row->masp")}}</td>
					</tr>
				@endforeach
			</table>
		</section>
		<section>
			<hr>
		</section>
		<section>
			<section>
				<section>Phương thức thanh toán:</section>
				<section></section>
				<section><a href="#">Thanh đổi</a></section>
			</section>
			<br>
			<section>
				<section>
					<section>Tổng tiền hàng: </section>
					<section>{{$total}}</section>
				</section>
				<section>
					<section>Tổng thanh toán:</section>
					<section>{{$total}}</section>
				</section>
				<section>
					<a href="buy">Đặt hàng</a>
				</section>
			</section>
		</section>
		<section>
			<hr>
		</section>
	</section>
@endsection