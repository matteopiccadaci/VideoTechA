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
    }
else if($_GET['ajax']==2){
    $queryquantita= "SELECT quantita_copie
    FROM Album
    WHERE id_album='" . $_GET['id'] . "'";
    $qt=$connex_db->query($queryquantita);
    if ($tot= mysqli_fetch_array($qt, MYSQLI_ASSOC)){
        $out.=' <label for="quantita" class="form-label">Quantità</label> <input id="selezione" type="text" value="' . $_GET['id'] . '" hidden> <input type="number" class="form-control" min="0" max="'. $tot["quantita_copie"] . '" id="quantitainput" name="quantitainput" required> ';
    }
}
else if($_GET['ajax']==3){
    $queryprezzo= "SELECT prezzo_acquisto
    FROM Album
    WHERE id_album='" . $_GET['id'] . "'";
    $pr=$connex_db->query($queryprezzo);
    $out=mysqli_fetch_array($pr, MYSQLI_ASSOC)['prezzo_acquisto'];
    $queryfedelta="SELECT Fedelta.id_carta
    FROM Fedelta JOIN Clienti on Fedelta.cliente=Clienti.id_cliente
    WHERE Clienti.id_cliente='$id'";
    $fd=$connex_db->query($queryfedelta);
    if($fd->num_rows!=0){
        $out=$out*0.85;
    }
    elseif ($fd){
        $querydata="SELECT data_nascita 
    FROM Clienti
    WHERE id_cliente='$id'";
        $dt=$connex_db->query($querydata);
        $data=mysqli_fetch_array($dt, MYSQLI_ASSOC);
        $data_t=new DateTime($data['data_nascita']);
        $data_oggi= new DateTime (date("Y-m-d"));
        $eta=$data_t->diff($data_oggi)->y;
        if ($eta>15 && $eta<=25){
            $out=$out*0.9;
        }

    }

    $out*=$_GET['qnt'];
    $out=number_format((float) $out, 2);
    $out=strval($out);
$out='€ '. $out;
}

echo $out;
exit();
}




if(isset($_POST['conferma'])){
    $album=$_POST['album'];
    $quantita=$_POST['quantitainput'];
    $data_oggi= date("Y-m-d");
        $queryacquisto= "INSERT INTO Acquisti_album  (data_acquisto, cliente, articolo, quantita)
                VALUES ('$data_oggi','$id','$album', '$quantita')";
        $queryvecchiaquantita="SELECT quantita_copie
        FROM Album
        WHERE id_album='$album'";
        $vq=$connex_db->query($queryvecchiaquantita);
        $vecchiaquantit=mysqli_fetch_array($vq, MYSQLI_ASSOC);
        $vecchiaquantita=$vecchiaquantit['quantita_copie'];
        $nuovaquantita=$vecchiaquantita-$quantita;
    $querynuovaquantita="UPDATE Album 
        SET quantita_copie='$nuovaquantita'
        WHERE id_album='$album'";
        if ($result=$connex_db->query($queryacquisto)){
        $nv=$connex_db->query($querynuovaquantita);
        echo "<script>window.location.replace('/ringraziamenti.php')</script>";
        }//inserimento artista avvenuto
}
if (isset($_POST['indietro'])){
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
    <title>Acquista album</title>


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
            <p class="login-box-msg">Acquista un album musicale</p>
            <form method="post">
                <div class="row g-3">
                    <br>
                    <div class="col-md-12">
                        <label for="musicista" class="form-label">Artista</label>
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
                    <div class="col-md-12">
                        <label for="musicista" class="form-label">Album</label>
                        <select class="form-select" aria-label="Default select example" id="album" name="album">
                            <option selected>Seleziona Album...</option>
                        </select>
                    </div>
                    <div class="col-md-12" id="quantita">
                        <label for="quantita" class="form-label">Quantità</label>
                        <input type="number" class="form-control" id="quantitainput" name="quantitainput" disabled>
                    </div>

                    <label for="prezzo" class="form-label m-1">Prezzo</label>
                    <div class="col-md-12 mt-1 border border-dark " id="prezzo" style="border-radius: 10px; height: 38px;">

                    </div>
                    <input type="text" id="conferma" name="conferma" hidden value="1">
                    <button  type="submit" name="conferma" class="btn btn-primary"> Conferma acquisto </button>

                    <button  type="sumbit" name="indietro" class="btn btn-danger"> Torna alla pagina principle</button>
            </form>

            <!-- /.login-card-body -->
        </div>
    </div>
    <?php } else{?>
    <div class="card-body login-card-body">
        <p class="login-box-msg"><h5>Per effettuare un acquisto bisogna aver effettuato il log-in</h5></p>
    </div>
<?php } ?>
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

    $(document).on('change','#album', function (){
        var id=$('#album option:selected').attr("value");
        $.ajax({
            type:"get",
            data:{id:id, ajax:2},
            success: function(response){
                $('#quantita').empty();
                $('#quantita').html(response);
            }


        })

    })

    $(document).on('change', '#quantitainput', function (){
        var num=$('#quantitainput').val(),
            id=$('#selezione').attr('value');
        $.ajax({
            type:"get",
            data:{qnt:num,id:id, ajax:3},
            success: function(response){
                $('#prezzo').empty();
                $('#prezzo').html(response);
                console.log(response);
            }
        })

    })
</script>
</html>