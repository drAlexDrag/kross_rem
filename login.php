<?php
require 'connect.php';
$data=$_POST;
if (isset($data['doLogin'])) {
	$errors=array();
	$user=R::findOne('users', 'login=?', array($data['login']));
	if ($user) 
	{
		//$password=($user->password);
		// echo($user->password);
		// echo($data['password']);
		if (trim($user->password)==md5($data['password'])) {
			$_SESSION['loginUser']=$user;
			$_SESSION['login']=$user->login;
			$_SESSION['admin']=$user->admin;
			echo'<div class="alert alert-success" role="alert">Пользователь успешно авторизованы. <a href="/">Перейти на главную</a></div>';
			echo '<script>window.location="index.php";</script>';
		}
		else
		{
			$errors[]='Неверный пароль';
		}


	} 
	else {
		$errors[]='Пользователь с таким именем не существует';
		
	}

	if (! empty($errors)) {
		echo '<div class="alert alert-danger" role="alert">Ошибка авторизации: '.array_shift($errors).'</div>';
	}
	
}
?>
<html>
<head>
	<title>Авторизация пользователей</title>
	<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<link rel="stylesheet" href="/css/bootstrap.min.css" />
	</head>
<body>
<div class="container">
  <h2 class="text-center">Авторизация пользователя</h2>
  <hr>
	<form class="form-horizontal well" action="login.php" method="post">

		<div class="form-group">

			<label class="control-label col-sm-2" for="login" placeholder="Ваш логин:">Ваше имя:</label>
			<div class="col-sm-3">
			<input type="text" class="form-control" name="login" id="login"  autofocus placeholder="Имя пользователя"/>
			</div></div>

			<div class="form-group">
			<label class="control-label col-sm-2" for="password" placeholder="Ваш пароль:">Ваш пароль:</label>
			<div class="col-sm-3">
			<input type="password" class="form-control" name="password" id="password" placeholder="Пароль пользователя"/>
			<!-- <input type="text" class="form-control admin"  placeholder="База"/> -->
		</div></div>
		<div class="form-group">
      <div class="col-sm-offset-2 col-sm-6">
			<input type="submit" class="btn btn-default" name="doLogin" id="doLogin" value="Авторизоваться" />
		</div></div>
	</form>
	<hr>
	<div class="row"><img src="/images/telefon.gif" alt="альтернативный текст"></div>
 </div>

</body>
</html>