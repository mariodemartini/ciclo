<?php
    session_start();
    unset($_SESSION["email"]);
    unset($_SESSION["nome"]);
    session_destroy();
    print "<script>location.href='index.php';</script>";
    exit;
?>