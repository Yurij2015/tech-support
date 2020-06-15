<?php
if ($_POST) {
    $review = trim(htmlspecialchars($_POST['review']));
    $place = $_POST['place'];
    $username = $_POST['username'];

    require_once("RedBeanPHP5_4_2/rb.php");
    R::setup('mysql:host=mysql_techsupport;port=3306;dbname=db_techsupport', 'root', 'root3004917779');
    $reviews = R::dispense('reviews');
    $reviews->review = $review;
    $reviews->place = $place;
    $reviews->username = $username;
    R::store($reviews);
    header('location: index.php?msg=Запись успешно добавлена!');
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
            <h3>Добавить заявку </h3>
            <hr>
            <?php
//            if (!empty($_SESSION['email'])) {
                ?>

                <form method="post">
                    <div class="form-group">
                        <label for="review">Текст запроса:</label>
                        <textarea class="form-control" id="review" name="review"></textarea>
                        <input hidden name="username" value="<?= $_SESSION['email'] ?>">
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm" value="Сохранить">

                </form>

                <?php
//            } else {
//                echo "<p class='lead'> Вы не можете оставить отзыв. Войдите на сайт! </p>";
//            }
            ?>


            <hr>
        </div>
    </div>
    <?php require_once("footer.php"); ?>

</body>
</html>