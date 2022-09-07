@extends ('Admin/index')
@section ('content')
	<section class="edit-item col">
		<form method="post" enctype="multipart/form-data" class="row">
			@csrf
			<section class="item-img col-md-6 row">
				<section class="slide col-md-3 text-center">
					@foreach ($photos as $key => $value)
						<img id="{{$key}}" src="{{asset ('public/products-picture/'.$value)}}" class="img-thumbnail" onclick="show_slide({{$key}})">
					@endforeach
				</section>
				<section class="slide-show col-md-9">
					<img id="show_slide" src="{{asset ('public/products-picture/'.$value)}}" class="rounded">
				</section>
			</section>
			<section class="col-md-6">
				<section class="col">
					<input type="text" name="tensp" class="form-control col-md-10" value="{{$item->tensp}}">
					<input type="text" name="giasp" class="form-control col-md-3" value="{{number_format($item->giasp, 0, ',', '.')}}">
					<select class="form-control col-md-3">
						@foreach ($brands as $value)
							@if ($value->mahang != $item->mahang)
								<option value="{{$value->mahang}}">{{$value->tenhang}}</option>
							@else
								<option value="{{$item->mahang}}" selected>{{$item->tenhang}}</option>
							@endif
						@endforeach
					</select>
					<select class="form-control col-md-3">
						@foreach ($class as $value)
							@if ($value->nhomsp != $item->nhomsp)
								<option value="{{$value->nhomsp}}">{{$value->tennhom}}</option>
							@else
								<option value="{{$item->nhomsp}}" selected>{{$item->tennhom}}</option>
							@endif
						@endforeach
					</select>
				</section>
				
				<section class="thongso">
					<section class="row">
						@foreach ($dau as $key => $value)
							<section class="input-group mb-3">
								<section class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">{{$value->phancung}}</span>
								</section>
								
								<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="{{$value->maphancung}}" value="{{$value->thongso}}">
							</section>
						@endforeach
					</section>

					<section class="row">
						@foreach ($cuoi as $key => $value)
							<section class="input-group mb-3">
								<section class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">{{$value->phancung}}</span>
								</section>
								
								<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="{{$value->maphancung}}" placeholder="Nhập thông số">
							</section>
						@endforeach
					</section>
				</section>

				<section>
					<button type="submit" class="btn btn-primary btn-lg btn-block">Xác nhận</button>
				</section>
			</section>
		</form>
	</section>
@endsection
