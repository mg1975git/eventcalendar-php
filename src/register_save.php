<?php
require_once('shared/db_connect.php');
//require_once('shared/header.php');
?>

<?php
// Recupera i dati inviati dal modulo di registrazione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = $_POST['username'] ?? '';
    $password   = password_hash($_POST["password"], PASSWORD_BCRYPT); // Si consiglia di usare l'hash della password
    $nome       = $_POST["nome"] ?? '';;
    $cognome    = $_POST["cognome"] ?? '';;
    $email      = $_POST["email"] ?? '';
    $codeEmail  = $_POST["code_email"] ?? '';
   
    if($codeEmail!="1234567890" ||  $username==""){
        $_SESSION["message"] = LOGIN_REG_CODE_KO[$lang];
        header("Location: register.php");
    }else{
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $_SESSION["message"] = LOGIN_REG_UNAME_ALREADY_EXIST[$lang];
            header("Location: register.php");
        } else {

            // Query per l'inserimento dei dati nell'utente nel database
            $sql = "INSERT INTO users (username, password, name, surname, email, status) VALUES ('$username', '$password', '$nome', '$cognome', '$email', 1)";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['message'] = LOGIN_REG_OK[$lang]." " .$nome;
                $_SESSION["username"] = $username; // Salva l'username nella variabile di sessione
                
                // Genera un token casuale
                $token = bin2hex(random_bytes(32));
                // Memorizza il token nell'array delle sessioni o nel database associato all'utente
                $_SESSION['auth_token'] = $token;
                // Memorizza anche il timestamp di creazione del token (ora corrente)
                $_SESSION['auth_token_timestamp'] = time();

                header("Location: index.php");
            } else {
                $_SESSION["message"] = LOGIN_REG_ERR[$lang]." ". $conn->error;
                header("Location: register.php");
            }
        }
    }
    // Chiudi la connessione al database
    $conn->close();
}else{
    $_SESSION["message"] = LOGIN_REG_SEND_KO[$lang];
    header("Location: register.php");
}
?>
