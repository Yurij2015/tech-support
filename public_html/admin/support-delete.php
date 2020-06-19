<?php
require_once("../RedBeanPHP5_4_2/rb.php");
R::setup('mysql:host=mysql_techsupport;port=3306;dbname=db_techsupport', 'root', 'root3004917779');
try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $support= R::load('support', $id);
        R::trash($support);
        header('location: /admin/support-admin.php?msg=Запись успешно удалена!');
    }
} catch (exception $e) {
    echo "Запись нельзя удалить. Есть связанные данные!";
    echo "<br><a href = '/admin/support-admin.php'>Назад</a>";
}
