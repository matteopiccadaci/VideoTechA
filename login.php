<?php
require_once ("php/cofig.php"); //connessione al db, require once per assicurarsi avvenga una sola volta
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<style>
    h1 {color:orange;}
    p {color: black;}
</style>
<br> <br>
<center><h1>VideoTech-A</h1></center>


<form method="post" action="login.php">
    <h2>Sei un cliente?</h2>
    <input type="text" id="mail" placeholder="Mail" name="mail">
    <input type="password" id="password" placeholder="Password" name="password">
    <button type="button" class="btn btn-outline-dark" name="logincli">Accedi</button>
</form>
<br>
<form method="post" action="login.php">
    <h2>Sei un amministratore?</h2>
    <input type="text" id="mail" placeholder="Mail" name="mail">
    <input type="password" id="password" placeholder="Password" name="password">
    <button type="button" class="btn btn-outline-dark" name="loginamm">Accedi</button>
</form>
<br> <br>
    <h3>Non sei registrato? <a href="registrazione.php"> Premi qui</a> e registrati ora!</h3>
</body>
</html>





















</body>
</html>

<?php
require_once ("php/cofig.php");

if (isset($_POST['logincli'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $querypass= "
    SELECT *
    FROM Clienti
    WHERE mail = '$mail'";

    $result= $connex_db->query($querypass);
    $arr=mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (password_verify($password, $arr["pass"])){
        echo  " <script> alert('Benvenuto!') </script> "; //header ("location: mainpage.php");
    }
    else {
      echo "<script> alert ('Mail o password errate') </script>";
   }
}

if (isset($_POST['loginamm'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $querypass= "
    SELECT *
    FROM Amministratori
    WHERE mail='$mail'";
    $result=$connex_db->query($querypass);
    $arr=mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (password_verify($password, $arr["password"])){
        echo  " <script> alert('Benvenuto!') </script> ";
    }
    else {
        echo "<script> alert ('Mail o password errate') </script>";
    }
}

?>


