@extends ('Admin/index')
@section ('content')
	<section>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  			Launch demo modal
		</button>

		<section>
			<table class="table table-hover products">
				<tr>
					<th>Loại sản phẩm</th>
					<th>Tên hãng</th>
					<th>Phê duyệt</th>
					<th>Tình trạng</th>
				</tr>
				@foreach ($brands as $row)
					<tr>
						<td>
							{{$row->tenphanloai}}
						</td>
						<td>{{$row->tenhang}}</td>
						<td>
							@if ($row->status == 1)
								{{"Chấp thuận"}}
							@else
								{{"Từ chối"}}
							@endif
						</td>
						<td>
							<a href="hangsx/del/{{$row->mahang}}" class="btn btn-danger">
								Xóa hãng sản xuất
							</a>
						</td>
					</tr>
				@endforeach
			</table>
		</section>

		<section class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<section class="modal-dialog modal-dialog-centered" role="document">
				<section class="modal-content">
					<section class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">
							Thêm hãng sản xuất
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</section>
					<form method="post">
						<section class="modal-body">
								@csrf
								<section>
									<select name="loaisp" class="form-control">
										@foreach ($category as $row)
											<option value="{{$row->maphanloai}}">{{$row->tenphanloai}}</option>
										@endforeach
									</select>
								</section>
								<section>
									<input type="text" name="tenhang" class="form-control" placeholder="Tên hãng">
								</section>
								<section>
									<select name="tthai" class="form-control">
										<option value="1">Chấp thuận</option>
										<option value="0">Từ chối</option>
									</select>
								</section>
						</section>
						<section class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-primary">
								Save changes
							</button>
						</section>
					</form>
				</section>
			</section>
		</section>
	</section>
@endsection