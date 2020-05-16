<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 'true') {
    $users = $_SESSION["user"];
    foreach ($users as $user) {
        $img = $user['passport'];
        $department = $user['department'];
        $username = $user['name'];
    }

} else {
    $_SESSION["loginfailed"] = 'Access Denied';
    header('Location: login.php');
}
if (isset($_POST["days"])) {
    if ($_POST["day"] == '') {
        $_SESSION["error"] = 'Please select a valid day';
        header('Location:dashboard.php');
    }
    $form = '

<div class="col-md-8 mb-5">
    <div class="card">
        <div class="card-header text-center text-capitalize"><b>' . $_POST["day"] . '</b></div>

        <div class="card-body ">
            <form action="reports.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Co-ordinators Name</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Co-ordinators name"
                     value="' . $username . '" readonly  required>
                </div>
                <div class="form-group">
                    <label for="name">Department name</label>
                    <input class="form-control" type="text" name="department" id="department" readonly
                        value="' . $department . '" placeholder="department" required>
                </div>
                <input class="form-control" type="hidden" name="day" id="department" value="' . $_POST["day"] . '">

                <div class="form-group">
                    <label for="timeopen">Time Open</label>
                    <select name="timeopen" id="timeopen" required class="form-control">
                        <option value="12:00 ">12:00 Noon </option>
                        <option value="6:00Am ">6:00Am </option>
                        <option value="9:00Am ">9:00Am </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="timeclose">Time Close</label>
                    <select name="timeclose" id="timeclose" class="form-control" required>
                        <option value="12:00Pm ">12:00Pm </option>
                        <option value="6:00Pm ">6:00Pm </option>
                        <option value="9:00Pm ">9:00Pm </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="number_of_teens">Number Of teenagers</label>
                    <input type="number" name="number_of_teens" id="number_of_teens" class="form-control"
                        placeholder="Number of teenagers" required>
                </div>
                <div class="form-group">
                    <label for="number_of_teachers">Number Of teachers</label>
                    <input type="number" name="number_of_teachers" id="number_of_teachers" class="form-control"
                        placeholder="Number of teachers" required>
                </div>
                <div class="form-group">
                    <label for="report">Report for the Day</label>
                    <textarea name="report" id="report" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="challenges">Challenges</label>
                    <textarea name="challenges" id="challenges" cols="30" rows="10" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="possible_solutions">Possible solutions for the challenges</label>
                    <textarea name="possible_solutions" id="possible_solutions" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                <label for="relevant_information">Relevant information</label>
                <textarea name="relevant_information" id="relevant_information" cols="30" rows="10" class="form-control" required></textarea>
            </div>
                <div class="form-group">
                    <label for="pdf">Upload Pdf or doc file</label>
                    <input type="file" name="pdf" id="pdf" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="submit" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
</div>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to your dashbord </title>

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
        <div class="alert alert-dismissable">
            <?php if (!empty($_SESSION["error"])) {
    echo '<div class="alert alert-danger">' . $_SESSION["error"] . '</div>';
    $_SESSION["error"] = '';

}
if (!empty($_SESSION["success"])) {
    echo '<div class="alert alert-success">' . $_SESSION["success"] . '</div>';

    $_SESSION["success"] = '';

}
?>
        </div>
        <div class="row justify-content-center mt-4 ">
            <div class="col-md-4 ">
                <form action="dashboard.php" method="post">
                    <select name="day" id="day" class="form-control">
                        <option value="">Select a day</option>
                        <option value="day1">Day 1</option>
                        <option value="day2">Day 2</option>
                        <option value="day3">Day 3</option>
                        <option value="day4">Day 4</option>
                        <option value="day5">Day 5</option>
                        <option value="day6">Day 6</option>
                        <option value="day7">Day 7</option>
                        <input type="submit" name="days" id="day" class="btn btn-sm btn-secondary mt-1" value="Go">
                    </select>
                </form>

                <img src="passports/<?php echo $img; ?>" class="mt-3" alt="passport" style="width:100%; height:170px">
            </div>
            <?php if (!empty($form)) {
    echo $form;
} ?>
        </div>


    </div>
</body>

</html>