<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 'true') {
    $users = $_SESSION["user"];
    foreach ($users as $user) {
        $img = $user['passport'];
        $department = $user['department'];
        $username = $user['name'];
    }
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
        if (isset($_POST["submit"])) {
            if ($_POST["day"] == '' || $_POST["department"] == '') {
                $_SESSION["invalid"] = 'Please select a valid option';
                header('Location:  getresults.php');
            }
            $day = $_POST["day"];
            $departmentname = $_POST["department"];

            $getresults = $conn->prepare("SELECT * FROM $day WHERE departmentName =? ");
            $getresults->execute([$departmentname]);
            $fetch = $getresults->fetchAll();
            if ($fetch) {
                foreach ($fetch as $item) {
                }
                $result = '<div class="col-md-8 mb-5 my-5">
                <div class="card">
                    <div class="card-header text-center text-capitalize"><b>Reports for ' . $item['departmentName'] . ' department on ' . $day . '</b></div>

                    <div class="card-body ">
        <li class="list-group-item"> <b>Coordinator Name</b>:' . ucfirst($item['coordinatorsName']) . '</li>
        <li class="list-group-item"> <b>Department Name</b>:' . ucfirst($item['departmentName']) . '</li>
        <li class="list-group-item"><b>Time Open</b>: ' . ucfirst($item['timeOpen']) . '</li>
        <li class="list-group-item"><b>Time Close</b>: ' . ucfirst($item['timeClose']) . '</li>
        <li class="list-group-item"> <b>Number of Teenagers</b>:' . ucfirst($item['numberOfTeens']) . '</li>
        <li class="list-group-item"><b>Number of Teachers</b>: ' . ucfirst($item['numberOfTeachers']) . '</li>
        <li class="list-group-item"> <b>Report for the day</b>: ' . ucfirst($item['reportForTheDay']) . '</li>
        <li class="list-group-item"> <b>Challenges</b>: ' . ucfirst($item['Challenges']) . '</li>
        <li class="list-group-item"><b>Possible Solutions</b>: ' . ucfirst($item['possibleSolutions']) . '</li>
        <li class="list-group-item"><b>Relevant Information</b>: ' . ucfirst($item['relevantInformation']) . '</li>
                      </div>
                      </div>
                      </div>';
            } else {
                $_SESSION["invalid"] = 'No result for selected data, perhaps it has not been filled';
                header('Location:  getresults.php');}
        }
    } catch (PDOException $e) {
        echo 'connection failed ' . $e->getMessage();
    }

} else {
    $_SESSION["loginfailed"] = 'Access Denied';
    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read reports </title>

    <link rel="stylesheet" href="./assets/css/app.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
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
                        <a class="nav-link" href="edit.php">Edit reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>




                </ul>
            </div>
        </nav>
        <?php
if (!empty($_SESSION["invalid"])) {
    echo '<div class="alert alert-danger mt-1">' . $_SESSION["invalid"] . '</div>';
    unset($_SESSION['invalid']);
}

?>
        <div class="row justify-content-center mt-1 ">

            <div class="col-md-4 ">
                <div class="alert alert-dismissable">

                </div>
                <form action="getresults.php" method="post">
                    <select name="department" id="department" class="form-control  ">
                        <option value="">Choose a department</option>
                        <?php
foreach ($get as $department) {
    echo "<option value='" . $department["name"] . "'>" . $department["name"] . "</option>";
}
?>
                    </select>
                    <select name="day" id="day" class="form-control">
                        <option value="">Select a day</option>
                        <option value="day1">Day 1</option>
                        <option value="day2">Day 2</option>
                        <option value="day3">Day 3</option>
                        <option value="day4">Day 4</option>
                        <option value="day5">Day 5</option>
                        <option value="day6">Day 6</option>
                        <option value="day7">Day 7</option>
                    </select>
                    <input type="submit" name="submit" id="submit" class="btn btn-sm btn-secondary mt-1" value="Go">

                </form>

                <img src="passports/<?php echo $img; ?>" class="mt-3 mb-sm-3" alt="passport"
                    style="width:100%; height:170px">
            </div>

            <?php
if (!empty($result)) {
    echo $result;
} ?>
        </div>


    </div>
</body>

</html>