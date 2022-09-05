<?php
    session_start();

    if (!isset($_SESSION['access_token'])) {
        header("Location: http://githubissues.local/auth/login.php");
    }


    require_once("mappers/GithubIssueMapper.php");

    $mapper = new GithubIssueMapper();
    $mapper->setRepository("onegrid");
    $data = $mapper->getGithubIssues();
    if ($data && $data['response_code'] === 200) {
        $data = json_decode($data['response'], true);
        echo json_encode($data);//used as json response
    } else {
        echo json_encode(array("response" => []));
    }
?>