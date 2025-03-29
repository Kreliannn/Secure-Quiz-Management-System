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
            <h3 class="text-center mb-4"> Teacher Login</h3>
            <div class="mb-3">
                <input id='username'type="text" class="form-control shadow" placeholder="username" required>
            </div>
            <div class="mb-3">
                <input id='password'type="password" class="form-control shadow" placeholder="Password" required>
            </div>
            <hr>
            <button  id='btn' class="btn btn-dark w-100 shadow" >Login</button>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $("#btn").click(function(e) {
                
                var username = $("#username").val();
                var password = $("#password").val();

                $.ajax({
                    url: "backend/teacher_login.backend.php",  
                    type: "POST",
                    data: {
                        username: username,
                        password: password
                    },
                    success: (response) => {
                       if(response == "success")
                       {
                            window.location.href = "teacher_home.php";
                       }
                       else
                       {
                        Swal.fire({
                            title: "invalid",
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