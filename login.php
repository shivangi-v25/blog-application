<?php 
// Keeping your backend logic exactly as it was
include 'db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
   
   $name=$_POST["name"];
   $pass=$_POST["pass"];

   $sql=$conn->prepare("select user_id ,password from user where username=? ");
   $sql->bind_param("s",$name);
   $sql->execute();
   $sql->store_result();
   $sql->bind_result($id,$password);
   if ($sql->fetch()&&password_verify($pass,$password)) {
        $_SESSION["id"]=$id;
       header("location:dashboard.php");
   }else{
header("location:login.php");}
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Login - The Journal</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

        <style>
            :root {
                --primary-color: #2c3e50;
                --bg-soft: #f8f9fa;
            }

            body {
                background-color: var(--bg-soft);
                font-family: 'Inter', sans-serif;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-card {
                background: white;
                border: none;
                border-radius: 24px;
                box-shadow: 0 20px 50px rgba(0,0,0,0.05);
                padding: 40px;
                width: 100%;
                max-width: 400px;
            }

            h2 {
                font-family: 'Playfair Display', serif;
                color: var(--primary-color);
                font-weight: 700;
                text-align: center;
                margin-bottom: 30px;
            }

            .form-label {
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.7rem;
                letter-spacing: 1px;
                color: #888;
            }

            .form-control {
                border: 1px solid #eee;
                padding: 12px;
                border-radius: 12px;
                background-color: #fcfcfc;
            }

            .form-control:focus {
                box-shadow: 0 0 0 4px rgba(44, 62, 80, 0.05);
                border-color: var(--primary-color);
                background-color: #fff;
            }

            .btn-login {
                background: var(--primary-color);
                color: white;
                border: none;
                padding: 12px;
                border-radius: 12px;
                font-weight: 600;
                width: 100%;
                margin-top: 20px;
                transition: 0.3s;
            }

            .btn-login:hover {
                background: #1a252f;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .brand-overlay {
                position: absolute;
                top: 40px;
                font-family: 'Playfair Display', serif;
                font-size: 1.5rem;
                color: var(--primary-color);
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <a href="#" class="brand-overlay">The Journal.</a>

        <div class="login-card">
            <h2>Welcome Back</h2>
            
            <form method="post">
                <div class="mb-4">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="name" required />
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" required />
                </div>

                <button type="submit" class="btn btn-login">Login to Account</button>
            </form>
            
            <div class="text-center mt-4">
                <small class="text-muted">Don't have an account? <a href="register.php" class="text-dark fw-bold">Sign up</a></small>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>