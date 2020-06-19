<?php
session_start();
if (empty($_SESSION['username'])) {
//  echo "Необходимо войти в систему!";
  header("Location: /admin/log-in.php");

}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin Panel | Запросы на техподдержку</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.html" class="nav-link">Главная</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="support-admin.php" class="nav-link">Заявки на техническую поддержку</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="user-admin.php" class="nav-link">Пользователи</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="log-out.php" class="nav-link">Выход <?= "| " . $_SESSION['username'] ?></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Admin Panel" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminPanel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo "Admin User"; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Меню администратора
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Главная</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="support-admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Заявки на техподдержку</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Пользователи</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="log-out.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Выход <?= "| " . $_SESSION['username'] ?></p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Создание отчетов</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Главная</a></li>
              <li class="breadcrumb-item active">Заявки на техподдержку</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?php
        require_once("../RedBeanPHP5_4_2/rb.php");
        R::setup('mysql:host=mysql_techsupport;port=3306;dbname=db_techsupport', 'root', 'root3004917779');
        ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div id="tutor_id">
                  <form method="post" class="no-print">
                    <div class="form-row col-md-6 mb-4">
                      <div class="col">
                        <label for="dateoforder" hidden> </label>
                        <select class="form-control form-inline" name="dateoforder" id="dateoforder">
                          <option value="" selected disabled hidden>Выбрите дату</option>
                          <?php
                          function get()
                          {
                            return R::getAll("SELECT distinct DATE_FORMAT(dateoforder, '%Y-%m-%d') as dateoforder FROM support");
                          }

                          foreach (get() as $tutor) { ?>
                            <option value="<?php echo $tutor['dateoforder']; ?>">
                              <?php echo $tutor['dateoforder']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col">
                        <label for="status" hidden> </label>
                        <select class="form-control" name="status" style="text-transform: uppercase;" id="status">
                          <option value="" selected disabled hidden>Выбрать статус</option>
                          <option value="1" class="text-primary">active</option>
                          <option value="2" class="text-success">in process</option>
                          <option value="3" class="text-danger">inactive</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="submit"> </label>
                        <input type="submit" value="Показать" class="btn btn-primary" id="submit">
                        <button class="btn btn-primary" onclick="window.print();">Печать</button>

                      </div>
                    </div>
                  </form>
                  <table class="table table-hover">
                    <thead>
                    <tr>
                      <th>Вопрос</th>
                      <th>Пользователь</th>
                      <th>Дата заявки</th>
                      <th>Статус</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($_POST['dateoforder'] and $_POST['status']) {
                      $dateoforder = $_POST['dateoforder'];
                      $status = $_POST['status'];
                      $supports = R::getAll("SELECT * FROM support WHERE DATE_FORMAT(dateoforder, '%Y-%m-%d') = '{$dateoforder}' AND status ='{$status}'");
                    }
                    if ($_POST['dateoforder'] and !$_POST['status']) {
                      $dateoforder = $_POST['dateoforder'];
                      $supports = R::getAll("SELECT * FROM support WHERE DATE_FORMAT(dateoforder, '%Y-%m-%d') = '{$dateoforder}'");
                    }
                    if (!$_POST['dateoforder'] and $_POST['status']) {
                      $status = $_POST['status'];
                      $supports = R::getAll("SELECT * FROM support WHERE status = '{$status}'");
                    }
                    if (!$_POST) {
                      $supports = R::getAll('SELECT * FROM support');
                    }
                    foreach ($supports as $support) {
                      $id = $support['id'];
                      switch ($support['status']) {
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
                      echo "<tr>
                        <td style='width: 70%;'>" . $support['question'] . "</td>
                        <td>" . $support['username'] . "</td>  
                        <td>" . $support['dateoforder'] . "</td>   
                         <td class='" . $style . "' style='width: 20%; text-transform: uppercase; font-weight: bold;'>" . $value . "</td>          
                      </tr>";
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer no-print">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date("Y") ?> <a href="/">AdminPanel</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
