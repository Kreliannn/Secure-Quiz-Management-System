<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $.getJSON("https://catfact.ninja/facts", (response) => {
                
                let cat_facts = response.data

                console.log(cat_facts)

                cat_facts.map((data) => {                                                            
                    document.body.innerHTML += data.fact;
                    document.body.innerHTML += "<br> <br> <br>";
                })
            })

        });
    </script>
</body>
</html>