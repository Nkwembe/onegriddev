<?php 
    session_start();

    if (!isset($_SESSION['access_token'])) {
        header("Location:  http://1-grid.healingprotocols.co.za/auth/login.php");
    }

    require_once("mappers/GithubIssueMapper.php");

    //check at least if the required title is posted
    if (isset($_POST['title']) && strlen($_POST['title'])) {
        $mapper = new GithubIssueMapper();
        //$mapper->setRepository($_POST['repo']);
        $mapper->setPostData($_POST);
        $data = $mapper->createGithubIssue();
        echo json_encode($data);//send back json response
    } else {
        echo json_encode(array('error' => 'Please fill in all inputs.'));
    }
?>