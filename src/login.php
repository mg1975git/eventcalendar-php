<?php
session_start();
require_once('shared/lang.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
    <title>EventCalendar</title>
    <link rel="stylesheet" href="css/eventcalendar.css"/>
</head>
<body>
    <div class="container login-container">
        <h2 class="text-center">EventCalendar Login</h2>
        <form action="login_check.php" method="post">
            <div class="form-group mb-2">
                <label for="username"><?php echo LBL_LOGIN_UNAME[$lang]?></label>
                <input type="text" class="form-control" id="username" name="username" maxlength="50" required>
            </div>
            <div class="form-group mb-2">
                <label for="password"><?php echo LBL_LOGIN_PSW[$lang]?></label>
                <input type="password" class="form-control" id="password" name="password" maxlength="255" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?php echo LBL_LOGIN_ACCESS[$lang]?></button>
            <div class="form-group  mt-3 text-center">
            <a href="register.php"><?php echo LBL_LOGIN_REG[$lang]?></a>
            </div>
            <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-warning">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']);
                }
            ?>
        </form>
    </div>
    
    <?php require_once('shared/footer.php'); ?>
<?php
session_destroy();
?>