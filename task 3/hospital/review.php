<?php 
session_start();
$yourphone = ' ';
$yourphone = $_SESSION['phones']  ;


if ( !empty($_GET['first']) and !empty($_GET['second']) and !empty($_GET['third']) and !empty($_GET['fourd']) and !empty($_GET['five'])  ) {
 


    $a = $_GET['first'] ;
    $b = $_GET['second'];
    $c=  $_GET['third'] ;
    $d = $_GET['fourd'] ;
    $e = $_GET['five'];

 
     $result = ($a + $b + $c + $d + $e)-1 ;
     header('location:result.php');


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
  <h2>HOSPTAL SURVIEY</h2>
 
  <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
  
  <table class="table table-striped">
    <thead>
      <tr>
      <th>questions</th>
        <th>bad</th>
        <th>good</th>
        <th>very good</th>
        <th>excellent</th>

      </tr>
    </thead>
    <tbody>   
    <!-- first form  -->
<tr>

          <td>are you satisfied with the level of cleaning?</td>

        <td><input class="form-check-input" type="radio" name="first" id="bad" value="1">
  <label class="form-check-label" for="inlineRadio1"></label></td>


        <td>  <input class="form-check-input" type="radio" name="first" id="inlineRadio1" value="3">
  <label class="form-check-label" for="inlineRadio1"></label></td>



  <td>  <input class="form-check-input" type="radio" name="first" id="inlineRadio1" value="5">
  <label class="form-check-label" for="inlineRadio1"></label></td>
     
  
  <td>  <input class="form-check-input" type="radio" name="first" id="inlineRadio1" value="10">
  <label class="form-check-label" for="inlineRadio1"></label></td>
</tr>

<?php
if (isset($_GET['first'])) {
  
  $grade1 =  " ";
    switch ($_GET['first']) {
      case "1":
        $grade1 = "bad";
        break;
      case "3":
        $grade1 =  "good";
        break;
      case "5":
        $grade1 =  "very good";
        break;
        case "10":
          $grade1 =  "excellent";
          break;

    }

          $_SESSION['grade11'] = $grade1 ;
          echo $_SESSION['grade11'] ;
        }


?>

<!-- second form -->
<tr>
          <td>are you satisfied with the services prices ?</td>

          <td><input class="form-check-input" type="radio" name="second" id="inlineRadio1" value="1">
  <label class="form-check-label" for="inlineRadio1"></label></td>



        <td>  <input class="form-check-input" type="radio" name="second" id="inlineRadio1" value="3">
  <label class="form-check-label" for="inlineRadio1"></label></td>



  <td>  <input class="form-check-input" type="radio" name="second" id="inlineRadio1" value="5">
  <label class="form-check-label" for="inlineRadio1"></label></td>
     
  
  <td>  <input class="form-check-input" type="radio" name="second" id="inlineRadio1" value="10">
  <label class="form-check-label" for="inlineRadio1"></label></td>

</tr>
<?php
if (isset($_GET['second'])) {

   $grade2 = ' ';
    switch ($_GET['second']) {
      case "1":
        $grade2 = "bad";
        break;
      case "3":
        $grade2 =  "good";
        break;
      case "5":
        $grade2 =  "very good";
        break;
        case "10":
          $grade2 =  "excellent";
          break;

    }

    $_SESSION['grade22'] = $grade2 ;
    echo $_SESSION['grade22'] ;
  }
?>

<!-- third form -->
<tr>
          <td>are you satisfied with nurses services ?</td>

          <td><input class="form-check-input" type="radio" name="third" id="inlineRadio1" value="1">
  <label class="form-check-label" for="inlineRadio1"></label></td>



        <td>  <input class="form-check-input" type="radio" name="third" id="inlineRadio1" value="3">
  <label class="form-check-label" for="inlineRadio1"></label></td>



  <td>  <input class="form-check-input" type="radio" name="third" id="inlineRadio1" value="5">
  <label class="form-check-label" for="inlineRadio1"></label></td>
     
  
  <td>  <input class="form-check-input" type="radio" name="third" id="inlineRadio1" value="10">
  <label class="form-check-label" for="inlineRadio1"></label></td>

</tr>

<?php
if (isset($_GET['third'])) {

  $grade3 =  " ";
   switch ($_GET['third']) {
    case "1":
      $grade3 = "bad";
      break;
    case "3":
      $grade3 =  "good";
      break;
    case "5":
      $grade3 =  "very good";
      break;
      case "10":
        $grade3 =  "excellent";
        break;
     
  }
  $_SESSION['grade33'] = $grade3 ;
  echo $_SESSION['grade33'] ;
}
?>

<!-- form four -->


<tr>
          <td>are you satisfied with the level of doctors in the hosptal ?</td>

          <td><input class="form-check-input" type="radio" name="fourd" id="inlineRadio1" value="1">
  <label class="form-check-label" for="inlineRadio1"></label></td>



        <td>  <input class="form-check-input" type="radio" name="fourd" id="inlineRadio1" value="3">
  <label class="form-check-label" for="inlineRadio1"></label></td>



  <td>  <input class="form-check-input" type="radio" name="fourd" id="inlineRadio1" value="5">
  <label class="form-check-label" for="inlineRadio1"></label></td>
     
  
  <td>  <input class="form-check-input" type="radio" name="fourd" id="inlineRadio1" value="10">
  <label class="form-check-label" for="inlineRadio1"></label></td>



</tr>

<?php
if (isset($_GET['fourd'])) {

  $grade4 =  " ";

   switch ($_GET['fourd']) {
    case "1":
      $grade4 = "bad";
      break;
    case "3":
      $grade4 =  "good";
      break;
    case "5":
      $grade4 =  "very good";
      break;
      case "10":
        $grade4 =  "excellent";
        break;
     
  }

  $_SESSION['grade44'] = $grade4 ;
  echo $_SESSION['grade44'] ;
}
?>

<!-- form five -->
<tr>
          <td>are you satisfied with the level of calmness ?</td>

          <td><input class="form-check-input" type="radio" name="five" id="inlineRadio1" value="1">
  <label class="form-check-label" for="inlineRadio1"></label></td>



        <td>  <input class="form-check-input" type="radio" name="five" id="inlineRadio1" value="3">
  <label class="form-check-label" for="inlineRadio1"></label></td>



  <td>  <input class="form-check-input" type="radio" name="five" id="inlineRadio1" value="5">
  <label class="form-check-label" for="inlineRadio1"></label></td>
     
  
  <td>  <input class="form-check-input" type="radio" name="five" id="inlineRadio1" value="10">
  <label class="form-check-label" for="inlineRadio1"></label></td>

  <?php
  if (isset($_GET['five'])) {

    $grade5 =  " ";

   switch ($_GET['five']) {
    case "1":
      $grade5 = "bad";
      break;
    case "3":
      $grade5 =  "good";
      break;
    case "5":
      $grade5 =  "very good";
      break;
      case "10":
        $grade5 =  "excellent";
        break;

  }
  $_SESSION['grade55'] = $grade5 ;
  echo $_SESSION['grade55'] ;

}

?>
</tr>
<!-- submit -->
 </tbody>
  </table>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">send</button>
  </div>
</form>
<?php
  if (isset($result)) {

if ($result >= 25) {$result1 =  "<div class='alert alert-success'> thanks </div>" ;}
        
             else {$result1 = "  <div class='alert alert-danger'> we will call you on your number $yourphone</div> " ; }
             $result1 = 

             $_SESSION['result11'] =  $result1 ;
             echo $_SESSION['result11'] ;
  }
      ?>
</div>

<div>

</div>

</body>
</html>