<?php
  if (isset($_GET['operation'])){
$x  = $_GET['num'];

$op = $_GET['operation'];


if ($x %2 == 0){

    echo  "<div class='alert alert-success'> Even </div>" ;
    
    }

    else {
        echo "  <div class='alert alert-danger'> Odd </div> ";
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

<div class="container mt-3">
  <h2>Odd&Even</h2>
  <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">

    <div class="mb-3 mt-3">
      <label for="num">num :</label>
      <input type="number" class="form-control" id="num" placeholder="num" name="num">
    </div>

  
    <input type="submit" value="Go" name= "operation" class="btn btn-primary">



  </form>
</div>

</body>
</html>