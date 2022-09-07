@extends ('index')
@section ('content')
	<section class="container list-products">
	@foreach ($data as $row)
		<section class="item">
			<section class="container-fuild">
				@if (strlen($row->hinhanh) - strpos($row->hinhanh, ',') == strlen($row->hinhanh))
					<a href="{{url ('item/info/'.$row->masp)}}">
						<img src="{{asset('public/products-picture/'.$row->hinhanh)}}" class="img-rounded">
					</a>
				@else
					<a href="{{url ('item/info/'.$row->masp)}}">
						<img src="{{asset('public/products-picture/'.substr($row->hinhanh, 0, strpos($row->hinhanh, ',')))}}" class="img-rounded">
					</a>
				@endif
			</section>
			<section class="name">{{str_limit( $row->tensp, 22)}}</section>
			<section class="price">{{$row->giasp}}</section	>
		</section>
	@endforeach
	</section>
@endsection