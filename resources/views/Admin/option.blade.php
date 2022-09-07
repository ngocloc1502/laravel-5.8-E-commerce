@extends ('Admin/index')
@section ('content')
	<section  class="option">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
			Thêm thông tin sản phẩm
		</button>

		<section>
			<table class="table table-hover">
				@foreach ($specifications as $row)
				<tr>

					<td>
						<a href="{{url ('/admin/cauhinh/del/'.$row->masp)}}" class="btn btn-danger">
							{{"Xóa option"}}
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
						<h5 class="modal-title" id="exampleModalLongTitl">
							Thêm thông tin sản phẩm
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</section>
					<form method="post">
						@csrf
						<section class="modal-body" id="option">
							<section>
								<input name="tensp" list="keyword" class="form-control" onclick="create_input()">
								<datalist id="keyword">
									@foreach ($products as $row)
										<option value="{{$row->tensp}}">
										</option>
									@endforeach
								</datalist>
							</section>
						</section>
						<section class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
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