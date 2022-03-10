<?php
  if (isset($_GET['operation'])){
$a  = $_GET['subject1'];
$b  = $_GET['subject2'];
$c  = $_GET['subject3'];
$d  = $_GET['subject4'];
$e  = $_GET['subject5'];

$op = $_GET['operation'];


if ( $a<0 || $a>50 || $b <0  || $b>50 || $c<0 || $c>50 || $d<0 || $d>50 || $e<0 || $e>50 ) {

    echo "  <div class='alert alert-danger'> insert valid number for subject  </div> ";

    
}

else {

$percen = (($a+$b+$c+$d+$e)/250)*100 ;


if ($percen>=90 &&  $percen <= 100) {

    echo  "<div class='alert alert-success'> Grade A </div>" ;


}

elseif ($percen>=80 && $percen<90 ) {
    echo  "<div class='alert alert-success'> Grade B </div>" ;
}


elseif ($percen>=70 && $percen<80 ) {
    echo  "<div class='alert alert-success'> Grade C </div>" ;
}

elseif ($percen>=60 && $percen<70 ) {
    echo  "<div class='alert alert-success'> Grade D </div>" ;
}

elseif ($percen>=40 && $percen<60) {
    echo "  <div class='alert alert-danger'> Grade E </div> ";
}

else {
    echo "  <div class='alert alert-danger'> Grade F  </div> ";

}


    
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
  <h2>MAX&MIN</h2>
  <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">

    <div class="mb-3 mt-3">
      <label for="subject1">subject1 :</label>
      <input type="number" class="form-control" id="subject1" placeholder="subject1" name="subject1">
    </div>

    <div class="mb-3 mt-3">
      <label for="subject2">subject2 :</label>
      <input type="number" class="form-control" id="subject2" placeholder="subject2" name="subject2">
    </div>

    <div class="mb-3 mt-3">
      <label for="subject3">subject3 :</label>
      <input type="number" class="form-control" id="subject3" placeholder="subject3" name="subject3">
    </div>

    <div class="mb-3 mt-3">
      <label for="subject4">subject4 :</label>
      <input type="number" class="form-control" id="subject4" placeholder="subject4" name="subject4">
    </div>

    <div class="mb-3 mt-3">
      <label for="subject5">subject5 :</label>
      <input type="number" class="form-control" id="subject5" placeholder="subject5" name="subject5">
    </div>

   
    <input type="submit" value="Your grade" name= "operation" class="btn btn-primary">



  </form>
</div>

</body>
</html>