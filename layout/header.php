<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="1-grid github issues">
    <title>Welcome to 1-Grid Github Issues</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/starter-template/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="../style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container"><!------ The closing div is inside footer.php file------>
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="../assets/brand/1-grid.jpg" width="140" height="132" class="me-2"/>
                <span class="fs-4">Github Issues</span>
            </a>
            <?php if (isset($_SESSION['access_token'])) { ?>
                <ul class="nav nav-pills d-flex align-items-center">
                    <li class="nav-item"><a href="http://onegriddev.local/auth/logout.php" class="nav-link">Logout</a></li>
                </ul>
            <?php } ?>
        </header>    