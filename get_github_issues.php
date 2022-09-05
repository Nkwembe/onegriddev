<?php
    session_start();
    $config = require_once("config.php");
    if (!isset($_SESSION['access_token'])) {
        header("Location:  " . $config['host'] . "/auth/login.php");
    }


    require_once("mappers/GithubIssueMapper.php");

    $mapper = new GithubIssueMapper();
    $data = $mapper->getGithubIssues();
    if ($data && $data['response_code'] === 200) {
        $data = json_decode($data['response'], true);
        echo json_encode($data);//used as json response
    } else {
        echo json_encode(array("response" => []));
    }
?>