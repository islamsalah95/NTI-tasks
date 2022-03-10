<?php
  if (isset($_GET['operation'])){
$x  = $_GET['units'];

$op = $_GET['operation'];



if ($x>0 && $x<=50 ) {

    $result = ($x * 0.2) + ($x * 0.50) ;


    $message = ' level first';
    
}


elseif ($x>50 &&  $x<=150) {
    $result = ($x * 0.2) + ($x *  0.75) ;

    $message = ' level second';

}


elseif ($x>150 && $x <=250 ) {

    $result = ($x * 0.2) + ($x *  1.20 ) ;
    $message = ' level third';

}



else {
    $result = ($x * 0.2) + ($x *  1.50) ;
    $message = ' level four';

}



 echo  "<div class='alert alert-success'> 
  <ul>
<li>your bill = $result LE </li>
<li>units     = $x      KW </li>
<li>taxes     = 20%     </li>

<li>           $message </li>

 </ul>
  </div>" ;

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
  <h2>Electric</h2>
  <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">

    <div class="mb-3 mt-3">
      <label for="kilo">units :</label>
      <input type="number" class="form-control" id="units" placeholder="units" name="units">
    </div>


   
    <input type="submit" value="Go" name= "operation" class="btn btn-primary">



  </form>
</div>

</body>
</html>