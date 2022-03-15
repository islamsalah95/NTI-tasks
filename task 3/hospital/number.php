<?php 
session_start();
if ($_GET) {
if ( !empty($_GET['pho'])  ) {
  $phone = ' ';

    $_SESSION['phones']= $_GET['pho'] ;

header('location:review.php');


    }

  }




?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<form method="get" action=" ">
  <div class="mb-3" >
    <label for="exampleInputEmail1" class="form-label">your number</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='pho'>
    <div id="emailHelp" class="form-text">insert your phone number</div>

 
  <button type="submit" class="btn btn-primary">send</button>
</form>
 





</body>
</html>



