<?php
require_once ("php/cofig.php");
session_start();
$id=$_SESSION['id'];
$queryvecchia="SELECT pass
FROM Clienti
WHERE id_cliente='$id'";
$ar=$connex_db->query($queryvecchia);
$vc=mysqli_fetch_array($ar, MYSQLI_ASSOC);
$vecchia=$vc['pass'];
$idmodifca=$id;
if(isset($_POST['conferma'])){
    $nuova=$_POST['nuova'];
    $vecchiainserita=$_POST['vecchia'];
    if (!(password_verify($vecchiainserita, $vecchia))){
         echo "<script> alert ('Qualcosa è andato storto...');
    window.location.replace('/cambiopassword.php')</script>";
        }
    else{
        $nuovapassword_hash = password_hash($nuova, PASSWORD_BCRYPT);// hashing password

        $querypassword="UPDATE Clienti
                        SET pass = '$nuovapassword_hash'
                        WHERE id_cliente='$id'";
        if ($result=$connex_db->query($querypassword)){
            echo "<script> alert('Password aggiornata correttamente!'); window.location.replace('/index.php')</script>";
        }
    } //aggiornamento password avvenuto con successo
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Aggiorna Password</title>


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
            <p class="login-box-msg">Aggiorna Password</p>
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="vecchiapassword" class="form-label">Vecchia Password</label>
                        <input type="password" class="form-control" id="vecchia" placeholder="Inserisci la tua vecchia password" name="vecchia">
                    </div>
                    <div class="col-md-12">
                        <label for="nuovapassword" class="form-label">Nuova Password</label>
                        <input type="password" class="form-control" id="nuova" placeholder="Inserisci la nuova password" name="nuova">
                    </div>
                    <br>
                    <input type="text" id="conferma" name="conferma" hidden value="1">
                    <button  type="submit" name="conferma" class="btn btn-primary"> Conferma </button>
                    <button  type="sumbit" name="indietro" class="btn btn-danger"> <a href="index.php" style="color: white"> Torna alla pagina principale</a> </button>
                </div>



            </form>

            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="src/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src=".src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="src/dist/js/adminlte.min.js"></script>

</body>