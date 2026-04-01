<?php 
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $name = $_POST["name"];
    // Using password_hash is excellent for security
    $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

    $sql = $conn->prepare("INSERT INTO user(email, username, password) VALUES(?,?,?)");
    $sql->bind_param("sss", $email, $name, $pass);
    
    if ($sql->execute()) {
        header("location:login.php?signup=success");
        exit();
    } else {
        $error = "Registration failed. Username or Email might already be taken.";
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Join The Journal</title>
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
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .register-card {
                background: white;
                border: none;
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.08);
                padding: 40px;
                width: 100%;
                max-width: 450px;
            }

            h2 {
                font-family: 'Playfair Display', serif;
                color: var(--primary-color);
                font-weight: 700;
                margin-bottom: 10px;
            }

            .form-label {
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 1.2px;
                font-weight: 600;
                color: #999;
                margin-bottom: 8px;
            }

            .form-control {
                border: 1px solid #eee;
                padding: 12px;
                border-radius: 10px;
                background-color: #f9f9f9;
                transition: 0.3s;
            }

            .form-control:focus {
                background-color: #fff;
                box-shadow: 0 0 0 4px rgba(44, 62, 80, 0.05);
                border-color: var(--primary-color);
            }

            .btn-register {
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

            .btn-register:hover {
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
        <a href="login.php" class="brand-name">The Journal.</a>

        <div class="register-card">
            <h2 class="text-center">Create Account</h2>
            <p class="text-center text-muted mb-4 small">Start sharing your stories today.</p>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger py-2 small"><?= $error ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="name@example.com" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="name" placeholder="Choose a public name" required />
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="Create a strong password" required />
                </div>

                <button type="submit" class="btn btn-register">Create Account</button>
            </form>
            
            <p class="text-center mt-4 small text-muted">
                Already have an account? <a href="login.php" class="text-dark fw-bold">Sign In</a>
            </p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>