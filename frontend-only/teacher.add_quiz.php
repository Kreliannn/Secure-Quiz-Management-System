<?php

include("backend/database.php");
include("backend/teacher_checker.php");
$data = $conn->query("SELECT * FROM quiz");
$all_quiz = fetchAll($data);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <?php include("navbar_teacher.php")?>
    
    <br>

    <div class="container border shadow p-5" style=''>
        <h1 class='text-center'> Add Quiz</h1>
        <select  id="quiz_subject" class='form-control mt-2'>
            <option value="integrative programming"> integrative programming </option>
            <option value="web system"> web system </option>
            <option value="info management"> info management </option>
        </select>
        <input id="quiz_name"type="text" placeholder="quiz name" class='form-control mt-2'>
        <input id='quiz_code' type="hidden" placeholder="quiz code" class='form-control mt-2' value="<?=uniqid()?>">
        <input type="date" id='quiz_deadline' class='form-control mt-2'>
        <input id='quiz_timer' type="number" placeholder="quiz timer seconds" class='form-control mt-2'>
        <input id='quiz_items' type="number" placeholder="quiz items" class='form-control mt-2'>
        <hr>
        <button id='btn' class='btn btn-dark' style='width:100%'> add Q&A</button>

    </div>
    <br>
    <br>

    <table id="table" class="display container shadow ">
    <thead>
        <tr>
            <th>subject</th>
            <th>Quiz</th>
            <th>items</th>
            <th>deadline</th>
            <th>remove</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($all_quiz as $quiz):?>
            <tr>
                <td> <?=$quiz['quiz_subject']?> </td>
                <td> <?=$quiz['quiz_name']?> </td>
                <td> <?=$quiz['quiz_items']?> </td>
                <td> <?=$quiz['quiz_deadline']?> </td>
                <td> <form action="backend/remove_quiz.php" method='post'> <input type="hidden" name="quiz_code" value='<?=$quiz['quiz_code']?>'> <input type="submit" value='remove' class='btn btn-dark'></form> </td>
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
            
            async function question_answer(i, quiz_name, quiz_code)
            {
                const { value: formValues } = await Swal.fire({
                        title: quiz_name + " number " + i,
                        allowOutsideClick: false,
                        confirmButtonColor: '#000000', 
                        html: `
                            <input id="swal-input1" class="swal2-input autocomplete='off'">
                            <input id="swal-input2" class="swal2-input autocomplete=off'">
                        `,
                        focusConfirm: false,
                        preConfirm: () => {
                            return [
                            document.getElementById("swal-input1").value,
                            document.getElementById("swal-input2").value
                            ];
                        }
                        });
                    if (formValues)
                    {
                        console.log()
                        console.log(formValues[1])
                        $.ajax({
                            url : "backend/insert_question_answer.php",
                            method : "post",
                            data : {
                                question : formValues[0], 
                                answer : formValues[1], 
                                code : quiz_code
                            },
                            success : (response) => {
                                console.log(response)
                            }
                        })
                    }
            } 

            $("#btn").click( async ()=>{
                let quiz_items = Number($("#quiz_items").val())
                let quiz_name = $("#quiz_name").val()
                let quiz_code = $("#quiz_code").val()
                let quiz_subject = $("#quiz_subject").val()
                let quiz_deadline = $("#quiz_deadline").val()
                let quiz_timer = $("#quiz_timer").val()

                $.ajax({
                    url : "backend/check_quiz.php",
                    method : "post",
                    data : {
                        quiz_name : quiz_name, 
                        quiz_items : quiz_items, 
                        quiz_code : quiz_code,
                        quiz_subject : quiz_subject,
                        quiz_deadline : quiz_deadline,
                        quiz_timer : quiz_timer
                    },
                    success : async (response) => {
                        if(response == "exist")
                        {
                            Swal.fire({
                            title: quiz_name + " is already exist",
                            confirmButtonColor: '#000000', 
                            icon: "error"
                        });
                        }
                        else if(response == "empty")
                        {
                            Swal.fire({
                            title: "empty field",
                            confirmButtonColor: '#000000', 
                            icon: "error"
                        });
                        }
                        else if(response == "invalid timer")
                        {
                            Swal.fire({
                            title: "invalid timer",
                            confirmButtonColor: '#000000', 
                            icon: "error"
                        });
                        }
                        else if(response ==  "success")
                        {
                                for(i = 1; i <= quiz_items; i++ )
                                {
                                    await question_answer(i, quiz_name, quiz_code);
                                }

                                $.ajax({
                                    url : "backend/create_quiz.php",
                                    method : "post",
                                    data : {
                                        quiz_name : quiz_name, 
                                        quiz_items : quiz_items, 
                                        quiz_code : quiz_code,
                                        quiz_subject : quiz_subject,
                                        quiz_deadline : quiz_deadline,
                                        quiz_timer : quiz_timer
                                    },
                                    success : (response) => {
                                        alert("quiz added")
                                        window.location.reload()
                                    }
                                })

                        }
                    }
                })

            })
        })

    </script>
</body>
</html>