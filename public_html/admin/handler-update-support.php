<?php
//if (isset($_GET['id'])) {
//  $id = $_GET['id'];
//}
if ($_POST) {
  $name = trim(htmlspecialchars($_POST['name']));
  $address = trim(htmlspecialchars($_POST['address']));
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $type = $_POST['type'];
  $id = $_POST['id'];
  if (!empty($name)) {
    require_once("../RedBeanPHP5_4_2/rb.php");
    R::setup('mysql:host=mysql_techsupport;port=3306;dbname=db_techsupport', 'root', 'root3004917779');
    $markers = R::load('markers', $id);
    $markers->name = $name;
    $markers->address = $address;
    $markers->lat = $lat;
    $markers->lng = $lng;
    $markers->type = $type;
    R::store($markers);
    header('location: /admin/support-admin.php?msg=Запись успешно обновлена!');
  }
}
