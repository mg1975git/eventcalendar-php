<?php
require_once('shared/db_connect.php');
require_once('shared/header.php');
?>

<div class="container" >
    <?php require_once('shared/nav.php'); ?>
    <?php
    if ($conn->connect_error) {
        $_SESSION["message"] = "Connessione al database fallita: " . $conn->connect_error;
        header("Location: register.php");
        exit();
    }
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$username' and status=1";
    $result = $conn->query($sql);
    
    if(!isset($_SESSION['username']) && !isset($_SESSION['message'])) {
        header("Location: login.php");
        unset($_SESSION['message']);
        exit();
    }else{
        // Verifica se esiste un messaggio di conferma
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
    }

    $anno_attuale = isset($_GET['anno']) ? intval($_GET['anno']) : date('Y');
    $anno_precedente = $anno_attuale - 1;
    $anno_successivo = $anno_attuale + 1;
    $email = "";
    $nome = "";
    $cognome = "";
    $activity_time_start = "";
    $activity_time_stop = "";

    $sql = "SELECT * FROM users WHERE username = '$username' and status=1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Estrai la riga dell'utente
        $row = $result->fetch_assoc();
    
        // Ora puoi accedere all'email
        $email = $row['email'];
        $nome = $row['name'];
        $cognome = $row['surname'];
        $activity_time_start = $row['activity_time_start'];
        $activity_time_stop = $row['activity_time_stop'];
    } else {
        echo SETTINGS_USER_NOT_FOUND;
    }
    $conn->close();
    ?>
   
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-center align-items-center">
            <span class="text-center h1"><?php echo LBL_SETTINGS[$lang]?></span>
        </div>
    </div>
    <div class="card align-items-center">
        <div class="  col-md-6 ">
            <form action="settings_save.php" method="post" id="impostazioniForm">
                <div class="form-group mb-2">
                    <label for="username"><?php echo LBL_LOGIN_UNAME[$lang]?>:</label>
                    <input type="username" class="form-control" id="username" name="username" value="<?php echo $username; ?>" disabled>
                </div>
                <div class="form-group mb-2">
                    <label for="email"><?php echo LBL_EMAIL[$lang]?>:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" maxlength="50" required>
                </div>
                <div class="form-group mb-2">
                    <label for="name"><?php echo LBL_NAME[$lang]?>:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $nome; ?>" maxlength="50" required>
                </div>
                <div class="form-group mb-2">
                    <label for="surname"><?php echo LBL_SURNAME[$lang]?>:</label>
                    <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $cognome; ?>" maxlength="50" required>
                </div>
                <div class="form-group mb-2">
                    <label for="time_start"><?php echo LBL_EVENT_START_A[$lang]?>:</label>
                    <input type="time" class="form-control" id="time_start" name="time_start" value="<?php echo $activity_time_start; ?>" style="width: 50%;">
                </div>
                <div class="form-group mb-2">
                    <label for="time_stop"><?php echo LBL_EVENT_STOP_A[$lang]?>:</label>
                    <input type="time" class="form-control" id="time_stop" name="time_stop" value="<?php echo $activity_time_stop; ?>" style="width: 50%;">
                </div>
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#confermaModal"><?php echo LBL_EVENT_SAVE[$lang]?></button>
            </form>
        </div>
    </div>
    <div class="modal fade" id="confermaModal" tabindex="-1" role="dialog" aria-labelledby="confermaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confermaModalLabel"><?php echo LBL_CONFIRM[$lang]?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php echo LBL_CONFIRM_MSG[$lang]?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo LBL_BTN_CANCEL[$lang]?></button>
                    <button type="submit" class="btn btn-primary" id="confermaInvio"><?php echo LBL_BTN_CONFIRM[$lang]?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('confermaInvio').addEventListener('click', function () {
    document.getElementById('impostazioniForm').submit();
});
</script>

<?php require_once('shared/footer.php'); ?>
