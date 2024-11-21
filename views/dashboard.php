<?php
    include "../classes/User.php";
    session_start();

    $user = new User();
    $user_list =$user->getAllUsers();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
  
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px">
        <div class="container">
            <a href="dashboard.php" class="navbar-brand">
                <h1 class="h3">The Company</h1>
            </a>
            <div class="navbar-nav">
                <span class="navbar-text"><?= $_SESSION['full_name'] ?></span>
                <form action="../actions/logout.php" method="post" class="d-flex ms-2">
                    <button type="submit" class="text-danger bg-transparent border-0">Log Out</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="row justify-content-center gx-0">
        <div class="col-6">
            <h2 class="text-center">USER LIST</h2>

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th><!--for photo--></th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th><!--for action buttons--></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($user_data = $user_list-> fetch_assoc()){
                            $photo = "<i class='fa-solid fa-user dashboard-icon'></i>";

                            if($user_data["photo"] != NULL){
                                $photo ="<img class='edit-photo' src='../assets/images/".$user_data["photo"]."'>";
                            }
                    ?>

                    <tr>
                        <td><?= $photo ?></td>
                        <td><?=$user_data["id"]?></td>
                        <td><?=$user_data["first_name"]?></td>
                        <td><?=$user_data["last_name"]?></td>
                        <td><?=$user_data["username"]?></td>
                        <td>

                            <?php
                                if($user_data["id"]==$_SESSION["id"]){

                            ?>
                            <a href="edit-user.php" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pencil"></i></a>
                            <a href="delete-user.php" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                            <?php
                                }
                            ?>
                        </td>

                    </tr>

                    <?php
                        }
                    ?>
                    

                </tbody>
            </table>
        </div>
    </main>
</body>


</html>