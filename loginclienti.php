<?php
require_once('php/cofig.php');
session_start();
if (isset($_POST['logincli'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $querypass = "
    SELECT *
    FROM Clienti
    WHERE mail = '$mail'";
    $result = $connex_db->query($querypass);
    $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (password_verify($password, $arr["pass"])) {
        echo " <script> alert('Benvenuto!') </script> ";
        header ("location: index.php");
        $_SESSION['id']=$arr['id_cliente'];
    }
    else {
        echo "<script> alert ('Mail o password errate') </script>";
    }

}
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login Clienti</title>


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
        <a href="../../index2.html"><b>VideoTech-A</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Accedi al tuo account</p>

            <form method="post"  action="loginclienti.php" class="row g-3">
                <div class="col-12">
                    <label for="mail" class="form-label">Email</label>
                    <input type="email" id="mail" placeholder="Mail" name="mail" class="form-control">
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"  id="password" placeholder="Password" name="password"  class="form-control">
                </div>
                <input type="text" id="logincli" name="logincli" hidden value="1">
                <button  type="submit" name="logincli" class="btn btn-primary"> Accedi </button>
        </div>
        <div class="col-12">
            <h6>Accesso <a href="loginamm.php"> Amministratori </a></h6>
        </div>
        <div class="col-12">
            <h6>Non sei registrato? <a href="registrazione.php"> Premi qui</a> e registrati ora!</h6>
        </div>
        </form>

    </div>
    <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="src/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="src/dist/js/adminlte.min.js"></script>

</body>
</html>

