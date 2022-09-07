@extends ('index')
@section ('content')
	<section>
		<section>
			<h1>Đơn mua</h1>
		</section>
		<section>
			<section>
				<section>Mã hóa đơn</section>
				<section>Trạng thái</section>
			</section>
			@foreach ($bill as $row)
				<section>
					<section>{{$row->mahoadon}}</section>
					<section>
						@if ($row->trangthai == 1)
							{{"Đang soạn hàng"}}
						@elseif ($row->trangthai == 2)
							{{"Đang giao hàng"}}
						@else
							{{"Đã nhận hàng"}}
						@endif
					</section>
				</section>
			@endforeach
		</section>
	</section>
@endsection