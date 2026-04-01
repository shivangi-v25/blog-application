<?php 
session_start();
include 'db.php';
if (!isset($_SESSION["id"])) {
   header("location:login.php");
}

$result=$conn->query("select blog.*,username from blog join user on blog.user_id=user.user_id ORDER BY created_at DESC");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>The Modern Journal</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

        <style>
            :root {
                --primary-color: #2c3e50;
                --accent-color: #e67e22;
                --bg-soft: #f8f9fa;
            }

            body {
                background-color: var(--bg-soft);
                font-family: 'Inter', sans-serif;
                color: #333;
            }

            h1, h2, h4, .navbar-brand {
                font-family: 'Playfair Display', serif;
            }

            /* --- Hero Section --- */
            .blog-header {
                padding: 60px 0;
                background: white;
                border-bottom: 1px solid #eee;
                margin-bottom: 50px;
                text-align: center;
            }

            /* --- Card Styling --- */
            .blog-card {
                border: none;
                border-radius: 15px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                background: #fff;
                height: 100%;
                box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            }

            .blog-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }

            .img-container {
                overflow: hidden;
                height: 220px;
            }

            .card-img-top {
                height: 100%;
                width: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            .blog-card:hover .card-img-top {
                transform: scale(1.1);
            }

            .card-body {
                padding: 1.5rem;
            }

            .category-tag {
                font-size: 0.7rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: var(--accent-color);
                font-weight: 700;
                margin-bottom: 10px;
                display: block;
            }

            .card-title {
                font-size: 1.25rem;
                margin-bottom: 15px;
                line-height: 1.4;
            }

            .card-text {
                font-size: 0.9rem;
                color: #666;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* --- Footer & Nav --- */
            .navbar {
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                padding: 1rem 0;
            }

            .btn-custom {
                border-radius: 50px;
                padding: 8px 20px;
                font-weight: 600;
                transition: 0.3s;
            }

            .footer-modern {
                background: var(--primary-color);
                color: white;
                padding: 40px 0;
                margin-top: 80px;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-white bg-white sticky-top">
            <div class="container">
                <a class="navbar-brand fs-3" href="dashboard.php">The Journal.</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="addblog.php">Write a Story</a></li>
                    </ul>
                    <div class="d-flex align-items-center gap-2">
                        <a href="pdf.php" class="btn btn-outline-dark btn-sm btn-custom">PDF Export</a>
                        <a href="excel.php" class="btn btn-outline-dark btn-sm btn-custom">Excel Export</a>
                        <a href="logout.php" class="btn btn-danger btn-sm btn-custom ms-2">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <header class="blog-header">
            <div class="container">
                <h1 class="display-4 fw-bold">Explore Perspectives</h1>
                <p class="lead text-muted">A collection of thoughts, stories, and ideas.</p>
            </div>
        </header>

        <main class="container">
            <div class="row g-4">
                <?php while ($row=$result->fetch_assoc()): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="card blog-card">
                        <div class="img-container">
                            <img class="card-img-top" src="upload/<?= $row["fname"] ?>" alt="<?= $row["title"] ?>" />
                        </div>
                        <div class="card-body">
                            <span class="category-tag">Personal Journal</span>
                            <small class="text-muted d-block mb-2">
                                By <strong><?= $row["username"] ?></strong> • <?= date('M d, Y', strtotime($row["created_at"])) ?>
                            </small>
                            <h4 class="card-title"><?= $row["title"] ?></h4>
                            <p class="card-text"><?= $row["content"] ?></p>
                            
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <a href=# class="text-dark fw-bold text-decoration-none small">Read More →</a>
                                
                                <?php if ($_SESSION["id"] == $row["user_id"]): ?>
                                <div class="btn-group">
                                    <a href="edit.php?id=<?= $row["bid"] ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                    <a href="delete.php?id=<?= $row["bid"] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Archive this post?')">Delete</a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                </div>
                <?php endwhile; ?>
            </div>
        </main>

        <footer class="footer-modern">
            <div class="container text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> The Modern Journal. Crafted for storytellers.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>