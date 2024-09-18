<?php
require_once('shared/db_connect.php');
?>
<?php
$userName = '';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = isset($_POST["username"]) ? mysqli_real_escape_string($conn, $_POST["username"]) : '';
    $password = isset($_POST["password"]) ? mysqli_real_escape_string($conn, $_POST["password"]) : '';

    // Controlla che il nome utente e la password non siano vuoti
    if (empty($userName)) {
        $errorMessage = LOGIN_UNAME[$lang];
    } elseif (empty($password)) {
        $errorMessage = LOGIN_PSW[$lang];
    }

    // Aggiungi altri controlli se necessario (es. lunghezza, caratteri validi, ecc.)
    if (!isset($errorMessage)) {
        if (strlen($userName) < 1 || strlen($userName) > 50) {
            $errorMessage = LOGIN_UNAME_NO_CHAR[$lang];
        } elseif (strlen($password) < 1 || strlen($password) > 255) {
            $errorMessage = LOGIN_PSW_NO_CHAR[$lang];
        }
    }

    // Se non ci sono errori, procedi con l'elaborazione del login
    if (!isset($errorMessage)) {
        
        // Esegui una query per verificare le credenziali
        $sql = "SELECT * FROM users WHERE username = '$userName' and status=1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Accesso riuscito
                // Genera un token casuale
                $token = bin2hex(random_bytes(32));
                // Memorizza il token nell'array delle sessioni o nel database associato all'utente
                $_SESSION['auth_token'] = $token;
                // Memorizza anche il timestamp di creazione del token (ora corrente)
                $_SESSION['auth_token_timestamp'] = time();

                $_SESSION["username"] = $userName;
                header("Location: index.php");
            } else {
                // Accesso fallito: Password errata
                $_SESSION["message"] = LOGIN_UNAME_PSW_KO[$lang];
                header("Location: login.php");
            }
        } else {
            // Accesso fallito: userName non trovato
            $_SESSION["message"] = LOGIN_UNAME_KO[$lang];
            header("Location: login.php");
        }
    }else{
        $_SESSION["message"] = $errorMessage;
        header("Location: login.php");
    }
}
$conn->close();
?>
