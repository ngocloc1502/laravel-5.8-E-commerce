@extends ('Admin/index')
@section ('content')
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ThemLinhkien">
		  Thêm sản phẩm
	</button>

	<section class="container-fuild">
		<section class="row" onchange="list_accessories()">
			<section class="col-md-1">
				<select class="form-control">
					@foreach ($phanloai as $value)
						<option value="$value->maphanloai">{{$value->tenphanloai}}</option>
					@endforeach
				</select>
			</section>
			<section class="col-md-2">
				<select class="form-control">
					<option value="all" selected>Tất cả</option>
					@foreach ($nhomphancung as $value)
						<option value="{{$value->manhom}}">{{$value->tennhom}}</option>
					@endforeach
				</select>
			</section>
		</section>
		
		<section class="nhom">
			
		</section>
	</section>

	<section class="modal fade" id="ThemLinhkien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<section class="modal-dialog modal-dialog-centered" role="document">
			<section class="modal-content">
				<section class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">
						Thêm linh kiện
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</section>
				<form method="post" enctype="multipart/form-data">
					@csrf
					<section class="modal-body row">
						<section class="col-md-4">
							<input type="text" name="phancung" class="form-control" placeholder="Tên linh kiện">
						</section>
						<section class="col-md-8">
							<input type="text" name="thongso" class="form-control" placeholder="Thông số kĩ thuật">
						</section>
					</section>
					<section class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">
							Thêm
						</button>
					</section>
				</form>
			</section>
		</section>
	</section>
@endsection