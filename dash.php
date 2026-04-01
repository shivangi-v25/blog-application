
<!-- //my real blog -->
<?php 
include 'db.php';
if (!isset($_SESSION["id"])) {
   header("location:login.php");
}

$result=$conn->query("select blog.*,username from blog join user on blog.user_id=user.user_id ");
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            .card{
             height:450px;
             width: 400px;
             margin:5px;
            }
            .card-img-top{
                height:250px;
                width:100%;
            }
        </style>
    </head>

    <body>
        <header>
           <nav
            class="navbar navbar-expand-sm navbar-light bg-warning"
           >
            <div class="container">
                <a class="navbar-brand" href="dashboard.php">Blogs</a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="addblog.php" aria-current="page"
                                > Add Blog
                                <span class="visually-hidden">(current)</span></a
                            >
                        </li>
                       
                        
                    </ul>
                    <form class="d-flex my-2 my-lg-0" action="logout.php">
                     <a
                        name=""
                        id=""
                        class="btn btn-success"
                        href="pdf.php"
                        role="button"
                        >pdf generator</a
                     >
                       <a
                        name=""
                        id=""
                        class="btn btn-success mx-2"
                        href="excel.php"
                        role="button"
                        >excel generator</a
                     >
                     
                        <button
                            class="btn btn-outline-danger my-2 my-sm-0"
                            type="submit"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>
           </nav>
           
        </header>
        <main>

<div
    class="container"
>

   <div
    class="row justify-content-center align-items-center g-2"
   >
     <?php 
   while ($row=$result->fetch_assoc()) {
   ?>
    <div class="col-4">
        <div class="card">
            <img class="card-img-top" src="upload/<?=$row["fname"] ?>" alt="Title" />
            <div class="card-body">
                <small><?=$row["username"]?>  |  <?=$row["created_at"] ?></small>
                <h4 class="card-title"><?=$row["title"] ?></h4>
                <p class="card-text"><?=$row["content"] ?></p>
                <?php 
                if ($_SESSION["id"]==$row["user_id"]) {
                    ?>
                   <a
                    name="edit"
                    id=""
                    class="btn btn-warning btn-sm"
                    href="edit.php?id=<?=$row["bid"]?>"
                    role="button"
                    >Edit</a
                   >
                      <a
                    name="edit"
                    id=""
                    class="btn btn-danger btn-sm"
                    href="delete.php?id=<?=$row["bid"]?>"
                    role="button"
                    >Delete</a
                   >
                   
              <?php  }?>
            </div>
        </div>
        
    </div>
   <?php }?>
   </div>
   
</div>



        </main>
        <footer>
           <div
            class="container-fluid text-center bg-warning p-3 "
           >
            &copy  all the rights are reserved
           </div>
           
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
