<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  
</head>
<body>
    <body class="bg-light">
        <div class="" style="height:100vh;">
            <div class="row h-100 m-0">
                <div class="card w-25 my-auto mx-auto">
                    <div class="card-header bg-white border-0 py-3">
                        <h1 class="text-center">LOGIN</h1>
                    </div>
                    <div class="card-body">
                        <form action="../actions/login.php" method="post">
                            <input type="text" name="username" placeholder="USERNAME" class="form-control mb-2" required autofocus>
                            <input type="password" name="password" placeholder="PASSWORD" class="form-control mb-5">

                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </form>

                        <p class="text-center mt-3 small"><a href="register.php">Create Account</a></p>
                    </div>
                </div>
        </div>
        
    </body>
</body>
</html>