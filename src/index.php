<?php
require_once('shared/db_connect.php');
require_once('shared/header.php');
?>

<div class="container">
    <?php require_once('shared/nav.php'); ?>
    <?php

        if(!isset($_SESSION['username']) && !isset($_SESSION['message'])) {
            header("Location: login.php");
            unset($_SESSION['message']);
            $conn->close();
            exit();
        }else{
            // Verifica se esiste un messaggio di conferma
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
        }
        $username = $_SESSION['username'];
        $yearActual = isset($_GET['anno']) ? intval($_GET['anno']) : date('Y');
        $yearLast = $yearActual - 1;
        $yearNext = $yearActual + 1;

        $sql = "SELECT start_date FROM events where year(start_date)=$yearActual and username='$username' and status=1";
        $result = $conn->query($sql);

        $arrayDayMonth = [];

        while ($row = $result->fetch_assoc()) {
            $start_date = $row['start_date'];
            $start_date = new DateTime($row['start_date']);
            $giorno = $start_date->format('d');
            $mese = $start_date->format('m');
            $arrayDayMonth[] = ['giorno' => $giorno, 'mese' => $mese];
        }
        ?>
  
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header nome-mese">
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="mr-4" href="?anno=<?= $yearLast ?>"><img src="img/tick_sx.png"/></a>
                            <span class="text-center h1"><?php echo LBL_YEAR[$lang]?> <?= $yearActual ?></span>
                            <a class="ml-4" href="?anno=<?= $yearNext ?>"><img src="img/tick_dx.png"/></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            
                            $month_label = array(
                                 GEN[$lang], FEB[$lang], MAR[$lang], APR[$lang],
                                 MAY[$lang], JUN[$lang], JUL[$lang], AUG[$lang],
                                 SEP[$lang], OCT[$lang], NOV[$lang], DEC[$lang]
                            );
                            
                            setlocale(LC_TIME, 'it_IT');

                            $yearActual2 = date('Y');
                            $mese_attuale = date('n'); // 'n' restituirà il numero del mese senza zeri iniziali...per test mettere 8
                            $yearActual_bool=false;
                            $style_class= "nome-mese";
                            if( $yearActual2==$yearActual)
                                $yearActual_bool=true;

                            if( $yearActual_bool)
                                $mesi = array_merge(array_slice($month_label, $mese_attuale - 1), array_slice($month_label, 0, $mese_attuale - 1));
                            else
                                $mesi=$month_label;

                            
                            foreach ($mesi as $mese_numero => $mese) {
                                if($yearActual_bool)
                                    if ($mese_numero>12-$mese_attuale) 
                                        $style_class= "nome-mese-old";

                                if($yearActual<$yearActual2)
                                    $style_class= "nome-mese-old";

                                echo '<div class="col-md-4">';
                                echo '<div class="card mb-1 '.$style_class.'">';
                                echo '<div class="card-header '.$style_class.' ">';
                                $mese_desc=$mese_numero+$mese_attuale;

                                if($yearActual_bool)
                                    if($mese_desc>12)
                                        $mese_desc = $mese_desc - 12;

                                if($yearActual_bool)
                                    echo '<a class="btn btn-light " href="event_detail_month.php?mese=' . ($mese_desc) . '&anno=' . $yearActual . '">' . $mese . '</a>';
                                else
                                    echo '<a class="btn btn-light " href="event_detail_month.php?mese=' . ($mese_numero + 1) . '&anno=' . $yearActual . '">' . $mese . '</a>';
                                echo '</div>';
                                echo '<div class=" evento-grid">';
                                $numero_giorni_mese = cal_days_in_month(CAL_GREGORIAN, $mese_numero + 1, $yearActual);

                                $giorni_settimana = array(DAY1[$lang], DAY2[$lang], DAY3[$lang], DAY4[$lang], DAY5[$lang], DAY6[$lang], DAY7[$lang]);
                                foreach ($giorni_settimana as $giorno_settimana) {
                                    echo '<div class="giorno">' . $giorno_settimana . '</div>';
                                }

                                $giorno_iniziale_1 = mktime(0, 0, 0, $mese_numero+1, 1, $yearActual);
                                if($yearActual_bool)
                                    $giorno_iniziale_1 = mktime(0, 0, 0, $mese_desc, 1, $yearActual);
                                else
                                    $giorno_iniziale_1 = mktime(0, 0, 0, $mese_numero+1, 1, $yearActual);

                                $giorno_iniziale = date("w", $giorno_iniziale_1);

                                for ($j = 1; $j < $giorno_iniziale; $j++) {
                                    echo '<div class="numero-mese"></div>';
                                }

                                $meseDellEvento=0;
                                if($yearActual_bool)
                                    $meseDellEvento = $mese_desc;
                                else
                                    $meseDellEvento = $mese_numero + 1;
                      
                      
                                for ($numero_giorno = 1; $numero_giorno <= $numero_giorni_mese; $numero_giorno++) {
                                    $found = false;
                                    //echo $numero_giorno."a";
                                    foreach ($arrayDayMonth as $array) {
                                        if (($array['giorno'] == $numero_giorno) && ($array['mese'] == $meseDellEvento)) {
                                            $found = true;
                                            break;
                                        }
                                    }

                                    if ($found) {
                                        // Aggiungi la classe `colored-day` al div
                                        $css_class = 'colored-day';
                                    } else {
                                        // Usa la classe `numero-mese` predefinita
                                        $css_class = 'numero-mese';
                                    }
                                    echo '<div class="' . $css_class . '" data-anno="' . $yearActual . '" data-mese="' . ($meseDellEvento) . '" data-giorno="' . $numero_giorno . '">' . $numero_giorno . '</div>';
                                }

                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header text-center" id="slot-day">
                        <span><?php echo LBL_EVENTS[$lang]?></span> 
                    </div>
                    <div class="card-body" id="slot-card">
                    <?php
                        $meseSearch    = $_GET['mese'] ?? '';
                        if (isset($_GET['giorno'])) {?>
                            <span class="list-group-item text-center"><? echo ($_GET['giorno'] . '-' . substr($month_label[$meseSearch-1],0,3)) 
                        ?></span>
                        <?php
                        }
                        ?>
                        <ul class="list-group">
                            <?php
                             $giornoSearch  = $_GET['giorno'] ?? '';
                             
                             if($giornoSearch!=''){
                                $sql = "SELECT * FROM events where year(start_date)=$yearActual and month(start_date)=$meseSearch and username='$username' and day(start_date)=".$giornoSearch." and status=1 order by start_date";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $idEvents = $row['id'];
                                        $data_inizio = $row['start_date'];
                                        $ora_inizio = date("H:i", strtotime($data_inizio));
                                        $data_fine = $row['end_date'];
                                        $ora_fine = date("H:i", strtotime($data_fine));
                                        $title =$row['title'];
                                        echo '<li class="list-group-item slot" title="' . $title . '" data-event-id="' . $idEvents . '">' . $ora_inizio . ' - ' . $ora_fine . '</li>';
                                    }
                                }
                            }
                            echo '<span class="text-center"><a href="event_new.php"><i class="bi bi-calendar-event" title="'.LBL_ADD_EVENT[$lang].'"></i></a></span>';

                            $conn->close();
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    document.addEventListener('click', function (event) {
        const giorno = event.target.dataset.giorno;
        const mese = event.target.dataset.mese;
        const anno = event.target.dataset.anno;

        if (event.target.classList.contains('colored-day')) {
            window.location.href = `index.php?anno=${anno}&mese=${mese}&giorno=${giorno}`;
        }
        else if (event.target.classList.contains('numero-mese')) 
        {
            window.location.href = `event_new.php?anno=${anno}&mese=${mese}&giorno=${giorno}`;
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
        const slotElements = document.querySelectorAll('.slot');

        slotElements.forEach(function (slot) {
            slot.addEventListener('click', function () {
                const eventId = slot.getAttribute('data-event-id');
                window.location.href = `event_detail_month.php?eventId=${eventId}`;
            });
        });
    });
</script>
<?php require_once('shared/footer.php'); ?>
