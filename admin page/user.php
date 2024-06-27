<?php

include '../config.php';

session_start();
    if($_SESSION['login']==false) {
        header('location: login.php');
    }

// Fetch user data from database
$queryuser = mysqli_query($conn, "SELECT * FROM user");
$jumlahuser = mysqli_num_rows($queryuser);


if(isset($_POST['delete-btn'])){
    $username = ($_POST['username']);
    $querydelete = mysqli_query($conn, "DELETE FROM `user` WHERE username = '$username'");

    // run query DELETE
    if ($querydelete) {
        echo "<script> alert('User Berhasil di Hapus'); </script>";
            ?>
                <meta http-equiv="refresh" content="0; url=user.php" />
            <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

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
    <link rel="stylesheet" href="../css/user.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-warning p-3">
        <div class="container">
            <a class="navbar-brand">
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
                    echo '<button class="btn1 mx-2" onclick="location.href=\'../logout.php\'" type="submit">Log Out</button>';
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
            <li class="nav-item">
                <a href="admin_page.php" style="color: #E8B832;"><i class="fa-solid fa-gauge fa-1x"></i> Dashboard</a>
            </li>
            <li class="nav-item active">
                <a href="user.php" style="color: #E8B832;"><i class="fa-solid fa-user fa-1x"></i> User</a>
            </li>
            <li class="nav-item">
                <a href="recipe_page.php" style="color: #E8B832;"><i class="fas fa-align-justify fa-1x"></i> Recipe</a>
            </li>
        </ul>
    </nav>

    <!-- Start Tabel -->
    <div class="col-9 p-5">
    <div class="table-responsive mt-3">
            <table border="1" class="table">
                <h2>List User</h2>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Profile picture</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            if($jumlahuser == 0){
                    ?>
                            <tr>
                                <td colspan=3 class="text-center">Tidak ada data</td>
                            </tr>
                    <?php

                            }
                            else{
                                $number = 1;
                                while($data=mysqli_fetch_array($queryuser)){
                            ?>
                                    <tr>
                                        <td><?php echo $number; ?></td>
                                        <td><img src="../img/<?php echo $data["profpic"] ?>" alt="" width="120px" height="120px"></td>
                                        <td><?php echo $data['username']; ?></td>
                                        <td><?php echo $data['email']; ?></td>   
                                    </tr>
                            <?php
                                $number++;
                                }
                            }
                        
                    ?>
                </tbody>
            </table>
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">    
            <div class="judul text-center mt-5"><h2>Delete Akun</h2></div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" name="username" placeholder="Username">
            </div>
            <button type="sumbit" name="delete-btn" class="btn3">Delete</button>
        </div>    
        </div>
    <!-- End Tabel -->
    </div>
</div>
<!-- End Sidebar -->

</body>

</html>
