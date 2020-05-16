<?php
session_start();
if (isset($_POST["submit"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dtce";
    $errors = [];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        ini_set('post_max_size', '128MB');
        if (!empty($_POST["username"])) {
            $username = $_POST["username"];
            $username = filter_var($username, FILTER_SANITIZE_STRING);

            $namecheck = $conn->prepare("SELECT * FROM users WHERE name=?");
            $namecheck->execute([$username]);
            $check = $namecheck->fetch();
            if ($check > 0) {
                $errors['userexist'] = "username already exists";

            }

        }if (!empty($_POST["department"])) {
            $department = $_POST["department"];
            $department = filter_var($department, FILTER_SANITIZE_STRING);
        } else {
            $errors['department'] = 'department is Required';

        }
        if (!empty($_FILES["passport"])) {
            $file_name = $_FILES['passport']['name'];
            $file_size = $_FILES['passport']['size'];
            $file_tmp = $_FILES['passport']['tmp_name'];
            $file_type = $_FILES['passport']['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $imgToDb = pathinfo($file_name, PATHINFO_FILENAME);
            $savetobase = $imgToDb . '_' . time() . '.' . $file_ext;
            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors['image'] = "Passport extension not allowed, please choose a JPEG, jpg or PNG file.";

            }

            if ($file_size > 2097152) {
                $errors['imagesize'] = 'File size must be is greater than the expected size, please choose a lower file size';

            }

        } else {
            $errors['noimg'] = 'Please upload a passport';
        }
        $pass = $_POST["password"];
        $passconf = $_POST["passwordconf"];
        if ($pass != $passconf) {
            $errors['passconf'] = 'Password does not match';
        } else {
            $pass = md5($pass);
        }

        if (empty($errors)) {
            move_uploaded_file($file_tmp, "passports/" . $savetobase);

            $sql = "INSERT INTO users (name, department, passport, password)
                VALUES ('$username', '$department', '$savetobase', '$pass')";
            // use exec() because no results are returned
            $conn->exec($sql);
            header('Location: login.php');

        } else {
            $_SESSION["error"] = $errors;

            header('Location: signup.php');
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else {
    header('Location: signup.php');
}