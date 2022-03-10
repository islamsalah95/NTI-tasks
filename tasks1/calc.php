<?php
  if (isset($_GET['operation'])){
$x  = $_GET['first'];
$y  = $_GET['second'];
$op = $_GET['operation'];


$results = " " ;

switch ($op) {
    case     'add': $results = $x + $y ;
        break;
    
        case 'sub': $results = $x - $y ;
        break;

        case 'pro': $results = $x * $y ;
        break;

        case 'div': $results = $x / $y ;
        break;
 
}

  }



 echo  "<div class='alert alert-success'> $results </div>" ;




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

<div class="container mt-3">
  <h2>calculator</h2>
  <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">

    <div class="mb-3 mt-3">
      <label for="first">first :</label>
      <input type="number" class="form-control" id="first" placeholder="first" name="first">
    </div>
    <div class="mb-3">
      <label for="second">second :</label>
      <input type="number" class="form-control" id="second" placeholder="second" name="second">
    </div>


   
    <input type="submit" value="add" name= "operation" class="btn btn-primary">
    <input type="submit" value="sub" name= "operation" class="btn btn-primary">
    <input type="submit" value="pro" name= "operation" class="btn btn-primary">
    <input type="submit" value="div" name= "operation" class="btn btn-primary">


  </form>
</div>

</body>
</html>