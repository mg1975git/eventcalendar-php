<?php
require_once('shared/db_connect.php');
require_once('shared/nav_tok.php');
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["eventoId"])) {
        $eventId   = $_POST["eventoId"];
        $username   = $_SESSION['username'];
        $success    = false; 

        $sql = "update events set status=0 where id=$eventId and username='$username'";
        if ($conn->query($sql) === TRUE) {
            $checkDeletedSql = "SELECT id FROM events WHERE id=$eventId AND username='$username' and status=1";
            $result = $conn->query($checkDeletedSql);
            if ($result->num_rows == 0) 
                $success = true; 
        } else {
            $success = false; 
        }

        if ($success) {
            $_SESSION["message"] = EVENT_DEL_OK[$lang];
        } else {
            $_SESSION["message"] = EVENT_DEL_ERR[$lang];
        }
    }
}else{
    $_SESSION["message"] = EVENT_SEND_ERR[$lang];
    header("Location: index.php");
}

// Chiudi la connessione al database
$conn->close();
?>
