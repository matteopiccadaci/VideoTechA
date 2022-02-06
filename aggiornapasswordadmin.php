<?php
require_once ("php/cofig.php");
session_start();
$id=$_SESSION['id'];
$queryadmin="SELECT id_amministratore
FROM Amministratori";
$ar=$connex_db->query($queryadmin);
$idmodifca=$id;
if(isset($_POST['conferma'])){
    $key=$_POST['key'];
    $nuovapassword=$_POST['nuovapassword'];
    if ($key!='I%$hmn56hy!'){
        echo "<script> alert ('Qualcosa è andato storto...');
    window.location.replace('/homeadmin.php')</script>";
    }
    else{
        if($_SESSION['id']==3 || $_SESSION['id']==1){
            $idmodifca=$_POST['superadmin'];
        }
        $nuovapassword_hash = password_hash($nuovapassword, PASSWORD_BCRYPT);// hashing password

        $querypassword="UPDATE Amministratori
                        SET password = '$nuovapassword_hash'
                        WHERE id_amministratore='$idmodifca'";
        if ($result=$connex_db->query($querypassword)){
            echo "<script> alert('Password aggiornata correttamente!'); window.location.replace('/homeadmin.php')</script>";
        }
    } //aggiornamento password avvenuto con successo
}
if (isset($_POST['indietro'])){
    session_destroy();
    header ("location:index.php");
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
                        <label for="nuovapassword" class="form-label">Nuova Password</label>
                        <input type="password" class="form-control" id="nuovapassword" placeholder="Inserisci nuova password" name="nuovapassword">
                    </div>
                    <div class="col-md-12">
                        <?php
                        if($_SESSION['id']==3 || $_SESSION['id']==1) {
                        ?>
                        <label for="superadmin" class="form-label">Super Admin</label>
                        <select class="form-select" aria-label="Default select example" id="superadmin" name="superadmin">
                            <option selected>Seleziona Super Admin...</option>
                            <option>1</option>
                            <option>3</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="col-12">
                        <label for="text" class="form-label">Chiave</label>
                        <input type="password" class="form-control" id="key" placeholder="Chiave" name="key">
                    </div>
                    <input type="text" id="conferma" name="conferma" hidden value="1">
                    <button  type="submit" name="conferma" class="btn btn-primary"> Conferma </button>
                    <button  type="sumbit" name="indietro" class="btn btn-danger"> Torna alla pagina principle</button>
                </div>



            </form>

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