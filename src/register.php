<?php
session_start();
require_once('shared/header.php');
require_once('shared/lang.php');
?>
    <div class="container login-container-register ">
        <div class="text-center"><h2><?php echo LBL_LOGIN_REG[$lang]?></h2></div>
        <form action="register_save.php" method="post">
            <div class="form-group mb-2">
                <label for="username"><?php echo LBL_LOGIN_UNAME[$lang]?></label>
                <input type="text" class="form-control" id="username" name="username" maxlength="50" required>
            </div>
            <div class="form-group mb-2">
                <label for="password"><?php echo LBL_LOGIN_PSW[$lang]?></label>
                <input type="password" class="form-control" id="password" name="password" maxlength="255" required>
            </div>
            <div class="form-group mb-2">
                <label for="nome"><?php echo LBL_NAME[$lang]?></label>
                <input type="text" class="form-control" id="nome" maxlength="50" name="nome">
            </div>
            <div class="form-group mb-2">
                <label for="cognome"><?php echo LBL_SURNAME[$lang]?></label>
                <input type="text" class="form-control" id="cognome" maxlength="50" name="cognome">
            </div>
            <div class="form-group mb-2">
                <label for="email"><?php echo LBL_EMAIL[$lang]?></label>
                <input type="email" class="form-control" id="email" maxlength="50" name="email">
            </div>
            <div class="form-group mb-2">
                <label for="code_email"><?php echo LBL_INSERT_CODE[$lang]?></label>
                <input type="text" class="form-control" id="captcha" name="code_email" maxlength="50"  required>
            </div>
            <button type="submit" class="btn btn-primary"><?php echo LBL_SAVE[$lang]?></button><span class="p-4"></span>
            <a href="login.php" class="btn btn-secondary"><?php echo LBL_CANCEL[$lang]?></a>
        </form>
        <br>
        <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-warning">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
        ?>
    </div>

    <?php require_once('shared/footer.php'); ?>