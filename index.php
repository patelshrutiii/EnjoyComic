
<?php
require_once "db.php";
require_once "queries.php";

?>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
      <title>User Registration with Email Verification in PHP</title>
       
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
      <div class="container mt-5">
          <div class="card" style="background-color: #e6e6e6;">
            <div class="card-header text-center">
               Registration Form
            </div>
            <div class="card-body">
              <form  method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <input type="submit" name="DataBtn" class="btn btn-primary">
              </form>
            </div>
          </div>
      </div>

   </body>
</html>


