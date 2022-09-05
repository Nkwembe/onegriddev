<?php
    require_once('config.php');
    session_start();
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    header("Location:"  . $config['host']  .  "/auth/login.php");
?>