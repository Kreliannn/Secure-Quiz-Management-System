

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Teacher Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active ms-3" aria-current="page" href="teacher.add_quiz.php">Add Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active ms-3" aria-current="page" href="teacher_home.php">Students Records</a>
                </li>
                <li class="nav-item ms-5">
                <form action="backend/logout.php" method="post" > <input type="submit" class='btn btn-danger' value="log out"></form>
                </li>
            </ul>
        </div>
    </div>
</nav>