<?php
include("backend/database.php");
include("backend/student_checker.php");
$code = $_POST['quiz_code'];
$timer = $_POST['quiz_timer'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body{
            user-select :none;
        }
    </style>
</head>
<body>
    <?php include("navbar_student.php")?>
    
    <input type="hidden" id='quiz_code' value="<?=$code?>">
    <input type="hidden" id='quiz_timer' value="<?=$timer?>">
    <input type="hidden" id='student_id' value="<?=$_SESSION['student']['student_id']?>">
    
    <h1 id="timer"> </h1>

    <div class="container" id='scoreboard'>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        
        $(document).ready(()=>{

            let final_score = "0";
            let isAlert = false;
            let isFinished = false;

            window.addEventListener("focus", () => {
                if (!isAlert)
                 {
                    isAlert = true;
                    alert("you caught cheating");
                    $.ajax({
                        url : "backend/record_quiz.php",
                        method : "post",
                        data : {
                            quiz_code : $("#quiz_code").val(),
                            quiz_score : `<span class="badge bg-danger"> Cheated </span>`,
                            student_id : $("#student_id").val(),
                        },
                        success : (response) => {
                            window.location.href = "student.record.php"
                        }
                    })
                }
            });

            let countdown;

            function startTimer() {
            const inputMinutes = document.getElementById('quiz_timer').value;
            let timeInSeconds = inputMinutes * 60; 
            
            if (countdown) clearInterval(countdown); 
            
            countdown = setInterval(function() {
                const minutes = Math.floor(timeInSeconds / 60);
                const seconds = timeInSeconds % 60;
                
                document.getElementById('timer').textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
                
                if (timeInSeconds <= 0 && !isFinished) {
                clearInterval(countdown);
                    alert("Time's up! your score is " + final_score );
                    isAlert = true;
                    $.ajax({
                        url : "backend/record_quiz.php",
                        method : "post",
                        data : {
                            quiz_code : $("#quiz_code").val(),
                            quiz_score : final_score,
                            student_id : $("#student_id").val(),
                        },
                        success : (response) => {
                            window.location.href = "student.record.php"
                        }
                    })
                } else {
                timeInSeconds--;
                }
            }, 1000);
            }

            startTimer()



            
            async function question_answer(question, answer)
            {
                const { value: formValues } = await Swal.fire({
                        title: question,
                        allowOutsideClick: false,
                        confirmButtonColor: '#000000', 
                        html: `
                            <input id="swal-input1" class="swal2-input ">
                        `,
                        focusConfirm: false,
                        preConfirm: () => {
                            return [
                            document.getElementById("swal-input1").value,
                            ];
                        }
                        });
                    if (formValues)
                    {
                        if(formValues[0] == answer)
                        {
                            return true
                        }
                        else
                        {
                            return false
                        }
                    }
            } 

            $.ajax({
                    url : "backend/get_quiz_items.php",
                    method : "post",
                    data : {
                        quiz_code : $("#quiz_code").val(),
                    },
                    success : async (response) => {
                    let all_items = JSON.parse(response)
                    let over = all_items.length
                    let score = 0;

                    for(i = 0; i < over; i++)
                    {
                        if(await question_answer(all_items[i].question, all_items[i].answer))
                        {
                            score++;
                            final_score = score + "/" + over;
                        }
                    }

                    $("#timer").hide()
                    isFinished = true;

                    $.ajax({
                        url : "backend/record_quiz.php",
                        method : "post",
                        data : {
                            quiz_code : $("#quiz_code").val(),
                            quiz_score : final_score,
                            student_id : $("#student_id").val(),
                        },
                        success : (response) => {                            
                            $("#scoreboard").append(`
                                <br><br><br><br><br><br><br><br>
                                <h1 class='text-center text-success' style='transform: scale(3)'> SCORE: ${final_score} </h1>
                                <br><br><br> <br><br>
                                <div class='row'>
                                    <div class="col"></div>
                    
                                    <div class="col">
                                    <a href="student.record.php" class='btn btn-primary' style='background: black;width:100%; transform: scale(2)'> Home </a>
                                </div>
                                <div class="col"></div>
                                </div>
                            `);
                        }   
                    })

                }
            })

            
        })

    </script>
</body>
</html>