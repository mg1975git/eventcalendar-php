<?php
require_once('shared/db_connect.php');
require_once('shared/header.php');
?>
<div class="container" >
  <?php require_once('shared/nav.php'); 
  if (isset($_SESSION['message'])) {
      echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
      unset($_SESSION['message']);
  }
  $idContact = isset($_GET['id']) ? $_GET['id'] : null;

  $sql="select * from contact where id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $idContact);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 0) {
    $_SESSION["message"] = CONTACT_NOT_EXIST[$lang];
    header("Location: contact.php");
} 
$row = $result->fetch_assoc();
  ?>
  <div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-center align-items-center">
            <span class="text-center h1">Modifica Contatto</span>
        </div>
    </div>
    <div class="card align-items-center">
        <div class="col-md-4">
          <form action="contact_save.php" method="post" id="contactForm">
          <input type="hidden" id="idContact" name="idContact" value="<?php echo $row["id"]?>">
            <div class="form-group mb-1">
              <label for="name" >Nome:</label>
              <input type="text" class="form-control" id="name" name="name" value="<?php echo $row["name"]?>" maxlength="50" required>
            </div>
            <div class="form-group mb-1">
              <label for="surname" >Cognome:</label>
              <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $row["surname"]?>" maxlength="50" required>
            </div>
            <div class="form-group mb-1">
              <label for="email" >Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $row["email"]?>" maxlength="50" required>
            </div>
            <div class="form-group mb-1">
              <label for="tel" >Telefono:</label>
              <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $row["tel"]?>" maxlength="20" required>
            </div>
            <div class="form-group mb-1">
              <label for="address" >Indirizzo:</label>
              <input type="text" class="form-control" id="address" name="address" value="<?php echo $row["address"]?>" maxlength="60" required>
            </div>
            <div class="form-group mb-1">
              <label for="city" >Città:</label>
              <input type="text" class="form-control" id="city" name="city" value="<?php echo $row["city"]?>" maxlength="50" required>
            </div>
            <button type="submit" class="btn btn-primary mb-1">Aggiorna</button>
          </form>
        </div>
    </div>
  </div>
</div>
<?php require_once('shared/footer.php'); ?>