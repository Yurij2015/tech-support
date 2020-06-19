<?php session_start() ?>
<?php $title = "Вход на сайт" ?>
<?php
require_once( 'forms/LoginForm.php' );
require_once( 'DB.php' );
require_once( 'Password.php' );
require_once( 'Session.php' );
require_once ('Dbsettings.php');


$msg = '';

$db   = new DB( $host, $user, $password, $db_name );
$form = new LoginForm( $_POST );

if ( $_POST ) {
	if ( $form->validate() ) {
		$email = $db->escape( $form->getEmail() );
		$password = new Password( $db->escape( $form->getPassword() ) );

		$res = $db->query( "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' LIMIT 1" );
		if ( ! $res ) {
			$msg = 'No such user found';
		} else {
			$email = $res[0]['email'];
			Session::set( 'email', $email );
			header( 'location: index.php?msg=Вы авторизированы на сайте' );
		}
	} else {
		$msg = 'Пожалуйста, заполните все поля';
	}
}
?>

<?php $msg .= $_GET['msg']; ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
    <title>Техническая подержка пользователей</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/system/">TechSupport</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
                aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <ul class="navbar-nav mr-auto">
                <?php require_once("navigation.php"); ?>
            </ul>
        </div>
    </nav>
<h4>Авторизация в системе</h4>
<b style="color: red;"><?= $msg; ?></b>
<form method="post" class="mb-5">
    <div class="form-group">
        <label for="InputEmail">Адрес электронной почты</label>
        <input type="email" class="form-control" id="InputEmail" placeholder="Ваш email" name="email"
               value="<?= $form->getEmail(); ?>">
    </div>
    <div class="form-group">
        <label for="InputPassword">Пароль</label>
        <input type="password" class="form-control" id="InputPassword" placeholder="Пароль" name="password">
    </div>

    <button type="submit" class="btn btn-primary">Войти</button>
    <a href="index.php" class="btn btn-primary">Отмена</a>

</form>
<?php include 'footer.php' ?>
