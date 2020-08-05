<header class="header">

    <ul>
        <li class="menu-item menu-brand">

            <img class="brand"
                src="<?php echo WWW_PUBLIC; ?>/img/brand.png">

        </li>
        <li class="menu-item" <?php echo SelectedMenu('index.php');  ?>
            ><a href="<?php echo WWW_PUBLIC; ?>">HOME</a></li>
        <li class="menu-item" <?php echo SelectedMenu('Completed.php'); ?>><a
                href="<?php echo WWW_PUBLIC; ?>/Completed.php">ARCHIVIO</a>
        </li>

        <li class="menu-item"><a
                href="<?php echo WWW_PUBLIC; ?>/Logout.php">LOGOUT</a>
        </li>
    </ul>

</header>