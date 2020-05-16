<?php
session_start();
if (isset($_POST["submit"])) {
    $servername = "localhost";
    $password = '';
    $dbname = 'dtce';
    $username = 'root';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $department = filter_var($_POST["department"], FILTER_SANITIZE_STRING);
        $timeopen = $_POST["timeopen"];
        $day = $_POST["day"];
        $timeclose = $_POST["timeclose"];
        $numberofteens = $_POST["number_of_teens"];
        $numberofteachers = $_POST["number_of_teachers"];
        $reportfortheday = filter_var($_POST["report"], FILTER_SANITIZE_STRING);
        $challenges = filter_var($_POST["challenges"], FILTER_SANITIZE_STRING);
        $possible_solutions = filter_var($_POST["possible_solutions"], FILTER_SANITIZE_STRING);
        $relevant_information = filter_var($_POST["relevant_information"], FILTER_SANITIZE_STRING);
        $pdfOrDoc = $_FILES["pdf"];
        //valid file formats
        $acceptedFormats = ['pdf', 'doc', 'docx'];

        //getting uploaded file original name
        $pdfName = $_FILES["pdf"]['name'];
        //getting uploaded file name only
        $pdfNameOnly = pathinfo($pdfName, PATHINFO_FILENAME);
        //getting uploaded file tmp name
        $pdftmp = $_FILES["pdf"]['tmp_name'];
        //getting uploaded file extention
        $pdfExt = pathinfo($pdfName, PATHINFO_EXTENSION);
        //checking if the files extention is accepted
        if (!in_array($pdfExt, $acceptedFormats)) {
            $_SESSION["error"] = 'File format not supported, only pdf and doc';
            header('Location: dashboard.php');
        } else {
            $fileToDb = $pdfNameOnly . '_' . time() . '.' . $pdfExt;
            $storefile = move_uploaded_file($pdftmp, 'reports/pdf/' . $fileToDb);

        }

        $saveReport = "INSERT INTO   $day  (coordinatorsName,	departmentName,	timeOpen,	timeClose,	numberOfTeens,	numberOfTeachers,	reportForTheDay, challenges, possibleSolutions, relevantInformation, pdf, filled )VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $save = $conn->prepare($saveReport)->execute([$name, $department, $timeopen, $timeclose, $numberofteens, $numberofteachers, $reportfortheday, $challenges, $possible_solutions, $relevant_information, $fileToDb, 'filled']);
        $_SESSION["success"] = 'Report has been successfully submitted, thank you for your time';
        //redirect the user where you want them to go after submitting a report
        header('Location: dashboard.php');

    } catch (PDOException $e) {
        echo 'connection failed' . $e->getMessage();
    }
} else {
    header('Location:login.php');
}