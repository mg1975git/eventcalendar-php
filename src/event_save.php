<?php
require_once('shared/db_connect.php');
require_once('shared/nav_tok.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName           = $_POST["username"];
    $idEvent            = $_POST["idEvent"] ?? null;
    $titolo             = $_POST["titolo"];
    $descriptionEvent   = $_POST["descrizione"];
    $descriptionEvent   = mysqli_real_escape_string($conn, $descriptionEvent);
    $noteEvent          = $_POST["note"] ?? '';
    $noteEvent          = mysqli_real_escape_string($conn, $noteEvent);
    $dataEvent          = isset($_POST["data_evento"]) ? date("Y-m-d", strtotime($_POST["data_evento"])) : null;
    $hourTimeStart      = $_POST["ora_inizio"] ?? '';
    $hourTimeStop       = $_POST["ora_fine"] ?? '';
    $startDate          = $dataEvent.' '.$hourTimeStart;
    $endDate            = $dataEvent.' '.$hourTimeStop;
   
    if(isset($idEvent)){
        $sql = "SELECT * FROM events WHERE username = '$userName' and status=1 and id='$idEvent'";
    }else{
        $sql = "SELECT * FROM events WHERE username = '$userName' and status=1 and date(start_date)='$dataEvent' and date(end_date)='$dataEvent' and (UNIX_TIMESTAMP('".$dataEvent.' '.$hourTimeStart."') between UNIX_TIMESTAMP(start_date) and  UNIX_TIMESTAMP(end_date))";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        if(isset($idEvent)){
            
            $sql = "update events set title= '$titolo', description='$descriptionEvent', note='$noteEvent'  where username = '$userName' and status=1 and id='$idEvent'";
            
            if ($conn->query($sql) === TRUE) {
                $_SESSION['message'] = EVENT_UPD_OK[$lang]." ".$titolo;
                $_SESSION["username"] = $userName;
                header("Location: index.php");
            } else {
                $_SESSION["message"] = EVENT_UPD_ERR[$lang]." ". $conn->error;
                header("Location: index.php");
            }
        }else{
            $_SESSION["message"] = EVENT_ALREADY_EXIST[$lang];
            header("Location: event_new.php");
        }
    } else {
        $sql = "INSERT INTO events (title,description,start_date,end_date,created,status,username) VALUES ('$titolo', '$descriptionEvent', '$startDate', '$endDate','".date('Y-m-d H:i:s')."',1,'$userName')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = EVENT_INS_OK[$lang]." ".$titolo;
            $_SESSION["username"] = $userName;
            header("Location: index.php");
        } else {
            $_SESSION["message"] = EVENT_INS_ERR[$lang]." ". $conn->error;
            header("Location: index.php");
        }
    }
}else{
    $_SESSION["message"] = EVENT_SEND_ERR[$lang];
    header("Location: index.php");
}

// Chiudi la connessione al database
$conn->close();
?>
