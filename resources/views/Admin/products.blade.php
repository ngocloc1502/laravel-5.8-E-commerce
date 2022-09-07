@extends ('Admin/index')
@section ('content')
	<section class="products">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Themsanpham">
		  Thêm sản phẩm
		</button>

		<section>
			<table class="table table-hover">
				<tr>
					<th>Tên sản phẩm</th>
					<th>Phân loại sản phẩm</th>
					<th>Hãng</th>
					<th>Giá sản phẩm</th>
					<th>Hình ảnh</th>
					<th>Trạng thái</th>
					<th colspan="2">Thao tác</th>
				</tr>
				@foreach ($products as $row)
					<tr class="child">
						<td>{{$row->tensp}}</td>
						<td>{{$row->tennhom}}</td>
						<td>{{$row->tenhang}}</td>
						<td>{{number_format($row->giasp, 0, ',', '.')}}</td>
						<td>
							<?php $hinhanh = explode(', ', $row->hinhanh); ?>
							
							@foreach ($hinhanh as $key => $value)
								<img src="{{asset ('public/products-picture/'.$value)}}" class="img">
							@endforeach
						</td>
						<td>
							@if ($row->tthai == 1)
								{{"Còn hàng"}}
							@else
								{{"Hết hàng"}}
							@endif
						</td>
						<td>
							<a class="btn btn-primary" href="sanpham/edit/{{$row->masp}}">
								{{"Sửa"}}
							</a>
						</td>
						<td>
							<a class="btn btn-primary" href="sanpham/del/{{$row->masp}}">
								{{"Xóa"}}
							</a>
						</td>
					</tr>
				@endforeach
			</table>
		</section>

		<section class="modal fade" id="Themsanpham" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<section class="modal-dialog modal-dialog-centered" role="document">
				<section class="modal-content">
						<section class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">
								Thêm sản phẩm
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</section>
						<form method="post" enctype="multipart/form-data">
							@csrf
						<section class="modal-body row">
							<section class="col-md-12">
								<input type="text" name="tensp" class="form-control" placeholder="Tên sản phẩm">
							</section>
							<section class="col-md-6">
								<select name="nhomsp" id="class" class="form-control" onChange="test()">
									@foreach ($class as $row)
										<option id="{{$row->maphanloai}}" value="{{$row->nhomsp}}">{{$row->tennhom}}</option>
									@endforeach
								</select>
							</section>
							<section class="col-md-6">
								<select name="hangsx" class="form-control">
									@foreach ($brands as $row) {
										<option id="{{$row->maphanloai}}" value="{{$row->mahang}}">{{$row->tenhang}}</option>
									}
									@endforeach
								</select>
							</section>
							<section class="col-md-12">
								<input type="number" name="giasp" class="form-control" placeholder="Giá sản phẩm">
							</section>
							<section class="col-md-12">
								<label for="exampleInputFile">Chọn hình ảnh:</label>
								<input type="file" multiple id="exampleInputFile" name="image" value="Thêm hình">	
							</section>
							<section class="col-md-6">
								<select name="trangthai" class="form-control">
									<option value="1">Còn hàng</option>
									<option value="0">Hết hàng</option>
								</select>
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
	</section>
@endsection 