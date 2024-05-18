<?php
    session_start();
    $_SESSION['id'] =  0;
    $_SESSION['logged_in'] = false;
    session_destroy();
    if ($_GET['logout'] == 'admin')
        header("Location: ../admin/");

    header("Location: ../../index.php");
?>