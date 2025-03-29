<?php

include("backend/database.php");
include("backend/teacher_checker.php");


$data = $conn->query("SELECT * FROM quiz_record");
$quiz_record = fetchAll($data);  

if($_SERVER['REQUEST_METHOD'] == "POST")
{
        $section = $_POST['section'];
        $subject = $_POST['subject'];
        $student_id = $_POST['student_id'];
        $quiz_name = $_POST['quiz_name'];
        

        $unfiltered_property = $quiz_record;

        if(!empty($section))
        {
            $unfiltered_property = array_filter($unfiltered_property, fn($data) => $data['section'] == $section);
        }

        if(!empty($subject))
        {
            $unfiltered_property = array_filter($unfiltered_property, fn($data) => $data['quiz_subject'] == $subject);
        }

        if(!empty($student_id))
        {
            $unfiltered_property = array_filter($unfiltered_property, fn($data) => $data['student_id'] == $student_id . " ");
        }

        if(!empty($quiz_name))
        {
            $unfiltered_property = array_filter($unfiltered_property, fn($data) => $data['quiz_name'] == $quiz_name);
        }
        

        $quiz_record = $unfiltered_property;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("navbar_teacher.php")?>
    <br>
    <form method='post'class="container shadow p-3">
        <h4 class='text-center'> Filter </h4>
        <select name="subject" id=""  class='form-control mt-2'>
            <option value=""> all subject </option>
            <option value="integrative programming"> integrative programming </option>
            <option value="web system"> web system </option>
            <option value="info management"> info management </option>
        </select>

        <select name="section" id="studentSection" class='form-control mt-2'>
                <option value=""> all section </option>
                <option value="21m1"> 21m1 </option>
                <option value="21m2"> 21m2 </option>
                <option value="21m3"> 21m3 </option>
                <option value="21m4"> 21m4 </option>
        </select>

        <input name='quiz_name' type="text" placeholder="Quiz name" class='form-control mt-2'>
        <input name='student_id' type="text" placeholder="student id" class='form-control mt-2'>

        <input type="submit" class='btn btn-dark mt-2' style='width:100%'>
</form>
    
    <br>

    <table class='table table-striped container shadow'>
        <tr class='table-dark'>
            <th> Subject </th>
            <th> Quiz </th>
            <th> Name </th>
            <th> student_id </th>
            <th> Section</th>
            <th> score  </th>
        </tr>
        <?php foreach($quiz_record as $record): ?>
            <tr>
                <td> <?=$record['quiz_subject']?> </td>
                <td> <?=$record['quiz_name']?> </td>
                <td> <?=$record['student_name']?> </td>
                <td> <?=$record['student_id']?> </td>
                <td> <?=$record['section']?> </td>
                <td> <?=$record['quiz_score']?> </td>
            </tr>
        <?php endforeach?>
    </table>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       
    </script>
</body>
</html>