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
  ?>
  <div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-center align-items-center">
            <span class="text-center h1"><?php echo LBL_NEW_CONTACT[$lang]?></span>
        </div>
    </div>
    <div class="card align-items-center">
        <div class="col-md-4">
          <form action="contact_save.php" method="post" id="contactForm">
            <div class="form-group mb-1">
              <label for="name" ><?php echo LBL_NAME[$lang]?></label>
              <input type="text" class="form-control" id="name" name="name" maxlength="50" required>
            </div>
            <div class="form-group mb-1">
              <label for="surname" ><?php echo LBL_SURNAME[$lang]?></label>
              <input type="text" class="form-control" id="surname" name="surname" maxlength="50" required>
            </div>
            <div class="form-group mb-1">
              <label for="email" ><?php echo LBL_EMAIL[$lang]?></label>
              <input type="email" class="form-control" id="email" name="email" maxlength="50" required>
            </div>
            <div class="form-group mb-1">
              <label for="tel" ><?php echo LBL_TEL[$lang]?></label>
              <input type="text" class="form-control" id="tel" name="tel" maxlength="20" required>
            </div>
            <div class="form-group mb-1">
              <label for="address" ><?php echo LBL_ADDRESS[$lang]?></label>
              <input type="text" class="form-control" id="address" name="address" maxlength="60" required>
            </div>
            <div class="form-group mb-1">
              <label for="city" ><?php echo LBL_CITY[$lang]?></label>
              <input type="text" class="form-control" id="city" name="city" maxlength="50" required>
            </div>
            <button type="submit" class="btn btn-primary mb-1"><?php echo LBL_CMD_INSERT[$lang]?></button>
          </form>
        </div>
    </div>
  </div>
</div>
<?php require_once('shared/footer.php'); ?>