<?php
//if (isset($_GET['id'])) {
//  $id = $_GET['id'];
//}
if ($_POST) {
  $question = $_POST['question'];
  $username = $_POST['username'];
  $status = $_POST['status'];
  $id = $_POST['id'];
  if (!empty($question)) {
    require_once("../RedBeanPHP5_4_2/rb.php");
    R::setup('mysql:host=mysql_techsupport;port=3306;dbname=db_techsupport', 'root', 'root3004917779');
    $support = R::load('support', $id);
    $support->question = $question;
    $support->username = $username;
    $support->status = $status;
    R::store($support);
    header('location: /admin/index.php?msg=Запись успешно обновлена!');
  }
}
