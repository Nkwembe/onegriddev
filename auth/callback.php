<?php
    session_start();
    if (isset($_SESSION['access_token'])) {
        header("Location: http://1-grid.healingprotocols.co.za/");
    }
    $code = $_GET['code'];
    if (empty($code)) {
        header("Location:  http://1-grid.healingprotocols.co.za/auth/login.php");
    }
    // const CLIENT = "c8a827ff69d53682e696";
    // const SECRET = "f6a8b3884847759c194a6fd545ff9c4b97896200";
    const CLIENT = "bf56b82110ed92bfc649";
    const SECRET = "7c10b630520202c13ee98a8551b19b3fb34adb54";
    //since code is temporary
    $post_access_token_url = "https://github.com/login/oauth/access_token";
    $ch = curl_init();
    $params = array(
        'client_id' => CLIENT,
        'client_secret' => SECRET,
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
        header("Location:  http://1-grid.healingprotocols.co.za/index.php");
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
    header("Location:  http://1-grid.healingprotocols.co.za/auth/login.php".$params);
?>