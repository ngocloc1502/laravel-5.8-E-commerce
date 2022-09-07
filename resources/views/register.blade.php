@extends ('index')
@section ('content')
	<section class="container register">
		<section>
			<h1>Đăng kí</h1>
		</section>
		<section>
			<form method="post" role="form" class="form-horizontal">
				@csrf
				<section class="row">
					<section class="form-group col-md-4">
						<label class="control-label">Họ: </label>
						<section class="col-md-12">
							<input type="text" name="ltname" class="form-control" >
						</section>
					</section>
					<section class="form-group col-md-8">
						<label class="control-label">Tên: </label>
						<section class="col-md-3">
							<input type="text" name="ftname" class="form-control">	
						</section>
					</section>
					<section class="form-group col-md-12">
						<label class="control-label">Giới tính:</label>
						<section class="">
							<select class="form-control col-md-1">
								<option value="1">Nam</option>
								<option value="0">Nữ</option>
							</select>
						</section>
					</section>
					<section class="form-group col-md-12">
						<label for="inputEmail3" class="control-label">Email:</label>
						<section class="col-md-3">
							<input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
						</section>
					</section>
					<section class="form-group col-md-12">
						<label for="inputPassword3" class="control-label">Mật khẩu:</label>
						<section class="col-md-3">
							<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
						</section>
					</section>
					<section class="form-group col-md-12">
						<label class="control-label">Nhập lại mật khẩu:</label>
						<section class="col-md-3">
							<input type="password" name="checkout" class="form-control" id="inputPassword3" placeholder="Repeat password">
						</section>
					</section>
					<section class="form-group col-md-12">
						<label class="control-label">Số điện thoại:</label>
						<section class="col-md-3">
							<input type="tel" name="phonenumber" class="form-control" placeholder="Phone number">
						</section>
					</section>
					<section class="form-group col-md-12">
						<label class="control-label">Địa chỉ:</label>
						<section class="col-md-4">
							<input type="text" name="address" class="form-control" placeholder="Address">
						</section>
					</section>
					<section class="form-group col-md-12">
						<button class="btn btn-default btn-lg">Sign Up</button>
					</section>
				</section>
			</form>
		</section>
	</section>
@endsection