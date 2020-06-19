<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
}
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
        <a class="navbar-brand" href="/">TechSupport</a>
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
            <h3>Запросы на техническую поддержку</h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Вопрос</th>
                    <th>Пользователь</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once("RedBeanPHP5_4_2/rb.php");
                R::setup('mysql:host=mysql_techsupport;port=3306;dbname=db_techsupport', 'root', 'root3004917779');
                $supports = R::getAll('SELECT * FROM support ORDER BY question');
                foreach ($supports as $support) {
                    $id = $support['id'];

                    echo "<tr>
                        <td>" . $id . "</td>
                        <td>" . $support['question'] . "</td>
                        <td>" . $support['username'] . "</td>   
                      </tr>";
                }
                ?>
                </tbody>
            </table>
            <hr>
            <a href="order-add.php" class="btn btn-primary btn-sm">Добавить запрос</a>
            <hr>
        </div>
    </div>
    <?php require_once("footer.php"); ?>

</body>
</html>