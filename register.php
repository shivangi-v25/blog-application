
<?php 

include 'db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST") {
   $email=$_POST["email"];
   $name=$_POST["name"];
   $pass=password_hash($_POST["pass"],PASSWORD_DEFAULT);

   $sql=$conn->prepare("insert into user(email,username,password) values(?,?,?)");
   $sql->bind_param("sss",$email,$name,$pass);
   if ($sql->execute()) {
   header("location:login.php");
   }else{
    header("location:register.php");
   }

}




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
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>

<div
    class="container col-4 bg-secondary"
>
   <form  method="post" class="p-3  mt-3">

<h4 class="text-center text-light">Register</h4>
<div class="mb-3">
    <label for="" class="form-label">Email</label>
    <input
        type="text"
        class="form-control"
        name="email"
        id=""
        aria-describedby="helpId"
        placeholder=""
    />
</div>

<div class="mb-3">
    <label for="" class="form-label">UserName</label>
    <input
        type="text"
        class="form-control"
        name="name"
        id=""
        aria-describedby="helpId"
        placeholder=""
    />
</div>

<div class="mb-3">
    <label for="" class="form-label">Password</label>
    <input
        type="text"
        class="form-control"
        name="pass"
        id=""
        aria-describedby="helpId"
        placeholder=""
    />
</div>

<button type="submit" class="btn btn-success">submit</button>

   </form>
</div>



        </main>
        <footer>
            <!-- place footer here -->
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
