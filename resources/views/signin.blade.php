@extends ('index')
@section ('content')
	<section class="container signin">
		<section>
			<h1>Đăng nhập</h1>
		</section>
		<section>
			<form class="form-horizontal" role="form" method="post">
			@csrf
				<section class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				    <section class="col-sm-12">
				    	<input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
				    </section>
				</section>
				<section class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				    <section class="col-sm-12">
				      	<input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
				    </section>	
				</section>
				<section class="form-group">
				    <section class="col-sm-offset-2 col-sm-10">
				      <section class="checkbox">
				        <label>
				          <input type="checkbox"> Remember me
				        </label>
				      </section>
				    </section>
				</section>
				<section class="form-group">
				    <section class="col-sm-offset-2 col-sm-10">
				      	<button type="submit" class="btn btn-default">Sign in</button>
				    </section>
				</section>
			</form>
		</section>
	</section>
@endsection