<li class="nav-item active"><a class="nav-link" href="index.php">Техподдержка <span class="sr-only">(current)</span></a>
</li>
<?php
if (!isset($_SESSION['email'])) {
    ?>
    <li class="nav-item"><a class="nav-link" href="login.php">Вход</a></li>
    <li class="nav-item"><a class="nav-link" href="register.php">Регистрация</a></li>
    <?php
}
?>

<li class="nav-item"><a class="nav-link" href="personalarea.php">Личный кабинет</a></li>
<li class="nav-item"><a class="nav-link" href="admin">Админпанель</a></li>

<?php
if (isset($_SESSION['email'])) {
    ?>

    <li class="nav-item"><a class="nav-link btn btn-outline-warning"
                            href="logout.php">Выход <?= " | " . $_SESSION['email'] ?></a></li>
    <?php
}
?>

