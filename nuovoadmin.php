<?php
require_once ("php/cofig.php");
session_start();
$id=$_SESSION['id'];
if (isset($_POST['invia'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $data= $_POST['data'];
    $key=$_POST['key'];
    $pwdLenght = mb_strlen($password);//controllo se la lunghezza della pass è adatta
    $data_t= explode("-", $data);
    if (empty($username) || empty($password) || empty($nome) || empty($cognome) || empty($data)) {
        $msg= 'Compila tutti i campi %s';
    } elseif ($pwdLenght < 4 || $pwdLenght > 20) {
        echo "<script> alert ('Registrazione non avvenuta: La lunghezza della password deve essere compresa fra 4 e 20 caratteri')</script>";}
    elseif ($key!='I%$hmn56hy!'){
        echo "<script> alert ('Registrazione non avvenuta: Qualcosa è andato storto)";
    }

    else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);// hashing password
        $query = "
                INSERT INTO Amministratori  (nome, cognome,data_nascita, mail, password)
                VALUES ('$nome', '$cognome', '$data', '$mail', '$password_hash')
            ";
        if ($result=$connex_db->query($query)){
            header("location: /loginamm.php");
            echo "<script> alert('Registrazione avvenuta!')</script>";

        }
    } //registrazione avvenuta

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
    <title>Registrazione</title>


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
            <p class="login-box-msg">Aggiungi un nuovo amministratore</p>
            <form method="post" action="nuovoadmin.php">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
                </div>
                <div class="col-md-6">
                    <label for="cognome" class="form-label">Cognome</label>
                    <input type="text" class="form-control" id="cognome" placeholder="Cognome" name="cognome">
                </div>
                <br>
                <div class="col-12">
                    <label for="mail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="mail" placeholder="Mail" name="mail" maxlength="50">
                </div>
                <div class="col-12">

                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control"  id="password" placeholder="Password" name="password" maxlenght="20">
                </div>
                <div class="col-12">
                     <label for="data" class="form-label">Data di nascita</label>
                <input type="date" class="form-control" id="data" placeholder="Data" name="data">
            </div>
                <div class="col-12">
                    <label for="text" class="form-label">Chiave</label>
                    <input type="password" class="form-control" id="key" placeholder="Chiave" name="key">
                </div>
                <input type="text" id="invia" name="invia" hidden value="1">
                <button  type="submit" name="invia" class="btn btn-primary"> Invia </button>
            </div>
            </form>

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