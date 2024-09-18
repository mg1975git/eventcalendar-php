<?php
require_once('shared/db_connect.php');
require_once('shared/header.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$userName       = $_SESSION['username'];
$page           = isset($_GET['page']) ? $_GET['page'] : 1;
$recordsPerPage = 5; // Numero di record per pagina
// Calcola l'offset
$offset = ($page - 1) * $recordsPerPage;
?>
  <div class="container">
  <?php require_once('shared/nav.php'); 
  if (isset($_SESSION['message'])) {
      echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
      unset($_SESSION['message']);
  }
  ?>
  <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="text-center h1"><?php echo LBL_CONTACTS[$lang]?></span>
                        <a class="nav-link" href="contact_new.php" title="<?php echo LBL_ADD_CONTACT[$lang]?>" style="background-color: transparent; border: none; color: #11073B; opacity: 0.5;"><i class="bi bi-person-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                            <th><?php echo LBL_NAME[$lang]?></th>
                            <th><?php echo LBL_SURNAME[$lang]?></th>
                            <th><?php echo LBL_EMAIL[$lang]?></th>
                            <th><?php echo LBL_TEL[$lang]?></th>
                            <th><?php echo LBL_ADDRESS[$lang]?></th>
                            <th><?php echo LBL_CITY[$lang]?></th>
                            <th><?php echo LBL_DATA_INSERT[$lang]?></th>
                            <th><?php echo LBL_ACTIONS[$lang]?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlCount = "SELECT COUNT(*) AS totalRecords FROM v_contact_user WHERE username = ?";
                            $stmtCount = $conn->prepare($sqlCount);
                            $stmtCount->bind_param('s', $userName);
                            $stmtCount->execute();
                            $resultCount = $stmtCount->get_result();
                            $rowCount = $resultCount->fetch_assoc();
                            // Estrai il numero totale di record
                            $totalRecords = $rowCount['totalRecords'];

                            $sql="select * from v_contact_user where username = ? order by dataIns DESC LIMIT ?, ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('sii', $userName, $offset, $recordsPerPage);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["name"]. "</td>";
                                echo "<td>" . $row["surname"]. "</td>";
                                echo "<td>" . $row["email"]. "</td>";
                                echo "<td>" . $row["tel"]. "</td>";
                                echo "<td>" . $row["address"]. "</td>";
                                echo "<td>" . $row["city"]. "</td>";
                                echo "<td>" . date("d/m/Y", strtotime($row["dataIns"])) . "</td>";
                                echo "<td>";
                                echo "<a href='contact_edit.php?id=".$row["id"]."' title='".LBL_MODIFY[$lang]."'><i class='bi bi-pencil-square btn-icon-normal'></i></a> ";
                                echo "<a href='contact_del.php?id=".$row["id"]. "' title='".LBL_DEL[$lang]."'><i class='bi bi-x-square btn-icon-danger'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            } else {
                            echo "<tr><td colspan='9' class='text-center p-5'>".CONTACT_NONE[$lang]."</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                    <?php
                    echo '<div class="text-center">';
                    $totalPages = ceil($totalRecords / $recordsPerPage);
                    if ($totalPages > 1) {
                        echo '<ul class="pagination">';
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    echo '</div>';
                    ?>
                </div>
            </div>
        </div>
    </div>
  <?php require_once('shared/footer.php'); ?>

