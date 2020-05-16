<?php
session_start();
$servername = "localhost";
$password = '';
$dbname = 'dtce';
$username = 'root';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $departments = 'SELECT * FROM departments';
    $departments = $conn->query($departments);
    $get = $departments->fetchAll();

} catch (PDOException $e) {
    echo 'connection failed ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>DTCE Junior Church | Admin Sign up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/app.css"> -->
</head>

<body>
    <!-- <div class="container"> -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

        <a class="navbar-brand" href="dashboard.php">
            Online Reporting
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>






            </ul>
        </div>
    </nav>
    <div class="limiter ">
        <div class="container-login100 " style="background-image: url('assets/images/bg.jpg');">
            <div class="wrap-login100 my-4">
                <span class="login100-form-title p-b-34 p-t-27 text-warning">
                    <img src="assets/images/download.png" alt="rccg logo" class="rounded-circle"
                        style="width:50px; height:45px">
                    Online Reporting
                </span>
                <form id="contactForm" novalidate="novalidate"
                    class="login100-form validate-form justify-content-center" method="POST" action="register.php"
                    enctype="multipart/form-data">
                    <img style="width:100%" class="  pl-lg-3" src="assets/images/onlinereport.jpg">

                    <span class="login100-form-title p-b-34 p-t-27">
                        <ins> Register</ins></>

                    </span>
                    <?php
if (!empty($_SESSION["error"])) {
    foreach ($_SESSION["error"] as $item) {
        echo ucfirst('<li class="text-white text-center">' . $item . '</li>');
    }
}
session_destroy();
?>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Username" name="username" required />
                    </div>
                    <div class="form-group">
                        <select name="department" id="department" class="form-control">
                            <option value="">Choose a department</option>
                            <?php
foreach ($get as $department) {
    echo "<option value='" . $department["name"] . "'>" . $department["name"] . "</option>";
}
?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="passport" class="text-white">Passport</label>
                        <input type="file" class="form-control" name="passport" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Enter your password" name="password"
                            required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm your password"
                            name="passwordconf" required />
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="submit">
                            Register
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>


    <script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/vendor/animsition/js/animsition.min.js"></script>
    <script src="assets/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendor/countdowntime/countdowntime.js"></script>
    <script src="assets/js/main.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- JS here -->
    <script src="assets/js1/ajax-form.js"></script>
    <script src="assets/js1/contact.js"></script>
    <script src="assets/js1/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js1/jquery.form.js"></script>
    <script src="assets/js1/jquery.validate.min.js"></script>
    <script src="assets/js1/mail-script.js"></script>

</body>

</html>