<?php
require_once('php/cofig.php');
session_start();
$id=$_SESSION['id'];
$queryiden="SELECT nome, cognome
FROM Clienti
WHERE id_cliente='$id'";
$res=$connex_db->query($queryiden);
$credenziali=mysqli_fetch_array($res, MYSQLI_ASSOC);
$nome=$credenziali['nome'];
$cognome=$credenziali['cognome'];
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
                <a href="index.php" class="nav-link bi bi-house me-1"> Home</a>
            </li>
            <form class="">

                <?php

                if(isset($_SESSION['id'])){
                    echo '<li class="nav-item d-none d-sm-inline-block">
                <a href="logout.php" class="nav-link bi bi-box-arrow-left me-1"> Logout</a>
            </li>';
                }
                else{
                    echo '<li class="nav-item d-none d-sm-inline-block">
                <a href="loginclienti.php" class="nav-link bi bi-box-arrow-in-right me-1"> Login</a>
            </li>';

                }
                ?>
                <?php
                if (isset($_SESSION['id'])) {
                    echo '<li class="nav-item d-none d-sm-inline-block">
                <a href="cambiopassword.php" class="bi bi-key-fill" style="color: grey"> Cambia password</a>
            </li>';
                }
                ?>
            </form>

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
                <i class="bi bi-person-circle" style="font-size: 40px"></i>
                <div class="info">
                    <?php
                    if(isset($_SESSION['id'])) {
                        echo "<div style='font-size: 19px'>$nome $cognome</div>";
                        $queryfed = "SELECT *
                    FROM Fedelta
                    WHERE cliente='" . $_SESSION['id'] . "'";
                        if(isset($_SESSION['id'])){
                            $arrfed=$connex_db->query($queryfed);
                            if($arrfed->num_rows!=0){
                                echo "<div style='font-size: 13px'>Cliente fedele  <i class='bi bi-postcard'></i></div>";
                            }
                        }}
                    else{
                        echo "Ospite";
                    }
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
                                                Acquista
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                            </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="acquistaalbum.php" class="nav-link" style="width: 270px">
                                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                                    <p>Acquisto album musicali</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="acquistafilm.php" class="nav-link" style="width: 270px">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Acquisto film</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>' ;}
                    ?>
                    <?php if(isset($_SESSION['id'])){
                        echo ' <li class="nav-item">
                                        <a href="#" class="nav-link" style="width: 270px">
                                            <i class="nav-icon fas fa-copy"></i>
                                                     <p>
                                                <i class="bi bi-clock-history"></i>
                                                Cronologia Acquisti
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                            </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="cronologiaacquistialbum.php" class="nav-link" style="width: 270px">
                                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                                    <p> Album musicali acquistati</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="cronologiaacquistifilm.php" class="nav-link" style="width: 270px">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p> Film acquistati</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>' ;}
                    ?>


                    <li class="nav-item">
                        <a href="catalogoalbum.php" class="nav-link" style="width: 270px">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <i class="bi bi-list me-1"></i>
                            <p>
                                Catalogo Album
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="catalogofilm.php" class="nav-link" style="width: 270px">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <i class="bi bi-list me-1"></i>
                            <p>
                                Catalogo Film
                            </p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="nav-link" style="width: 270px">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                <i class="bi bi-people me-1"></i>
                                Contatti
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" >
                            <li class="nav-item" >
                                <i class="far fa-circle nav-icon"></i>
                                <p class="nav-link" style="font-size: 14; width: 270px" >matteo.piccadaci@videotecha.org </p>
                            </li>
                            <li class="nav-item">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="nav-link" style="font-size: 14; width: 270px";>antonino.mastronardo@videotecha.org</p>
                            </li>
                            <li class="nav-item">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="nav-link" style="font-size: 14; width: 270px">Tel: 0806623056</p>
                            </li>
                            <li class="nav-item">
                                <i class="far fa-circle nav-icon"></i>
                                <p class="nav-link" style="font-size: 14; width: 270px">Aperto Lun-Sab: 8:30 - 19:30</p>
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
    <div class="content-wrapper" style="padding-left: 50px">
        <div class="form-inline" style="float: right">
<span class="d-none d-lg-inline">
<input class="form-control form-control-sidebar" type="search" id="cercaartista" onkeyup="myFunction2()" placeholder="Cerca Artista..." title="Cerca Artista">
<input class="form-control form-control-sidebar" type="search" id="cercanome" onkeyup="myFunction1()" placeholder="Cerca Album..." title="Cerca Nome">
<input class="form-control form-control-sidebar" type="search" id="cercaanno" onkeyup="myFunction4()" placeholder="Cerca per data..." title="Cerca Anno">
</span>
        </div>

        <?php
        $queryacquisti="SELECT Acquisti_album.data_acquisto, Album.nome_album, Acquisti_album.quantita, Musicisti.nome_musicista, Album.prezzo_acquisto
        FROM Acquisti_album JOIN Album on Acquisti_album.articolo=Album.id_album JOIN Musicisti on Album.musicista=Musicisti.id_musicista
        WHERE Acquisti_album.cliente='$id'
        ORDER BY data_acquisto";

        $ute=$connex_db->query($queryacquisti);
        $arrute=mysqli_fetch_array($ute, MYSQLI_ASSOC);


        if(isset($_SESSION['id'])){

            echo '<div style="max-height: 800px">
<table id="album" class="table table-hover" style="width: 1100px">
<thead>
<tr>
<th scope="col"> ARTISTA </th>
<th scope="col"> ALBUM </th>
<th scope="col"> QUANTITA</th>
<th scope="col"> PREZZO PER CP.</th>
<th scope="col">DATA</th>
</tr>
</thead>
';
            if($ute=$connex_db->query($queryacquisti)){
                while($arrute=mysqli_fetch_array($ute, MYSQLI_ASSOC)) {
                    echo "<tr><th scope='row'>" .$arrute['nome_musicista']. "</th>
                           <th scope='row'>" .$arrute['nome_album']. "</th>
                           <th scope='row'>" .$arrute['quantita']. "</th>
                           <th scope='row'>" . $arrute['prezzo_acquisto'] . "</th>
                           <th scope='row'>" . $arrute['data_acquisto'] . "</th>
                         </tr>";
                }
                $ute->free();
            }
        }
       ?>
    </div>
</div>
</div>


</div>


<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->

</div>
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
        input = document.getElementById("cercanome");
        filter = input.value.toUpperCase();
        table = document.getElementById("album");
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
    function myFunction2() {
        var input, filter, table, tr, th, i, txtValue;
        input = document.getElementById("cercaartista");
        filter = input.value.toUpperCase();
        table = document.getElementById("album");
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
    function myFunction3() {
        var input, filter, table, tr, th, i, txtValue;
        input = document.getElementById("cercagenere");
        filter = input.value.toUpperCase();
        table = document.getElementById("album");
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

<script>
    function myFunction4() {
        var input, filter, table, tr, th, i, txtValue;
        input = document.getElementById("cercaanno");
        filter = input.value.toUpperCase();
        table = document.getElementById("album");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            th = tr[i].getElementsByTagName("th")[4];
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