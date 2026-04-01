<?php 
// Critical: Always start the session at the very top
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $pass = $_POST["pass"];

    $sql = $conn->prepare("SELECT user_id, password FROM user WHERE username = ?");
    $sql->bind_param("s", $name);
    $sql->execute();
    $sql->store_result();
    $sql->bind_result($id, $hashed_password);

    if ($sql->fetch() && password_verify($pass, $hashed_password)) {
        $_SESSION["id"] = $id;
        header("location:dashboard.php");
        exit(); // Always exit after a header redirect
    } else {
        $error = "Invalid username or password.";
    }
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
                --bg-soft: #f4f7f6;
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
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.08);
                padding: 50px;
                width: 100%;
                max-width: 400px;
            }

            h2 {
                font-family: 'Playfair Display', serif;
                color: var(--primary-color);
                font-weight: 700;
                margin-bottom: 30px;
            }

            .form-label {
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 1.2px;
                font-weight: 600;
                color: #999;
            }

            .form-control {
                border: 1px solid #eee;
                padding: 12px;
                border-radius: 10px;
                background-color: #f9f9f9;
            }

            .form-control:focus {
                background-color: #fff;
                box-shadow: 0 0 0 4px rgba(44, 62, 80, 0.05);
                border-color: var(--primary-color);
            }

            .btn-login {
                background: var(--primary-color);
                color: white;
                border: none;
                padding: 14px;
                border-radius: 10px;
                font-weight: 600;
                width: 100%;
                margin-top: 20px;
                transition: 0.3s;
            }

            .btn-login:hover {
                background: #1a252f;
                transform: translateY(-2px);
            }

            .brand-name {
                position: absolute;
                top: 40px;
                font-family: 'Playfair Display', serif;
                font-size: 1.5rem;
                text-decoration: none;
                color: var(--primary-color);
            }
        </style>
    </head>

    <body>
        <a href="#" class="brand-name">The Journal.</a>

        <div class="login-card">
            <h2 class="text-center">Welcome Back</h2>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger py-2 small"><?= $error ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-4">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="name" required />
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" required />
                </div>

                <button type="submit" class="btn btn-login">Sign In</button>
            </form>
            
            <p class="text-center mt-4 small text-muted">
                New here? <a href="register.php" class="text-dark fw-bold">Create Account</a>
            </p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>