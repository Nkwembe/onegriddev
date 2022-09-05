<?php
    session_start();
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    header("Location:  http://1-grid.healingprotocols.co.za/auth/login.php");
?>