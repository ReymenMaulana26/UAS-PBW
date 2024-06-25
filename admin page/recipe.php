<?php

include '../config.php';

session_start();
    if($_SESSION['login']==false) {
        header('location: login.php');
    }

// Fetch user data from database
$queryrecipe = mysqli_query($conn, "SELECT * FROM recipe");
$jumlahrecipe = mysqli_num_rows($queryrecipe);


if(isset($_POST['delete-btn'])){
    $recipe_id = ($_POST['recipe_id']);
    $recipe_name = ($_POST['recipe_name']);
    $sqlbahan = mysqli_query($conn, "DELETE FROM bahan WHERE resep_id = $recipe_id");
    $querydelete = mysqli_query($conn, "DELETE FROM `recipe` WHERE recipe_id = '$recipe_id' AND recipe_name = '$recipe_name'");

    // run query DELETE
    if ($querydelete) {
        echo "<script> alert('Recipe Berhasil di Hapus'); </script>";
            ?>
                <meta http-equiv="refresh" content="0; url=recipe.php" />
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
    <link rel="stylesheet" href="../css/recipe.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-warning p-3">
        <div class="container">
            <a class="navbar-brand" href="index.php">
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
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
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

    <!-- Start Nested nav -->
     <div class="row">
  <div class="col-lg-2">
    <div class="container-nav">
        <nav id="navbar-example3">
        <nav class="nav nav-pills flex-column">
            <a class="nav-link" href="" ></a>
            <a class="nav-link" href=""></a>
            <a class="nav-link" href=""></a>
            <a class="nav-link" href="admin_page.php" style="color: #E8B832;"><i class="fa-solid fa-gauge fa-1x"></i> Dashboard</a>
            <a class="nav-link" href="user.php" style="color: #E8B832;"><i class="fa-solid fa-user fa-1x"></i> User</a>
            <a class="nav-link" href="recipe.php" style="color: #E8B832;"><i class="fas fa-align-justify fa-1x"></i> Recipe</a>   
        </nav>
    </div>
  </div>
    <!-- End Nested nav -->

    <!-- Start Tabel -->
    <div class="col-9 p-5">
    <div class="table-responsive mt-3">
            <table border="1" class="table">
                <h2>List Recipe</h2>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Description</th>
                        <th>Recipe Id</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            if($jumlahrecipe == 0){
                    ?>
                            <tr>
                                <td colspan=3 class="text-center">Tidak ada data</td>
                            </tr>
                    <?php

                            }
                            else{
                                $number = 1;
                                while($data=mysqli_fetch_array($queryrecipe)){
                            ?>
                                    <tr>
                                        <td><?php echo $number; ?></td>
                                        <td><?php echo $data['recipe_name']; ?></td>
                                        <td><img src="../img/<?php echo $data["recipe_img"] ?>" alt="" width="120px" height="120px"></td>
                                        <td><?php echo $data['description']; ?></td>
                                        <td><?php echo $data['recipe_id']; ?></td>   
                                    </tr>
                            <?php
                                $number++;
                                }
                            }
                        
                    ?>
                </tbody>
            </table>
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">    
            <div class="judul text-center mt-5"><h2>Delete Recipe</h2></div>
            <div class="mb-3">
                <label for="recipe_id" class="form-label">Id Recipe</label>
                <input type="text" id="recipe_id" class="form-control" name="recipe_id" placeholder="Masukan Id Recipe">
            </div>
            <div class="mb-3">
                <label for="recipe_name" class="form-label">Nama Recipe</label>
                <input type="text" id="recipe_name" class="form-control" name="recipe_name" placeholder="Masukan Nama Recipe">
            </div>
            <button type="sumbit" name="delete-btn" class="btn3">Delete</button>
        </div>    
        </div>
    <!-- End Tabel -->

</body>

</html>
