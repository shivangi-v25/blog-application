<?php 
include 'db.php';
if (!isset($_SESSION["id"])) {
   header("location:login.php");
}

if (isset($_GET["id"])) {
  $bid=$_GET["id"];
  $result=$conn->prepare("select * from blog where bid=?");
  $result->bind_param("i",$bid);
  $result->execute();
  $data=$result->get_result()->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"]=="POST") {
   $title=$_POST["title"];
   $content=$_POST["content"];
   $old_img=$_POST["old"];
   $filename=$_FILES["new"]["name"]?:$old_img;
   
   if (!empty($_FILES["new"]["name"])) {
    move_uploaded_file($_FILES["new"]["tmp_name"],"upload/$filename");
   }

   $sql=$conn->prepare("update blog set title=?,content=?,fname=? where bid=?");
   $sql->bind_param("sssi",$title,$content,$filename,$bid);
   if ($sql->execute()) {
    header("location:dashboard.php");
   } else {
    header("location:edit.php?id=$bid");
   }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Edit Post - The Journal</title>
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
                color: #333;
            }

            h2, .navbar-brand, h4 {
                font-family: 'Playfair Display', serif;
            }

            .edit-container {
                max-width: 700px;
                margin: 50px auto;
            }

            .form-card {
                background: white;
                border: none;
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0,0,0,0.05);
                padding: 40px;
            }

            .form-label {
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 1px;
                color: #888;
            }

            .form-control {
                border: 1px solid #eee;
                padding: 12px;
                border-radius: 10px;
                transition: 0.3s;
            }

            .form-control:focus {
                box-shadow: 0 0 0 4px rgba(44, 62, 80, 0.1);
                border-color: var(--primary-color);
            }

            .current-img-preview {
                border-radius: 12px;
                object-fit: cover;
                border: 3px solid #fff;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .btn-save {
                background: var(--primary-color);
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 50px;
                font-weight: 600;
                width: 100%;
                margin-top: 20px;
                transition: 0.3s;
            }

            .btn-save:hover {
                background: #1a252f;
                transform: translateY(-2px);
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
            <div class="container">
                <a class="navbar-brand fs-3" href="dashboard.php">The Journal.</a>
                <a href="dashboard.php" class="btn btn-outline-dark btn-sm rounded-pill px-3">Back to Feed</a>
            </div>
        </nav>

        <main class="container">
            <div class="edit-container">
                <div class="form-card">
                    <h2 class="text-center mb-4">Edit Your Story</h2>
                    
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="form-label">Story Title</label>
                            <input type="text" class="form-control" name="title" value="<?=$data["title"] ?>" required />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Content</label>
                            <textarea class="form-control" name="content" rows="2" required><?=$data["content"] ?></textarea>
                        </div>

                        <div class="mb-4 p-3 bg-light rounded-4">
                            <label class="form-label d-block mb-3">Feature Image</label>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <img src="upload/<?= $data["fname"]?>" class="current-img-preview w-100" alt="Current">
                                </div>
                                <div class="col-8">
                                    <small class="text-muted d-block mb-2">Upload new image to replace</small>
                                    <input type="file" class="form-control form-control-sm" name="new" />
                                    <input type="hidden" value="<?= $data["fname"]?>" name="old">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-save">Update Journal Entry</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="py-4 text-center text-muted small">
            &copy; <?= date('Y') ?> The Modern Journal • Editor Mode
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>