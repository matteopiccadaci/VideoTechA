<?php
require_once ("php/cofig.php");
session_start();
$id=$_SESSION['id'];
$queryartisti="SELECT nome_musicista
FROM Musicisti";
$ar=$connex_db->query($queryartisti);
if(isset($_POST['conferma'])){
    $nomealbum=$_POST['album'];
    $musicista=$_POST['musicista'];
    $genere=$_POST['genere'];
    $anno=$_POST['anno'];
    $casa=$_POST['casa'];
    $quantita=$_POST['quantita'];
    $prezzo=$_POST['prezzo'];
    $key=$_POST['key'];
    if ($key!='I%$hmn56hy!'){
        echo "<script> alert ('Inserimento non avvenuto: Qualcosa è andato storto...'); window.location.replace('/aggiungiregista.php')</script>";
    }
    else
    {$querycodice="SELECT id_musicista
    FROM Musicisti 
        WHERE nome_musicista='$musicista'";
        $pos=$connex_db->query($querycodice);
        $arrid=mysqli_fetch_array($pos, MYSQLI_ASSOC);
        $idmusicista=$arrid['id_musicista'];
        $queryaggiunta= "INSERT INTO Album  (nome_album, musicista, genere_album, anno_pubblicazione, quantita_copie, prezzo_acquisto, casa_discografica)
                VALUES ('$nomealbum', '$idmusicista','$genere','$anno','$quantita','$prezzo','$casa')";
        if ($result=$connex_db->query($queryaggiunta)){
            echo "<script> alert('Album inserito correttamente!'); window.location.replace('/catalogoalbumadmin.php')</script>";
        }
    } //inserimento artista avvenuto
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
    <title>Aggiungi album</title>


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
            <p class="login-box-msg">Aggiungi un nuovo regista</p>
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="album" class="form-label">Nome Album</label>
                        <input type="text" class="form-control" id="album" placeholder="Inserisci il nome dell'album" name="album">
                    </div>
                    <div class="col-md-12">
                        <label for="musicista" class="form-label">Artista</label>
                        <select class="form-select" aria-label="Default select example" id="musicista" name="musicista">
                            <option selected>Seleziona Artista...</option>
                            <?php
                            while ($artisti=mysqli_fetch_array($ar, MYSQLI_ASSOC))
                            {
                                echo "<option>" . $artisti['nome_musicista'] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <label for="genere" class="form-label">Genere</label>
                        <input type="text" class="form-control" id="genere" placeholder="Inserisci il genere" name="genere">
                    </div>
                    <div class="col-md-12">
                        <label for="casa" class="form-label">Casa Discografica</label>
                        <input type="text" class="form-control" id="casa" placeholder="Inserisci la casa discografica" name="casa">
                    </div>
                    <div class="col-md-12">
                        <label for="anno" class="form-label">Anno di pubblicazione</label>
                        <input type="number" class="form-control" id="anno" placeholder="Inserisci l'anno di pubblicazione" name="anno">
                    </div>
                    <div class="col-md-6">
                        <label for="quantita" class="form-label">Quantità</label>
                        <input type="number" class="form-control" id="quantita" placeholder="Inserisci le copie" name="quantita">
                    </div>
                    <div class="col-md-6">
                        <label for="prezzo" class="form-label">Prezzo</label>
                        <input type="text" class="form-control" id="prezzo" placeholder="Inserisci il prezzo" name="prezzo">
                    </div>

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