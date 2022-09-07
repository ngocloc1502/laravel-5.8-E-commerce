@extends ('index')
@section ('content')
	<section class="container offer">
		@if ($offer != null)
			@foreach ($offer as $row)
				<a href="{{url ('collect/'.$classify.'/'.$price.'-'.$row->tenhang)}}">
					{{$row->tenhang}}
				</a>
			@endforeach
		@endif
	</section>
	<section class="container list-collections">
		@foreach ($data as $row)
			<section class="item">
				<section class="container-fuild">
					<a href="{{url ('item/info/'.$row->masp)}}">
						<img src="{{asset('public/products-picture/'.$row->hinhanh)}}" class="img-rounded">
					</a>
				</section>
				<section class="">{{$row->tensp}}</section>
				<section class="price">{{$row->giasp}}</section	>
			</section>
		@endforeach
	</section>
@endsection