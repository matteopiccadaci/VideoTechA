<!DOCTYPE html>
<html>
<head>
    <title>Registrazione</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
<form method="post" action="registrazione.php">
    <h1>Registrazione</h1>
    <input type="nome" id="nome" placeholder="Nome" name="nome" required>
    <input type="cognome" id="cognome" placeholder="Cognome" name="cognome" required>
    <div class="input-group mb-3">
        <input type="text"  id="mail" class="form-control" placeholder="Inserisci la tua mail" aria-label="Username" name="mail" aria-describedby="inputGroup-sizing-sm" maxlength="50" required>
    </div>
    <input type="password" id="password" placeholder="Password" name="password" required>
    <input type="date" id="data" placeholder="Data" name="data" required>
    <button type="button" class="btn btn-outline-dark" name="register">Registrati</button>
</form>
<body class="text-center">

<main class="form-signin">
    <form>
        <img class="mb-4" src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
</main>



</body>
</html>
</body>
</html>
<?php
require_once ("php/cofig.php");

if (isset($_POST['register'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $data= $_POST['data'];
    $pwdLenght = mb_strlen($password);//controllo se la lunghezza della pass è adatta
    $data_t= explode("-", $data);
    $eta=(date("md", date("U", mktime(0,0,0, $data_t[2], $data_t[1], $data_t[0]))) > date("md") ? ((date("Y")-$data_t[0])-1) : (date("Y") - $data_t[0]));
    if (empty($username) || empty($password) || empty($nome) || empty($cognome) || empty($data)) {
        $msg.= 'Compila tutti i campi %s';
    } elseif ($pwdLenght < 4 || $pwdLenght > 20) {
       echo "<script> alert ('Registrazione non avvenuta: La lunghezza della password deve essere compresa fra 4 e 20 caratteri')</script>";}

    elseif ($eta<16){
        echo "<script> alert('Registrazione non avvenuta: L\'età per registrarsi è di almeno 16 anni') </script>";
    }
    else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);// hashing password
    $query = "
                INSERT INTO Clienti  (nome, cognome,mail, pass, data_nascita)
                VALUES ('$nome', '$cognome', '$mail', '$password_hash', '$data')
            ";
    if ($result=$connex_db->query($query)){
        echo "<script> alert('Registrazione avvenuta')</script>";

    }
}}
?>
