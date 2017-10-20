<?php
session_start();
require "helpers/logs.php";

if($_POST) {
    $fields_string = '';
    $fields = array(
        'secret' => 'YOUR_SECRET_KEY_HERE',
        'response' => $_POST['g-recaptcha-response']
    );
    foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    if(!$response['success']) {
        echo "You need to check the reCAPTCHA, redirecting in a few seconds...";
        server_log("reCAPTCHA failed", "process.php");
        header("Refresh:2; url=index.php");
    } else {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        if($user == "admin" && $pass == "password") {
            $_SESSION['user'] = "admin";
            server_log("authentication success", "process.php");
            echo "Successfully logged in, redirecting in a few seconds...";
            header("Refresh:2; url=index.php");
            exit();
        } else {
            $_SESSION["try"] += 1;
            server_log("authentication failed" . "(" . $_SESSION["try"] . "x)", "process.php");
            echo "You entered the wrong username or password, redirecting in a few seconds...";
            header("Refresh:2; url=index.php");
            exit();
        }
    }
}