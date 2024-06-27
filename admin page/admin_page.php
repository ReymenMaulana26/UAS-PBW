<?php

include '../config.php';

    session_start();
    if($_SESSION['login']==false) {
        header('location: login.php');
    }

// Fetch recipes data from database
$queryuser = mysqli_query($conn, "SELECT * FROM user");
$jumlahuser = mysqli_num_rows($queryuser);


// Fetch recipes data from database
$queryrecipe = mysqli_query($conn, "SELECT * FROM recipe");
$jumlahrecipe = mysqli_num_rows($queryrecipe);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CooKING WebApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_page.css">
</head>

<body>
    <!--Start Navbar -->
    <nav class="navbar navbar-expand-lg bg-warning p-3">
        <div class="container">
            <a class="navbar-brand" href="admin_page.php">
                <img src="../asset/cookingmainlogo.png" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_page.php">Home</a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['username_admin'])) {
                    // User is signed in, show logout button
                    echo '<button class="btn2 mx-2" onclick="location.href=\'../logout.php\'" type="submit">Log Out</button>';
                } else {
                    // User is not signed in, show sign in and sign up buttons
                    echo '<button class="btn1 mx-2" onclick="location.href=\'signin.php\'" type="submit">Sign In</button>';
                    echo '<button class="btn2 mx-2" onclick="location.href=\'signup.php\'" type="submit">Sign Up</button>';
                }
                ?>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    
    <!-- Start Sidebar -->
<div class="wrapper">
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>

        <ul class="nav-item">
            <li class="nav-item active">
                <a href="admin_page.php" style="color: #E8B832;"><i class="fa-solid fa-gauge fa-1x"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="user.php" style="color: #E8B832;"><i class="fa-solid fa-user fa-1x"></i> User</a>
            </li>
            <li class="nav-item">
                <a href="recipe_page.php" style="color: #E8B832;"><i class="fas fa-align-justify fa-1x"></i> Recipe</a>
            </li>
        </ul>
    </nav>

    <!-- Start content -->
    <div class="col-8 p-5">
    <div class="container mt-3">
        <h1>Dasboard</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="summary-user p-3 mt-3">
                <div class="row">
                    <div class="col-5">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-6">
                        <h3 class="fs-2" style="margin-bottom: 0">User</h3>
                        <p class="fs-8" style="margin: 0; padding-top: 0;"><?php echo $jumlahuser; ?> User</p>
                        <p><a href="user.php" class="text-white fs-8" style="text-decoration: none">Lihat Detail</a></p>
                    </div>
                </div>
            </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-category p-3 mt-3">
                <div class="row">
                    <div class="col-4">
                        <i class="fas fa-align-justify fa-5x"></i>
                    </div>
                    <div class="col-6">
                        <h3 class="fs-2" style="margin-bottom: 0">Recipe</h3>
                        <p class="fs-8" style="margin: 0; padding-top: 0;"><?php echo $jumlahrecipe; ?> Recipe</p>
                        <p><a href="recipe.php" class="text-white fs-8" style="text-decoration: none">Lihat Detail</a></p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- End content -->
    </div>
</div>
<!-- End Sidebar -->

</body>

</html>
