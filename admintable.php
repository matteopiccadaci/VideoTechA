<?php
require_once ('php/cofig.php');
session_start();
$id=$_SESSION['id'];
$queryadmin="SELECT nome, cognome, mail
FROM Amministratori
WHERE id_amministratore='$id'";
$res=$connex_db->query($queryadmin);
$arr=mysqli_fetch_array($res, MYSQLI_ASSOC);
$nome=$arr['nome'];
$cognome=$arr['cognome'];
$mail=$arr['mail'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Videotech-A</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <script type="text/javascript" src="src/dist/adminlte.min.js"></script>
    <script type="text/javascript" src="src/js/bootstrap.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="padding-left: 48px">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="homeadmin.php" class="nav-link bi bi-house me-1"> Home</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="nuovoadmin.php" class="nav-link bi bi-person-plus-fill me-1"> Inserisci un nuovo amministratore</a>
            </li>

            <form class=""><?php
                if(isset($_SESSION['id'])){
                    echo '<li class="nav-item d-none d-sm-inline-block">
                <a href="logout.php" class="nav-link bi bi-box-arrow-left me-1"> Logout</a>
            </li>';}
                ?></form>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary" style="width: 290px;">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <span class="brand-text font-weight-light">VideoTech-A</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="width: 290px; padding-bottom: 10px">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-4 pb-3 mb-4 d-flex">
                <i class="bi bi-person-workspace" style="font-size: 40px"></i>
                <div class="info">
                    <?php
                    echo "<div style='font-size: 19px'>$nome $cognome</div>";
                    echo "<div style='font-size: 14px'>Amministratore</div>";
                    ?>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Cerca qui" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="bi bi-search"></i>
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <?php if(isset($_SESSION['id'])){
                        echo ' <li class="nav-item">
                                        <a href="#" class="nav-link" style="width: 270px">
                                            <i class="nav-icon fas fa-copy"></i>
                                                     <p>
                                                <i class="bi bi-bag me-1"></i>
                                                Movimenti
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                            </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="cronologiaacquistialbumadmin.php" class="nav-link" style="width: 270px">
                                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                                    <p> Acquisti Album</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="cronologiaacquistifilmadmin.php" class="nav-link" style="width: 270px">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> Acquisti film</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>' ;}
                    ?>


                    <li class="nav-item">
                        <a href="catalogoalbumadmin.php" class="nav-link" style="width: 270px">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <i class="bi bi-list me-1"></i>
                            <p>
                                Catalogo Album
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="catalogofilmadmin.php" class="nav-link" style="width: 270px">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <i class="bi bi-list me-1"></i>
                            <p>
                                Catalogo Film
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="listamusicisti.php" class="nav-link" style="width: 270px">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <i class="bi bi-person-lines-fill me-1"></i>
                            <p>
                                Lista Musicisti
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="listaregisti.php" class="nav-link" style="width: 270px">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <i class="bi bi-person-lines-fill me-1"></i>
                            <p>
                                Lista Registi
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="admintable.php" class="nav-link" style="width: 270px">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <i class="bi bi-person-rolodex me-1"></i>
                            <p>
                                Amministratori
                            </p>
                        </a>
                    </li>
                </ul>

            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="padding-left: 55px">

        <?php
        $queryalladmin="SELECT id_amministratore, nome, cognome, mail
FROM Amministratori";
        $res2=$connex_db->query($queryalladmin);
        $arr2=mysqli_fetch_array($res2, MYSQLI_ASSOC);

        if(isset($_SESSION['id'])) {
            echo '<div>
  <div class="form-inline" style="float: right"><span class="d-none d-lg-inline"><input class="form-control form-control-sidebar" type="search" id="cercaid" onkeyup="myFunction1()" placeholder="Cerca per ID..." title="Cerca ID">
  <input class="form-control form-control-sidebar" type="search" id="cercanome" onkeyup="myFunction2()" placeholder="Cerca per Nome..." title="Cerca Nome">
  <input class="form-control form-control-sidebar" type="search" id="cercacognome" onkeyup="myFunction3()" placeholder="Cerca per Cognome..." title="Cerca Cognome"></span></div>
  
</div> ';

            echo '<div style="overflow:auto;max-height: 800px;max-width: 1100px; min-width: 1100px">
<table id="admin" class="table table-hover" style="width: 1100px">
<thead>
<tr>
<th scope="col" > ID</th>
<th scope="col"> NOME </th>
<th scope="col"> COGNOME</th>
<th scope="col">MAIL</th>
<th scope="col" class="text-center">AGGIORNA PASSWORD</th>';
            if ($_SESSION['id'] == 3 || $_SESSION['id'] == 1) {
                echo '<th scope="col" class="text-center">ELIMINA</th>';
            } else
                echo '<th></th>';
            echo '</tr></thead>';

            if ($res2 = $connex_db->query($queryalladmin)) {
                while ($arr2 = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
                    if ($_SESSION['id'] == 3 || $_SESSION['id'] == 1) {
                        echo "<tr><th scope='row'>" . $arr2['id_amministratore'] . "</th><th scope='row'>" . $arr2['nome'] . "</th><th scope='row'>" . $arr2['cognome'] . "</th><th scope='row' style='alignment: center'>" . $arr2['mail'] . "</th>
                          ";
                        if ($arr2['id_amministratore'] == 3 || $arr2['id_amministratore'] == 1) {
                            echo "<th scope='row' style='alignment: right' class='text-center'><a href='aggiornapasswordadmin.php'><button type='submit' class='bi bi-arrow-clockwise' name='modifica'></button></a></th>";
                        } else {
                            echo "<th></th>";
                        }

                        if ($arr2['id_amministratore'] != 3 && $arr2['id_amministratore'] != 1) {
                            echo "<th scope='row' style='alignment: right' class='text-center'><a href='eliminaadmin.php'><button type='submit' class='bi bi-trash-fill' name='eliminare'></button></a></th>";
                        } else {
                            echo "<th></th>";
                        }
                        echo "</tr>";

                    } else {
                        echo "<tr><th scope='row'>" . $arr2['id_amministratore'] . "</th><th scope='row'>" . $arr2['nome'] . "</th><th scope='row'>" . $arr2['cognome'] . "</th><th scope='row' style='alignment: center'>" . $arr2['mail'];
                        if ($arr2['id_amministratore'] == $_SESSION['id']) {
                            echo "</th><th scope='row' style='alignment: right' class='text-center'><a href='aggiornapasswordadmin.php'><button type='submit' class='bi bi-arrow-clockwise' name='modifica'></button></a>
                           </th></tr>";
                        } else {
                            echo "<th></th>";
                        }
                        echo "</tr>";
                    }

                }
                $res2->free();
            }

        }
        ?>
    </div>
</div>
    </div>



    <aside class="control-sidebar control-sidebar-dark">

    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="src/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="src/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>


    <script>
        function myFunction1() {
            var input, filter, table, tr, th, i, txtValue;
            input = document.getElementById("cercaid");
            filter = input.value.toUpperCase();
            table = document.getElementById("admin");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                th = tr[i].getElementsByTagName("th")[0];
                if (th) {
                    txtValue = th.textContent || th.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>



    <script>
        function myFunction2() {
            var input, filter, table, tr, th, i, txtValue;
            input = document.getElementById("cercanome");
            filter = input.value.toUpperCase();
            table = document.getElementById("admin");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                th = tr[i].getElementsByTagName("th")[1];
                if (th) {
                    txtValue = th.textContent || th.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>



    <script>
        function myFunction3() {
            var input, filter, table, tr, th, i, txtValue;
            input = document.getElementById("cercacognome");
            filter = input.value.toUpperCase();
            table = document.getElementById("admin");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                th = tr[i].getElementsByTagName("th")[2];
                if (th) {
                    txtValue = th.textContent || th.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>




</body>

</html>