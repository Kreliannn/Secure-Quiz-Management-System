<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("navbar.php")?>
    <div class="container mt-5">
        <div class="w-50 mx-auto">
            <h3 class="text-center mb-4"> Student Login</h3>
            <div class="mb-3">
                <input id='studentId'type="text" class="form-control shadow " placeholder="student_id" required>
            </div>
            <div class="mb-3">
                <input id='studentPassword'type="password" class="form-control shadow" placeholder="Password" required>
            </div>
            <hr>
            <button  id='btn' class="btn btn-dark w-100 shadow">Login</button>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $("#btn").click(function(e) {
                
                var studentId = $("#studentId").val();
                var studentPassword = $("#studentPassword").val();

                $.ajax({
                    
                    url: "backend/student_login.backend.php",  

                    type: "POST",

                    data: {
                        student_id: studentId,
                        password: studentPassword
                    },

                    success: (response) => {
                       if(response == "success")
                       {
                            window.location.href = "student.record.php";
                       }
                       else
                       {
                        Swal.fire({
                            title: "user does not exist",
                            confirmButtonColor: '#000000', 
                            icon: "error"
                        });
                       }
                    }
                    
                });
            });
        });
    </script>
</body>
</html>