<?php
require_once('shared/db_connect.php');
require_once('shared/header.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$userName = $_SESSION['username'];

?>
<div class="container">
    <?php require_once('shared/nav.php'); ?>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
            
    $dataYear =  '';
    $dataMonth = '';
    $eventId = '';
    $sql='';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $dataYear = isset($_GET["anno"]) ? mysqli_real_escape_string($conn, $_GET["anno"]) : '';
        $dataMonth = isset($_GET["mese"]) ? mysqli_real_escape_string($conn, $_GET["mese"]) : '';
        $eventId = isset($_GET["eventId"]) ? mysqli_real_escape_string($conn, $_GET["eventId"]) : '';
    }

    $titleMonths = array(
        GEN[$lang], FEB[$lang], MAR[$lang], APR[$lang],
        MAY[$lang], JUN[$lang], JUL[$lang], AUG[$lang],
        SEP[$lang], OCT[$lang], NOV[$lang], DEC[$lang]
   );

    if($eventId==''){
        $sql = "SELECT * FROM events where username='$userName' and year(start_date)=$dataYear and month(start_date)=$dataMonth"." and status=1 order by start_date";
    }else{
        $sql = "SELECT * FROM events where username='$userName' and id=$eventId"." and status=1 order by start_date";
    }
   
    $result1 = $conn->query($sql);
    $row = $result1->fetch_assoc();
    $sdate = $row['start_date']??"";
    
    if($sdate!=""){
        $date = new DateTime($sdate);
        $dataMonth = $date->format('m');
        $dataYear = $date->format('Y');
    }
    
    ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <?php if ($dataYear !=  ''){ ?>
                            <a class="mr-4" href="index.php?anno=<?= $dataYear ?>" title="<?php echo LBL_BACK[$lang]?>">
                                <img src="img/tick_sx.png"/></a> <?php if($sdate!="") echo $titleMonths[$dataMonth-1].' '.$dataYear ?>
                        <?php }else{ ?>
                            <a class="mr-4" href="index.php" title="<?php echo LBL_BACK[$lang]?>"><img src="img/tick_sx.png"/></a>
                        <?php } ?>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        
                        $dayCurrent = 'N/A';
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $description    = nl2br($row['description']);
                                $idEvent        = $row['id'];
                                $title          = $row['title'];
                                $note           = $row['note'];
                                $dataStart      = $row['start_date'];
                                $dataTimeStart  = date("d-M-Y H:i", strtotime($dataStart));
                                $dayDataStart   = date("d", strtotime($dataStart));
                                $dataEnd        = $row['end_date'];
                                $orarioFine     = date("H:i", strtotime($dataEnd));
                                
                                if ($dayCurrent != $dayDataStart) {
                                    $dayCurrent = $dayDataStart;
                                    $classe_colore = "cambia-colore";
                                } else {
                                    $classe_colore = "";
                                }
                                echo '<li class="list-group-item evento-lista ' . $classe_colore . '" data-evento="'. $description .'" data-title="'. $dataTimeStart.' '.$title .'" data-note="'.$note.'">'. $dataTimeStart . ' '. $orarioFine ;
                                echo '<button class="btn btn-sm evento-cancella" title="'.LBL_DEL[$lang].'" style="background-color: transparent; border: none; color: #CC6277; opacity: 0.5;"  data-event-id="'.$idEvent.'"><i class="bi bi-trash"></i></button>' ;
                                echo '<button class="btn btn-sm evento-modifica" title="'.LBL_MODIFY[$lang].'" style="background-color: transparent; border: none; color: #7B68EE; opacity: 0.5;"  data-event-id="'.$idEvent.'"><i class="bi bi-pencil-square"></i></button>'. '</li>' ;
                            }
                        }else{
                            echo '<li class="list-group-item text-center" data-evento="'.EVENT_NONE[$lang].'" data-title="">'.EVENT_NONE[$lang].'</li>';
                        }
                        $conn->close();
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="evento-titolo">
                    <?php echo LBL_CLICK_SX[$lang]?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="evento-dettaglio"></div>
                    <div class="evento-note"></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confermaCancellazione" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo LBL_CONFIRM_DEL[$lang]?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                </div>
                <div class="modal-body">
                <?php echo EVENT_DEL_SURE[$lang]?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo LBL_BTN_CANCEL[$lang]?></button>
                    <button type="button" class="btn btn-danger" id="confermaCancellazioneBtn"><?php echo LBL_BTN_CONFIRM[$lang]?></button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    $(".evento-lista").click(function () {
        var eventoDesc  = $(this).data("evento");
        var eventoTitle = $(this).data("title");
        var note        = $(this).data("note");
        
        $(".evento-dettaglio").html(eventoDesc);
        $(".evento-dettaglio").show();
        $(".evento-note").html("Note:<br>"+note);
        $(".evento-note").show();
        $(".evento-titolo").html(eventoTitle);
        $(".evento-titolo").show();
    });
    $(".evento-modifica").click(function () {
        var request;
        var eventoId = $(this).data("event-id");
       
        window.location = 'event_edit.php?id='+eventoId;
    });
    $(".evento-cancella").click(function () {
        var eventoId = $(this).data("event-id");
        // Mostra la modale di conferma
        $("#confermaCancellazione").modal('show');

        // Gestisci il clic sul pulsante di conferma nella modale
        $("#confermaCancellazioneBtn").click(function () {
            // Nascondi la modale
           
            $("#confermaCancellazione").modal('hide');
            $.post("event_del.php", { eventoId: eventoId }, function (data) {});
                location.reload();
        });
    });
</script>
<?php require_once('shared/footer.php'); ?>
