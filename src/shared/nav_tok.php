<?php
// Recupera il token memorizzato nel server
$serverToken = $_SESSION['auth_token']; // Assumendo che il token sia stato memorizzato nelle sessioni

// Recupera il timestamp di creazione del token dal server
$tokenTimestamp = $_SESSION['auth_token_timestamp'];

// Verifica se il token è valido
if (!isset($serverToken) || time() - $tokenTimestamp > 86400) {
    // Token non valido o scaduto (86400 secondi = 24 ore), reindirizza l'utente o gestisci l'errore in altro modo
    //$_SESSION["message"] = "Utenza non valida.";
    header('Location: ./login.php');
    exit;
}
?>