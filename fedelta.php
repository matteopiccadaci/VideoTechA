<?php
require_once("php/cofig.php");
session_start();
$id=$_SESSION['id'];
$querydata="SELECT data_nascita
FROM Clienti
WHERE id_cliente='$id'";
$queryfedelta =" SELECT Fedelta.cliente
FROM Fedelta join Clienti on Fedelta.cliente=Clienti.id_cliente
WHERE Clienti.id_cliente='$id'";
    $res=$connex_db->query($querydata);
    $arr=mysqli_fetch_array($res, MYSQLI_ASSOC);
    $data_t=$arr["data_nascita"];
    $res2=$connex_db->query($queryfedelta);

    $fedelta=mysqli_fetch_array($res2, MYSQLI_ASSOC);

    $clientefed=$fedelta['cliente'];
    $convertedDate = date_create_from_format("Y-m-d", $data_t);
    $data_oggi= new DateTime (date("Y-m-d"));

    $eta=$convertedDate->diff($data_oggi)->y;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Iscrizione al programma fedeltà</title>


    <!-- AdminLTE v3 core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">


    <!-- JS ADMIN LTE V3-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">


    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

    <!-- Custom styles for this template -->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="index.php"><b>VideoTech-A</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"></p>
                <div class="row g-3">
                    <div class="col-md-12">
                        <p>
                            <?php

                            $strTodaysDate = $data_oggi->format("Y-m-d");

                            if($id==$clientefed){
                                echo"Risulti già iscritto al progamma fedeltà di VideoTech-A.";
                            }

                            elseif ($eta<18){
                                echo "Oops... non puoi registrarti se non hai almeno 18 anni.";}

                            else{
                                $queryinsert= "INSERT INTO Fedelta (data_adesione, cliente) VALUES ('$strTodaysDate', '$id')";
                                if ($inserimento=$connex_db->query($queryinsert)){
                                    echo  'Iscrizione al programma fedeltà di VideoTech-A avvenuto con successo! Ora per ogni acquisto riceverai uno sconto! Grazie per il supporto.';
                                }
                            }
                            ?>
                        </p>
                        <p>
                            <a href="index.php">Premi qui</a> per tornare alla schermata principale
                        </p>
                    </div>
            </div>


        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>

