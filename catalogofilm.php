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
                echo'<li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link bi bi-cart me-1"> Carrello</a>
            </li>';}
            ?>

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
                <i class="bi bi-person-circle" style="font-size: 40px"></i>
                <div class="info">
                    <?php
                    if(isset($_SESSION['id'])) {
                        echo "<div style='font-size: 19px'>$nome $cognome</div>";
                        $queryfed = "SELECT *
                    FROM Fedelta
                    WHERE cliente='" . $_SESSION['id'] . "'";

                        if($arrfed=$connex_db->query($queryfed)){
                            echo "<div style='font-size: 13px'>Cliente fedele  <i class='bi bi-postcard'></i></div>";
                        }
                    }
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
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-copy"></i>
                                                     <p>
                                                <i class="bi bi-bag me-1"></i>
                                                I tuoi acquisti
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                            </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="pages/layout/top-nav.html" class="nav-link">//mettere link acquisti
                                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                                    <p>Acquisti</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">//mettere link noleggi
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Noleggi</p>
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

        <?php
        $queryutente="SELECT Registi.nome, Registi.cognome, Film.nome_film, Film.genere, Film.anno_pubblicazione,Film.produttore,Film.quantita_copie, Film.prezzo_acquisto
 FROM Film join Registi on Film.regista = Registi.id_regista
 ORDER BY Registi.cognome";
        $queryguest="SELECT SELECT Registi.nome, Registi.cognome, Film.nome_film, Film.genere, Film.anno_pubblicazione,Film.produttore,Film.quantita_copie
        FROM Film join Registi on Film.regista = Registi.id_regista
 ORDER BY Registi.cognome";
        $ute=$connex_db->query($queryutente);
        $gue=$connex_db->query($queryguest);
        $arrute=mysqli_fetch_array($ute, MYSQLI_ASSOC);
        $arrgue=mysqli_fetch_array($gue, MYSQLI_ASSOC);
        if(isset($_SESSION['id'])){

        echo '<table class="table table-hover"; width: 800px">
<thead>
<tr>
<th scope="col"> REGISTA </th>
<th scope="col"> NOME</th>
<th scope="col">GENERE</th>
<th scope="col">ANNO</th>
<th scope="col">PRODUTTORE</th>
<th scope="col">PREZZO ACQUISTO</th>
<th scope="col">DISPONIBILITÀ</th>
<th scope="col"> ACQUISTA</th>
</tr>
</thead>
';
        if($ute=$connex_db->query($queryutente)){
            while($arrute=mysqli_fetch_array($ute, MYSQLI_ASSOC)) {
                if($arrute['quantita_copie']>0){
                    $disp='Disponibilità immediata';
                }
                else{
                    $disp='Non disponibile';
                }
                echo "<tr><th scope='row'>" .$arrute['cognome']. ' ' . $arrute['nome'] . "</th><th scope='row'>" . $arrute['nome_film'] . "</th><th scope='row' style='alignment: center'>" . $arrute['genere'] . "</th>
                          <th scope='row'>" . $arrute['anno_pubblicazione'] . "</th>
                          <th scope='row'>" . $arrute['produttore'] . "</th>
                          <th scope='row'>" . $arrute['prezzo_acquisto'] . "</th>
                          <th scope='row'>" . $disp . "</th>
                           </th> <th scope='row' style='alignment: right'><button type='submit' name='eliminare'></button></th></tr>";
            }
            $ute->free();
        }
        }
        else{
            echo '<table class="table table-hover"; width: 850px">
<thead>
<tr>
<th scope="col"> REGISTA </th>
<th scope="col"> NOME</th>
<th scope="col">GENERE</th>
<th scope="col">ANNO</th>
<th scope="col">PRODUTTORE</th>
<th scope="col"> DISPONIBILITÀ</th>
</tr>
</thead>
';
            if($gue=$connex_db->query($queryutente)){
                while($arrgue=mysqli_fetch_array($gue, MYSQLI_ASSOC)) {
                    if($arrgue['quantita_copie']>0){
                        $disp='Disponibilità immediata';
                    }
                    else{
                        $disp='Non disponibile';
                    }
                    echo "<tr><th scope='row'>" .$arrute['cognome']. ' ' . $arrute['nome'] . "</th><th scope='row'>" . $arrgue['nome_film'] . "</th><th scope='row' style='alignment: center'>" . $arrgue['genere'] . "</th>
                          <th scope='row'>" . $arrgue['anno_pubblicazione'] . "</th>
                          <th scope='row'>" . $arrgue['produttore'] . "</th>
                          <th scope='row'>". $disp. "</th>
                          <th scope='row' style='alignment: right'><button type='submit' name='eliminare'></button></th></tr>";
                }
                $gue->free();
            }
        }
        ?>
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
</body>
</html>