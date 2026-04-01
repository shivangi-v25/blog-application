<?php 
include 'db.php';
if (!isset($_SESSION["id"])) {
   header("location:login.php");
}

if ($_SERVER["REQUEST_METHOD"]=="POST") {
   $title=$_POST["title"];
   $content=$_POST["content"];
   $filename=$_FILES["file"]["name"];
   $id=$_SESSION["id"];

   if (!empty($filename)) {
       move_uploaded_file($_FILES["file"]["tmp_name"],"upload/$filename");
       $sql=$conn->prepare("insert into blog(user_id,title,content,fname) values(?,?,?,?)");
       $sql->bind_param("isss",$id,$title,$content,$filename);
       
       if ($sql->execute()) {
           header("location:dashboard.php");
       } else {
           echo "<script>alert('Failed to save story. Please try again.')</script>";
       }
   } else {
       echo "<script>alert('Please select a feature image.')</script>";
   }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>New Story - The Journal</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

        <style>
            :root {
                --primary-color: #2c3e50;
                --bg-soft: #f8f9fa;
                --accent-success: #27ae60;
            }

            body {
                background-color: var(--bg-soft);
                font-family: 'Inter', sans-serif;
                color: #333;
            }

            h2, h4, .navbar-brand {
                font-family: 'Playfair Display', serif;
            }

            .main-content {
                min-height: calc(100vh - 160px);
                display: flex;
                align-items: center;
                padding: 40px 0;
            }

            .form-card {
                background: white;
                border: none;
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0,0,0,0.05);
                padding: 40px;
                width: 100%;
                max-width: 650px;
                margin: auto;
            }

            .form-label {
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 1px;
                color: #888;
                margin-bottom: 8px;
            }

            .form-control {
                border: 1px solid #eee;
                padding: 12px 15px;
                border-radius: 10px;
                background-color: #fcfcfc;
            }

            .form-control:focus {
                box-shadow: 0 0 0 4px rgba(44, 62, 80, 0.05);
                border-color: var(--primary-color);
                background-color: #fff;
            }

            .btn-post {
                background: var(--primary-color);
                color: white;
                border: none;
                padding: 14px;
                border-radius: 12px;
                font-weight: 600;
                width: 100%;
                margin-top: 10px;
                transition: all 0.3s ease;
            }

            .btn-post:hover {
                background: #1a252f;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .navbar {
                border-bottom: 1px solid #eee;
                background: white !important;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand fs-3" href="dashboard.php">The Journal.</a>
                <div class="d-flex gap-2">
                    <a href="dashboard.php" class="btn btn-outline-dark btn-sm rounded-pill px-3">Cancel</a>
                    <a href="logout.php" class="btn btn-danger btn-sm rounded-pill px-3">Logout</a>
                </div>
            </div>
        </nav>

        <main class="main-content">
            <div class="container">
                <div class="form-card">
                    <div class="text-center mb-4">
                        <h2 class="mb-1">Create New Story</h2>
                        <p class="text-muted small">Share your thoughts with the world</p>
                    </div>
                    
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="form-label">Headline</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter a catchy title..." required />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Story Content</label>
                            <textarea class="form-control" name="content" rows="6" placeholder="What's on your mind?" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Feature Image</label>
                            <input type="file" class="form-control" name="file" accept="image/*" required />
                            <div class="form-text mt-2" style="font-size: 0.7rem;">High-resolution landscape images work best.</div>
                        </div>

                        <button type="submit" class="btn btn-post">Publish Story</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="py-4 bg-white border-top">
            <div class="container text-center">
                <p class="text-muted mb-0 small">&copy; <?= date('Y') ?> The Modern Journal. All rights reserved.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>