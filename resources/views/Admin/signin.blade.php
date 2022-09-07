<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đăng nhập</title>
</head>
<body>
	<section>
		<form method="post">
			@csrf
			<section>Tên đăng nhập</section>
			<section><input type="text" name="account"></section>
			<section>Mật khẩu</section>
			<section><input type="password" name="password"></section>
			<section><input type="submit"></section>
		</form>
	</section>
</body>
</html>
