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
        header('Location:edit.php');
    }
    $day = $_POST["day"];
    $servername = "localhost";
    $password = '';
    $dbname = 'dtce';
    $username = 'root';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $getdata = $conn->prepare("SELECT * from $day WHERE filled=?");
        $getdata->execute(['filled']);
        $check = $getdata->fetchAll();
        if ($check) {

            foreach ($check as $item) {
            }
            $form = '
            <div class="col-md-4 ">
                <img src="passports/' . $img . '" alt="passport" style="width: 100%;120px">
          </div>
          <div class="col-md-8 mb-5">
              <div class="card">
                  <div class="card-header text-center text-capitalize"><b>' . $_POST["day"] . '</b></div>

              <div class="card-body ">
                      <form action="update.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                              <label for="name">Co-ordinators Name</label>
                              <input class="form-control" type="text" name="name" id="name" placeholder="Co-ordinators name"
                               value="' . $item['coordinatorsName'] . '" readonly  required>
                          </div>
                          <div class="form-group">
                              <label for="name">Department name</label>
                              <input class="form-control" type="text" name="department" id="department" readonly
                                  value="' . $item['departmentName'] . '" placeholder="department" required>
                          </div>
                          <input class="form-control" type="hidden" name="day" id="department" value="' . $_POST["day"] . '">
                          <input class="form-control" type="hidden" name="id" id="id" value="' . $item["id"] . '">

                      <div class="form-group">
                              <label for="timeopen">Time Open</label>
                              <select name="timeopen" id="timeopen" required class="form-control">
                              <option value="' . $item['timeOpen'] . ' ">' . $item['timeOpen'] . '</option>

                              <option value="12:00 ">12:00 Noon </option>
                                  <option value="6:00Am ">6:00Am </option>
                                  <option value="9:00Am ">9:00Am </option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="timeclose">Time Close</label>
                              <select name="timeclose" id="timeclose" class="form-control" required>
                              <option value="' . $item['timeClose'] . ' ">' . $item['timeClose'] . '</option>
                              <option value="12:00Pm ">12:00Pm </option>
                                  <option value="6:00Pm ">6:00Pm </option>
                                  <option value="9:00Pm ">9:00Pm </option>
                              </select>
                          </div>

                      <div class="form-group">
                              <label for="number_of_teens">Number Of teenagers</label>
                              <input type="number" name="number_of_teens" id="number_of_teens" class="form-control"
                                value="' . $item['numberOfTeens'] . '"  placeholder="Number of teenagers" required>
                          </div>
                          <div class="form-group">
                              <label for="number_of_teachers">Number Of teachers</label>
                              <input type="number" name="number_of_teachers" id="number_of_teachers" class="form-control"
                              value="' . $item['numberOfTeachers'] . '"     placeholder="Number of teachers" required>
                          </div>
                          <div class="form-group">
                              <label for="report">Report for the Day</label>
                              <textarea name="report" id="report" cols="30" rows="10" class="form-control" required>' . $item['reportForTheDay'] . ' </textarea>
                          </div>
                          <div class="form-group">
                          <label for="challenges">Challenges</label>
                          <textarea name="challenges" id="challenges" cols="30" rows="10" class="form-control" required>' . $item['Challenges'] . '</textarea>
                      </div>

                      <div class="form-group">
                          <label for="possible_solutions">Possible solutions for the challenges</label>
                          <textarea name="possible_solutions" id="possible_solutions" cols="30" rows="10" class="form-control" required>' . $item['possibleSolutions'] . '</textarea>
                      </div>
                      <div class="form-group">
                      <label for="relevant_information">Relevant information</label>
                      <textarea name="relevant_information" id="relevant_information" cols="30" rows="10" class="form-control" required>' . $item['relevantInformation'] . '</textarea>
                  </div>
                          <div class="form-group">
                              <label for="pdf">Upload Pdf or doc file</label>
                              <input type="file" name="pdf" id="pdf"  class="form-control" required>
                              <span class="text-sm text-info">Please note that since the report has been edited, the file format of the report must be updated too. so kindly upload the new report file.</span>
                          </div>
                          <div class="form-group">
                              <input type="submit" name="submit" value="submit" class="btn btn-primary btn-block">
                          </div>
                      </form>
                  </div>
              </div>
          </div>';
        } else {
            $_SESSION["error"] = 'No data for selected day, ' . $day . ' has not been filled';
        }
    } catch (PDOException $e) {
        echo 'connection failed' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit submitted reports </title>

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
            <form action="edit.php" method="post">
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
        </div>
        <div class="row justify-content-center mt-4 ">

            <?php if (!empty($form)) {
    echo $form;
} ?>
        </div>
    </div>
</body>

</html>