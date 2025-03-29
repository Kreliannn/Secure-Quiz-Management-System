<?php

include("backend/database.php");
include("backend/student_checker.php");
$student_id = $_SESSION['student']['student_id'];

$data = $conn->query("SELECT * FROM quiz_record WHERE student_id = '$student_id'");
$quiz_record = fetchAll($data);  


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <?php include("navbar_student.php")?>
    <br>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h2 class="mb-0">Student Information</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-1 fw-bold">ID:</div>
                    <div class="col-sm-9"><?=$_SESSION['student']['student_id']?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-1 fw-bold">Name:</div>
                    <div class="col-sm-9"> <?=$_SESSION['student']['student_name']?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-1 fw-bold">Section:</div>
                    <div class="col-sm-9"><?=$_SESSION['student']['student_section']?></div>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <h1 class='text-center'> <b> Quiz Records </b> </h1>
    

    <table class='table table-striped container'>
        <tr class='table-dark'>
            <th> Student </th>
            <th> Subject </th>
            <th> Quiz </th>
            <th> score  </th>
        </tr>
        <?php foreach($quiz_record as $record): ?>
            <tr>
                <td> <?=$record['student_name']?> </td>
                <td> <?=$record['quiz_subject']?> </td>
                <td> <?=$record['quiz_name']?> </td>
                <td> <?=$record['quiz_score']?> </td>
            </tr>
        <?php endforeach?>
    </table>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        
    </script>
</body>
</html>