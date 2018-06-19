<?php
require 'connect.php';
if(isset($_SESSION['loginUser'])):
	$data=$_POST;
	if (isset($data['doSignup'])) {
		$errors=array();
		if (trim($data['login'])=='') {
			$errors[]='Введите логин';
		}
		if ($data['password']=='') {
			$errors[]='Введите пароль';
		}
		if ($data['passwordVerificate']!=$data['password']) {
			$errors[]='Повторный пароль неверен';
		}
		if (R::count('users', 'login=?', array($data['login']))>0) {
			$errors[]='Пользователь с таким именем существует';
		}

		if (empty($errors)) {
			$user=R::dispense('users');
			$user->login=$data['login'];
			$user->password=md5($data['password']);
			$user->admin='0';
			R::store($user);
			echo'<div class="alert alert-success" role="alert">Пользователь '.$data['login'].' успешно зарегестрирован</div>';
		} else
		{
			echo '<div class="alert alert-danger" role="alert">Ошибка регистрации: '.array_shift($errors).'</div>';
		}
	}
	?>
	<html>
	<head>
		<title>Регистрация пользователей</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/css/mystyle.css" />
	</head>
	<body>
	</div>
	<div class="container">
		<h2 class="text-center">Регистрация пользователя</h2>
		<hr>
		<form action="signup.php" method="post" class="form-horizontal well">
			<div class="form-group">
				<label class="col-md-3">Укажите имя пользователя:</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="login" id="login" value="<?php echo @$data['login'];?>" />
					<div>В имени пользователя могут быть только символы латинского алфавита, цифры, символы '_', '-', '.'. Длина имени пользователя должна быть не короче 4 символов и не длиннее 16 символов</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3">Укажите пароль пользователя:</label>
				<div class="col-md-9">
					<input type="password" class="form-control" name="password" id="password" value="<?php echo @$data['password'];?>" />
					<div>В пароле вы можете использовать только символы латинского алфавита, цифры, символы '_', '!', '(', ')'. Пароль должен быть не короче 6 символов и не длиннее 16 символов</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3">Повторите пароль пользователя:</label>
				<div class="col-md-9">
					<input type="password" class="form-control" name="passwordVerificate" id="passwordVerificate"/>
					<div>В пароле вы можете использовать только символы латинского алфавита, цифры, символы '_', '!', '(', ')'. Пароль должен быть не короче 6 символов и не длиннее 16 символов</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-6">
				<input class="btn btn-primary" type="submit" name="doSignup" id=doSignup" value="Зарегистрироваться" />
			</div>
			</div>





		</form>
		<hr>
	</div>
</body>
</html>
<?php else:
echo ("НЕ АВТОРИЗОВАНЫ !!!!!");
?>
<script>window.location="login.php";</script>
<!--a href="login.php">Авторизация</a-->
<?php endif;?>