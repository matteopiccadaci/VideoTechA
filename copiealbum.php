<?php
require_once ("php/cofig.php");
session_start();
$id=$_SESSION['id'];
if(isset($_GET['ajax'])){
    $out="";
    if($_GET['ajax']==1){
        $queryalbum = "SELECT id_album, nome_album
                FROM Album 
                WHERE  musicista='" . $_GET['id'] . " '";
        $al = $connex_db->query($queryalbum);
        $out.="<option disabled selected>Album</option>";
        while ($albums = mysqli_fetch_array($al, MYSQLI_ASSOC)) {
            $out.="<option value='" . $albums['id_album'] . "'>" . $albums['nome_album'] . "</option>";

        }
        echo $out;
        exit();
    }}
$tr=$connex_db->query($queryalbum);
if(isset($_POST['conferma'])){
    $codice=$_POST['album'];
    $musicista=$_POST['musicista'];
    $modifica=$_POST['quantita'];
    $prezzo=$_POST['prezzo'];
    $key=$_POST['key'];
    if ($key!='I%$hmn56hy!'){
        echo "<script> alert ('Inserimento non avvenuto: Qualcosa è andato storto...'); window.location.replace('/copiealbum.php')</script>";
    }
    else
    {
        $querycopie="SELECT quantita_copie
                        FROM Album
                        WHERE id_album='$codice'";
        $cp=$connex_db->query($querycopie);
        $arrvc=mysqli_fetch_array($cp, MYSQLI_ASSOC);
        $vecchiecopie=$arrvc['quantita_copie'];
        $quantita=$modifica+$vecchiecopie;
        if($quantita<0){
            $quantita=0;
        }
        $queryinserimento="UPDATE Album
        SET quantita_copie='$quantita', prezzo_acquisto=$prezzo
        WHERE id_album='$codice'";

        if ($result=$connex_db->query($queryinserimento)){
            echo "<script> alert('Modifiche apportate correttamente!'); window.location.replace('/catalogoalbumadmin.php')</script>";
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
    <title>Modifica quanitità</title>


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
            <p class="login-box-msg">Modifica quantità e prezzo delle copie di un album</p>
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <label for="musicista" class="form-label">Artista</label>
                            <br>
                            <select class="form-select" aria-label="Default select example" id="musicista" name="musicista">
                                <option selected>Seleziona Artista...</option>
                                <?php
                                $queryartisti="SELECT id_musicista, nome_musicista
                                            FROM Musicisti";
                                $ar=$connex_db->query($queryartisti);
                                while ($artisti=mysqli_fetch_array($ar, MYSQLI_ASSOC))
                                {
                                    echo "<option value='". $artisti['id_musicista'] . "'>" . $artisti['nome_musicista'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label for="quantita" class="form-label">Album</label>
                            <select class="form-select" aria-label="Default select example" id="album" name="album">
                                <option selected>Seleziona Album...</option>
                            </select>

                        </div>
                        <br>
                        <div class="col-md-12">
                            <label for="quantita" class="form-label">Quantità</label>
                            <input type="number" class="form-control" id="quantita" placeholder="Inserisci le copie" name="quantita">
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label for="prezzo" class="form-label">Prezzo</label>
                            <input type="text" class="form-control" id="prezzo" placeholder="Inserisci il prezzo" name="prezzo">
                        </div>
                        <br>
                        <div class="col-12">
                            <label for="text" class="form-label">Chiave</label>
                            <input type="password" class="form-control" id="key" placeholder="Chiave" name="key">
                        </div>
                        <br>
                        <input type="text" id="conferma" name="conferma" hidden value="1">
                        <button  type="sumbit" name="indietro" class="btn btn-danger"> Torna alla pagina principle</button>
                        <button  type="submit" name="conferma" class="btn btn-primary"> Conferma </button>
                    </div>



            </form>

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
<script>
    $(document).on('change', '#musicista', function (){
        var id=$('#musicista option:selected').attr("value");
        $.ajax({
            type:"get",
            data:{id:id, ajax:1},
            success: function (response){
                $('#album').empty();
                $('#album').html(response);
            }
        })

    })
</script>
</html>
