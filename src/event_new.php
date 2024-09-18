<?php
session_start(); 
require_once('shared/header.php');

$anno = isset($_GET['anno']) ? $_GET['anno'] : '';
$mese = isset($_GET['mese']) ? $_GET['mese'] : '';
$giorno = isset($_GET['giorno']) ? $_GET['giorno'] : '';

$data_inizio = sprintf('%02d-%02d-%04d', $giorno, $mese, $anno);
?>

<div class="container">
    <?php require_once('shared/nav.php'); ?>
    <?php 
     if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    ?>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-center align-items-center">
                <span class="text-center h1"><?php echo LBL_EVENT_NEW[$lang]?></span>
            </div>
        </div>
        <div class="card align-items-center">
            <div class="col-md-6">
                <form action="event_save.php" method="post">
                    <input type="hidden" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
                    <div class="form-group mb-2">
                        <label for="titolo"><?php echo LBL_EVENT_TITLE[$lang]?>:</label>
                        <input type="text" class="form-control" id="titolo" name="titolo" maxlength="50" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="descrizione"><?php echo LBL_EVENT_DESC[$lang]?>:</label>
                        <textarea class="form-control" id="descrizione" name="descrizione" rows="5" maxlength="5000" required></textarea>
                    </div>
                    <div class="form-inline mb-2">
                            <label for="data_evento" class="mr-2"><?php echo LBL_EVENT_DATA[$lang]?>:</label>
                            <input id="data_evento" name="data_evento" type="text" class="form-control" value="<?php echo "$data_inizio"; ?>" style="width: 50%;"/>
                        </div>
                        <div class="form-inline mb-2">
                            <label for="ora_inizio" class="mr-2"><?php echo LBL_EVENT_START[$lang]?>:</label>
                            <input id="ora_inizio" name="ora_inizio" type="text" class="form-control" value="08:00" style="width: 50%;"/>
                        </div>
                        <div class="form-inline mb-2">
                            <label for="ora_fine" class="mr-2"><?php echo LBL_EVENT_STOP[$lang]?>:</label>
                            <input id="ora_fine" name="ora_fine" type="text" class="form-control" value="09:00" style="width: 50%;"/>
                        </div>
                    <button type="submit" class="btn btn-primary mb-2"><?php echo LBL_EVENT_SAVE[$lang]?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(function () {
    $('#data_evento').datetimepicker({
        format: 'DD-MM-YYYY', // Formato data e orario
        //sideBySide: true // Visualizza data e orario su una sola riga
    });
    $('#ora_inizio').datetimepicker({
        format: 'HH:mm', // Formato data e orario
        stepping: 15, // Incremento di 15 minuti
        sideBySide: true // Visualizza data e orario su una sola riga
    });
    $('#ora_fine').datetimepicker({
        format: 'HH:mm', // Formato data e orario
        stepping: 15, // Incremento di 15 minuti
        sideBySide: true // Visualizza data e orario su una sola riga
    });
});
</script>

<?php require_once('shared/footer.php'); ?>