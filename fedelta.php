<?php
require_once("cofig.php");
$query = "SELECT  data_nascita, id_cliente
    FROM Cliente
    WHERE mail='$mail'";
$queryfedelta =" SELECT Fedelta.cliente
FROM Fedelta JOIN Clienti ON Fedelta.cliente = Clienti.id_cliente
WHERE clienti.mail='$mail'";
    $res=$connex_db->query($query);
    $arr=mysqli_fetch_array($res, MYSQLI_ASSOC);
    $data_t=$arr["data_nascita"];
    $id=$arr["id_cliente"];
    $fedelta=$connex_db->query($queryfedelta);
    $data_oggi= date("Y-m-d");
    $eta=(date("md", date("U", mktime(0,0,0, $data_t[0], $data_t[1], $data_t[2]))) > date("md") ? ((date("Y")-$data_t[2])-1) : (date("Y") - $data_t[2]));
if($id==$fedelta){
    echo "<script> alert('Risulti già iscritto al programma fedeltà')";
}
elseif ($eta<18){
    echo "<script> alert('Per poter usufruire dei vantaggi della Card Fedeltà, devi avere almeno 18 anni') </script>";}

else{
    $queryinsert= "INSERT INTO Fedeltà (data_adesione, cliente)
                    VALUES ('$data_oggi', '$id')";
    $inserimento=$connex_db->query($queryinsert);
    if ($inserimento=$connex_db->query($queryinsert);){
        echo "<scrpit> alert('Iscrizione al programma fedeltà avvenuta con successo!') </scrpit>";
    }
}
?>