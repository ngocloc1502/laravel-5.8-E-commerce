@extends ('Admin/index')
@section ('content')
	<section class="container-fluid collections">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#them">
		  Thêm sản phẩm
		</button>

		<section>
			<table class="table table-hover">
				<tr>
					<th>Tên phân loại</th>
					<th>Mức giá</th>
					<th>Khoảng giá</th>	
				</tr>
				@foreach ($collections as $value)
					<tr>
						<td>{{$value->tenphanloai}}</td>
						<td>{{$value->mucgia}}</td>
						<td>{{$value->min." -> ".$value->max}}</td>
					</tr>
				@endforeach
			</table>
		</section>
	</section>

	<section class="modal fade" id="them" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<section class="modal-dialog modal-dialog-centered" role="document">
			<section class="modal-content">
		    	<section class="modal-header">
		       		<h5 class="modal-title" id="exampleModalLongTitle">từ khóa lựa chọn</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true">&times;</span>
		        	</button>
		      	</section>
		    	<form method="post" enctype="multipart/form-data">
					@csrf
				    <section class="modal-body row">
						<section class="col-md-6">
							<select name="phanloai" class="form-control">
								@foreach ($category as $row)
									<option>
										{{$row->tenphanloai}}
									</option>
								@endforeach
							</select>
						</section>
						<section class="col-md-6">
							<input type="text" name="mucgia" class="form-control" placeholder="Điền mức giá...">
						</section>
						<section class="col-md-6">
							<input type="number" name="min" class="form-control" placeholder="Min">
						</section>
						<section class="col-md-6">
							<input type="number" name="max" class="form-control" placeholder="Max">
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