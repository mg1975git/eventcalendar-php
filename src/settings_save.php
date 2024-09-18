<?php
require_once('shared/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = $_SESSION['username'];
    $name       = $_POST["name"];
    $surname    = $_POST["surname"];
    $email      = $_POST["email"];
    $ora_inizio    =   date("H:i", strtotime($_POST["time_start"]));
    $ora_fine    =   date("H:i", strtotime($_POST["time_stop"]));
    // Esegui una query per verificare che l'utente sia ancora attivo
    $sql = "SELECT * FROM users WHERE username = '$username' and status=1";
    $result = $conn->query($sql);


    if ($result->num_rows == 0) {
        $_SESSION["message"] = SETTINGS_USER_NO_ACTIVE[$lang];
        header("Location: event.php");
    } else {
        
        $sql = "update users set name='$name', surname='$surname',email='$email',activity_time_start='$ora_inizio',activity_time_stop='$ora_fine' where username = '$username' and status=1";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = SETTINGS_UPD_OK[$lang];
            $_SESSION["username"] = $username; 
            header("Location: index.php");
        } else {
            $_SESSION["message"] = SETTINGS_INS_ERR[$lang]." ". $conn->error;
            header("Location: settings.php");
        }
    }
}else{
    $_SESSION["message"] = SETTINGS_SEND_ERR[$lang];
    header("Location: index.php");
}
// Chiudi la connessione al database
$conn->close();
?>