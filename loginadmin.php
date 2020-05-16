<?php
session_start();
if (isset($_POST["submit"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "onlinereporting";
    $errors = [];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (!empty($_POST["username"])) {
            $username = $_POST["username"];
            $username = filter_var($username, FILTER_SANITIZE_STRING);
        } else {
            $errors['name'] = 'Username is Required';
        }

        if (!empty($_POST["password"])) {
            $pass = $_POST["password"];
            $pass = filter_var($pass, FILTER_SANITIZE_STRING);
            $pass = md5($pass);
        } else {
            $errors['password'] = 'Password is Required';
        }
        if (count($errors) > 0) {
            $_SESSION["loginfailed"] = $errors;
            header("location:login.php");

        } else {

            $getuser = $conn->prepare("SELECT * FROM users WHERE name=? AND password=? ");
            $getuser->execute([$username, $pass]);
            $check = $getuser->fetchAll();
            if ($check) {

                $_SESSION["loggedin"] = 'true';
                $_SESSION["user"] = $check;
                header("Location:dashboard.php");
            } else {
                $_SESSION["loginfailed"] = 'These credentials does not match our records';
                header("Location: login.php");

            }
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else {
    $_SESSION["loginfailed"] = 'Access denied';

    header('Location: login.php');
}