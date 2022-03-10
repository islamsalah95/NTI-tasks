<?php
//   if (isset($_GET['operation'])){
$x  = $_GET['num1'];
$y  = $_GET['num2'];
$z  = $_GET['num3'];
$op = $_GET['operation'];

$max = " " ;

$min = "";
if ($x >= $y and $x >= $z){
    $max = $x; 

          if ($y<=$z) {$min = $y ; }
    else {$min = $z ;}

}
    
    elseif ($y >= $x and $y >= $z){
    $max = $y;
    if ($x<$z) { $min = $x ; }
            else {$min = $z ;}

}
    
    elseif ($z >= $x and $z >= $y){
        $max = $y; 
            if ($x<$y) { $min = $x ;}
                else {$min = $y ;}
    
    }





 echo  "<div class='alert alert-success'> $max </div>" ;

 echo "  <div class='alert alert-danger'> $min </div> ";



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
  <h2>MAX&MIN</h2>
  <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">

    <div class="mb-3 mt-3">
      <label for="num1">num1 :</label>
      <input type="number" class="form-control" id="num1" placeholder="num1" name="num1">
    </div>

    <div class="mb-3">
      <label for="num2">num2 :</label>
      <input type="number" class="form-control" id="num2" placeholder="num2" name="num2">
    </div>

    <div class="mb-3">
      <label for="num3">num3 :</label>
      <input type="number" class="form-control" id="num3" placeholder="num3" name="num3">
    </div>

   
    <input type="submit" value="Go" name= "operation" class="btn btn-primary">



  </form>
</div>

</body>
</html>