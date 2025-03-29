<?php

include("backend/database.php");
include("backend/student_checker.php");
$student_id = $_SESSION['student']['student_id'];


$data = $conn->query("SELECT quiz_code FROM quiz_record WHERE student_id = '$student_id'");
$quiz_already_taken = fetchAll($data);  


$data = $conn->query("SELECT * FROM quiz");
$all_quiz = fetchAll($data);


$taken_quiz_codes = [];
foreach ($quiz_already_taken as $quiz) {
    $taken_quiz_codes[] = $quiz['quiz_code'];
}


$filtered_quiz = array_filter($all_quiz, function($quiz) use ($taken_quiz_codes) {
    return !in_array($quiz['quiz_code'], $taken_quiz_codes);
});


$filtered_quiz = array_values($filtered_quiz);

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

    <table id="table" class="display">
    <thead>
        <tr>
            <th>subject</th>
            <th>Quiz</th>
            <th>items</th>
            <th>timer</th>
            <th>deadline</th>
            <th>take</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($filtered_quiz as $quiz):?>
            <tr>
                <td> <?=$quiz['quiz_subject']?> </td>
                <td> <?=$quiz['quiz_name']?> </td>
                <td> <?=$quiz['quiz_items']?> </td>
                <td> <?=$quiz['quiz_timer']?> min </td>
                <td> <?=$quiz['quiz_deadline']?> </td>
                <td> 
                    <form action="take_quiz.php" method='post'> 
                        <input type="hidden" name="quiz_code" value='<?=$quiz['quiz_code']?>'> 
                        <input type="hidden" name="quiz_timer" value='<?=$quiz['quiz_timer']?>'> 
                        <input type="submit" value='take quiz' class='btn btn-dark'>
                </form> 
            </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(()=>{
 
            $('#table').DataTable();


        })
    </script>
</body>
</html>