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
  <h2>bank</h2>
  <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
<!-- username -->
    <div class="mb-3 mt-3">
      <label for="username">username :</label>
      <input type="text" class="form-control" id="username" placeholder="username" name="username" value = "<?php if (isset($_GET['username'])) {
echo $_GET['username'] ;      } ?> ">
      <?php 
      if (isset($errors['username-requier'])) {
          echo $errors['username-requier'] ;
      }
      ?>
    </div>
<!-- loan amount  -->
    <div class="mb-3 mt-3">
      <label for="amount">loan amount :</label>
      <input type="number" class="form-control" id="amount" placeholder="loan amount" name="amount" value = "<?php if (isset($_GET['amount'])) {
echo $_GET['amount'] ; } ?> ">
      <?php 
      if (isset($errors['amount-requier'])) {
          echo $errors['amount-requier'] ;
      }
      ?>
    </div>
<!-- loan years -->
    <div class="mb-3 mt-3">
      <label for="years"> loan years :</label>
      <input type="number" class="form-control" id="years" placeholder="years" name="years" value = "<?php if (isset($_GET['years'])) {
echo $_GET['years'] ;      } ?> ">
      <?php 
      if (isset($errors['years-requier'])) {
          echo $errors['years-requier'] ;
      }
      ?>
    </div>

    <!-- submit -->
    <input type="submit" value="calc" name= "operation" class="btn btn-primary">

  </form>
</div>

<?php
  if ( $_GET ){
    $errors = []; 

    if (empty($_GET['username']) ) {
        $errors['username-requier'] = ' <p class="text-danger"> username-requier </p>  ';
      }

      if (empty($_GET['amount']) ) {
        $errors['amount-requier'] =  '<p class="text-danger"> amount is requier </p>';
              }

              if (empty($_GET['years']) ) {
                $errors['years-requier'] = '<p class="text-danger">years is requier </p>';

            }

     
else {

$user  =  $_GET['username'];

$year  =  $_GET['years'];


$amoun  = $_GET['amount'];



if ($year <=3 ) {
    $interestrate = ($amoun * 0.1 * $year) ;


    $loanafter = ($interestrate + $amoun  );
    
    
    $montly = $loanafter /   ($year * 12);

}

else {
    $interestrate = ($amoun * 0.15 * $year) ;


    $loanafter = ($interestrate + $amoun  );
    
    
    $montly = $loanafter /   ($year * 12);

}


echo "<table class='table table-striped'>
    <thead>
      <tr>
      <th>user name</th>
        <th>interest rate</th>
        <th>loan after interest</th>
        <th>monthly</th>

      </tr>
    </thead>
    <tbody>   

<tr>

          <td>  $user          </td>
          <td>  $interestrate  </td>
          <td>  $loanafter     </td>
          <td>  $montly        </td>


</tr>
</tbody>
  </table>";







}
  

}




?>

</body>
</html>







}
  

}




?>

</body>
</html>