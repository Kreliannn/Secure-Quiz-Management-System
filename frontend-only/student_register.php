<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include("navbar.php")?>
    <div class="container mt-5">
        <div class="w-50 mx-auto">
            <h3 class="text-center mb-4"> Student Register</h3>
            <div class="mb-3">
                <input id='studentName' type="text" class="form-control shadow" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <input id='studentId'type="text" class="form-control shadow" placeholder="student_id" required>
            </div>
            <select name="" id="studentSection" class='form-control shadow'>
                <option value="21m1"> 21m1 </option>
                <option value="21m2"> 21m2 </option>
                <option value="21m3"> 21m3 </option>
                <option value="21m4"> 21m4 </option>
            </select>
            <div class="mb-3">
                <input id='studentPassword'type="password" class="form-control mt-3 shadow" placeholder="Password" required>
            </div>
            <hr>
            <button  id='btn' class="btn btn-dark w-100 shadow">Register</button>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $("#btn").click(function(e) {
                

                var studentName = $("#studentName").val();
                var studentId = $("#studentId").val();
                var studentSection = $("#studentSection").val();
                var studentPassword = $("#studentPassword").val();

                $.ajax({
                    url: "backend/student_register.backend.php",  // Your server-side script to handle the registration
                    type: "POST",
                    data: {
                        name: studentName,
                        student_id: studentId,
                        section: studentSection,
                        password: studentPassword
                    },
                    success: function(response) {
                        if(response == "success")
                       {
                        Swal.fire({
                            title: "account created",
                            confirmButtonColor: '#000000', 
                            icon: "success"
                        });
                       }
                       else
                       {
                        Swal.fire({
                            title: "student id is taken",
                            confirmButtonColor: '#000000', 
                            icon: "error"
                        });
                       }
                    },
                    
                });
            });
        });
    </script>
</body>
</html>
