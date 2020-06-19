<?php
if ($_POST) {
    $username = $_POST['username'];
    $question = htmlspecialchars($_POST['question']);
    $status = $_POST['status'];

    $id = $_POST['id'];
    require_once("RedBeanPHP5_4_2/rb.php");
    R::setup('mysql:host=mysql_techsupport;port=3306;dbname=db_techsupport', 'root', 'root3004917779');
    $support = R::load('support', $id);
    $support->question = $question;
    $support->username = $username;
    $support->status = $status;
    R::store($support);
    header('location: personalarea.php?msg=Запись успешно добавлена!');
}
?>
<?php
require_once("RedBeanPHP5_4_2/rb.php");
R::setup('mysql:host=mysql_techsupport;port=3306;dbname=db_techsupport', 'root', 'root3004917779');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $support = R::load('support', $id);
    $question = $support->question;
    $username = $support->username;
    $status = $support->status;
}
?>
<?php
session_start();
?>
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
    <div class="row">
        <div class="col-md-12">
            <hr>
            <h3>Изменить заявку </h3>
            <hr>
            <?php
            //            if (!empty($_SESSION['email'])) {
            ?>

            <form method="post">
                <div class="form-group">
                    <label for="question">Текст запроса:</label>
                    <textarea class="form-control" id="question" name="question"><?= $question ?></textarea>
                    <input hidden name="username" value="<?= $_SESSION['email'] ?>">
                </div>
                <input hidden name="id" value="<?= $id ?>">
                <?php
                switch ($status) {
                    case 1:
                        $value = "active";
                        $style = "text-primary";
                        break;
                    case 2:
                        $value = "in process";
                        $style = "text-success";
                        break;
                    case 3:
                        $value = "inactive";
                        $style = "text-danger";
                        break;
                }
                ?>
                <p>Текущий статус: <span class="font-weight-bold <?= $style ?>"><?= $value ?></span></p>
                <div class="form-group">
                    <label for="status">Статус заявки</label>
                    <select type="text" class="form-control" name="status" id="status">
                        <option value=1>active</option>
                        <option value=2>in process</option>
                        <option value=3>inactive</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary btn-sm" value="Сохранить">
                <a href="personalarea.php" class="btn btn-primary btn-sm">Назад</a>
            </form>
            <hr>
        </div>
    </div>
    <?php require_once("footer.php"); ?>

</body>
</html>