<?php
require_once ('php/cofig.php');
session_start();
$id=$_SESSION['id'];
$queryutente="SELECT nome, cognome
FROM Clienti
WHERE id_cliente='$id'";
$res=$connex_db->query($queryutente);
$ut=mysqli_fetch_array($res, MYSQLI_ASSOC);
$nome=$ut['nome'];
$cognome=$ut['cognome'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Grazie!</title>


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
    <?php if (isset($_SESSION['id'])){?>

    <div class="card">
        <div class="card-body login-card-body">
            <?php
            echo "<div>
            <p class='login-box-msg'><h4>Ciao ". " ". $nome ." ".$cognome."</h4></p>
</div>";
            ?>
            <p class="login-box-msg"><h5>Grazie per l'acquisto!</h5></p>
            <p class="login-box-msg"><h5>Non vediamo l'ora di vederti in negozio.</h5></p>
            <p class="login-box-msg"><h6>Ti ricordiamo che è possibile pagare con il Bonus Cultura 18app.</h6></p>
        </div>
<div>

</div>
        <p class="login-box-msg"><a href="index.php">Premi qui </a>per tornare alla home</p>
        <p class="login-box-msg">Acquista un altro <a href="acquistafilm.php">film</a> o <a href="acquistaalbum.php"> Album musicale </a></p>
    </div>
</div>
<?php } else{?>
    <div class="card-body login-card-body">
        <p class="login-box-msg"><h5>Per effettuare un acquisto bisogna aver effettuato il log-in</h5></p>
    </div>

<?php } ?>
<script src="src/plugins/jquery/jquery.min.js"></script>
<script src="src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="src/dist/js/adminlte.min.js"></script>
</body>
</html>



