<?php
    session_start();

    $config = require_once("config.php");
    $domain = $config['host'];

    if (isset($_SESSION['access_token'])) {
        header("Location: $domain");
    }

    $code = $_GET['code'];

    if (empty($code)) {
        header("Location:   "  .  $domain  .  "/auth/login.php");
    }

    //since code is temporary
    $post_access_token_url = "https://github.com/login/oauth/access_token";
    $ch = curl_init();
    $params = array(
        'client_id' => $config['client_id'],
        'client_secret' => $config['client_secret'],
        'code' => $code
    );
    curl_setopt($ch, CURLOPT_URL, $post_access_token_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response);
    if (is_object($data) && property_exists($data, 'access_token')) {
        //session_start returns false 
        //and do not initializes $_SESSION when it failed to start the session
        $_SESSION['access_token'] = $data->access_token;
        $_SESSION['time'] = time();
        header("Location:   "  .  $domain  .  "/index.php");
    }
    $data = json_decode($response, true);
    $params = '';
    foreach ($data as $key => $value) {
        if ($params === '') {
            $params .= "?" . $key . "=" . $value;
        } else {
            $params .= "&" . $key . "=" . $value;
        }
    }
    //redirect back if something is wrong
    header("Location:   "  .  $domain  .  "/auth/login.php".$params);
?>