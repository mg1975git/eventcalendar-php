<?php
require_once('shared/nav_tok.php');
require_once('shared/lang.php');
?>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.php" title="Home"><i class="bi bi-house"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link" href="contact.php" title="<?php echo LBL_CONTACTS[$lang]?>"><i class="bi bi-people"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link"><?php echo LBL_USER[$lang]?> <?php echo $_SESSION['username']; ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="settings.php" title="<?php echo LBL_SETTINGS[$lang]?>"><i class="bi bi-gear-wide"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" title="Logout"><i class="bi bi-box-arrow-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>