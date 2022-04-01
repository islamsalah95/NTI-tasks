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

<?php 
session_start();
$totalss = ' ';
$discount = ' ';
$discounts = ' ';
$tootaldiscount = '';


?>

<!-- first part -->
<div class="container mt-3">
  <h2>market</h2>
  <form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
<!-- username -->
    <div class="mb-3 mt-3">
      <label for="username">username :</label>
      <input type="text" class="form-control" id="username"  name="username" value = "<?php if (isset($_GET['username'])) {
$_SESSION['$usernamess'] = $_GET['username'] ;
echo $_SESSION['$usernamess'] ;


} ?>">
    </div>
<!-- /////////////////////////////'value = selected' delievry-->
<div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">city</label>
  <select class="form-select" id="inputGroupSelect01" name="cityes" value="<?php if (isset($_GET['cityes'])) {
                                                                                                'value = selected ';
                                                                                            }
                                                                                            ?> ">
                    <option>select</option>
                    <option value="cairo">cairo</option>
                    <option value="giza">giza</option>
                    <option value="alex">alex</option>
                    <option value="other">other</option>
                </select>
            </div>
<!-- ///////////////////////////// loops-->
<!--  productsnum -->
    <div class="mb-3 mt-3">
      <label for="productsnum"> productsnum :</label>
      <input type="number" class="form-control" id="productsnum" placeholder="productsnum" name="productsnum" value = "<?php if (isset($_GET['productsnum'])) {
$_SESSION['productsnumss'] = $_GET['productsnum'] ;
echo $_SESSION['productsnumss'] ;
} ?>">
      
      
      
      
  
    </div>

    <!-- submit -->
    <input type="submit" value="calc" name= "operation1" class="btn btn-primary">
  </form>
</div>

<?Php
// if (isset($_GET['username'])) {
//   $_SESSION['$usernamess'] = $_GET['username'] ;

// }


?>

<!-- delivery -->
<?php
    if (isset($_GET['cityes'])) {

      $cityesss = ' ';
      switch ($_GET['cityes']) {
          case "cairo":
              $cityesss = 0;
              break;
          case "giza":
              $cityesss =  30;
              break;
          case "alex":
              $cityesss = 50;
              break;
          case "other":
              $cityesss = 100;
              break;
      }
      echo  $cityesss;

      echo $_SESSION['deliever'] = $cityesss ;

  }

?>


<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- second part -->


<div class="container mt-3">
<form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
  <table class="table">
    <thead>
      <tr>
      <th>products name </th>
        <th>price</th>
        <th>quantities</th>
      </tr>
    </thead>
    <tbody>

    <?php if (isset($_GET['productsnum'])) {

 for ($i=0; $i < $_SESSION['productsnumss']; $i++) { ?>
      <tr>

    <td><input type='text' class='form-control' id='productsname' placeholder='productsname' name='productsname' value ='<?php 
   
   if (isset($_GET['productsname'])) {
         echo $_GET['productsname'] ;     } ?>'>
         
        
        </td>

    <td><input type='number' class='form-control' id='products' placeholder='products' name='products[]' value = '<?php 
    if (isset($_GET['products'])) {
         echo $_GET['products'];     } ?>'></td>

    <td><input type='number' class='form-control' id='quantity' placeholder='quantity' name='quantity[]' value = '<?php 
    if (isset($_GET['quantity'])) {
         echo $_GET['quantity'] ;     } ?>'  ></td>

     <?php }}?>
    
    
    </tr>
    </tbody>
  </table>
      <!-- submit -->
      <input type="submit" value="calc" name= "operation2" class="btn btn-primary">
</form>
</div>

<!-- php second part price ,quantities -->
  <?php 
if ( $_GET ){
    if (!isset($_GET['products']) || !$_GET['quantity']) {}

    else {$total = [];
         foreach ($_GET['products'] as $key=>$price) {
        foreach ($_GET['quantity'] as $keys => $quantitys) {}
      if (is_numeric($price) && is_numeric($quantitys)) {  $total[] = $price * $quantitys;
      
        // $total[] = $total;
        // echo array_sum($total);
        // $totalss = array_sum($total);

      
      
      }

    } 
    $totalss =  array_sum($total);
    // echo $totalss ;

          }
  
      }

?>

</div>


<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- reciete -->
<?php
// discount


if ($totalss < 1000) {
  $discount = 0 ;}

  elseif ($totalss < 3000 && $totalss >= 1000) {
    $discount = 0.1 ;}

    elseif ($totalss < 4500 && $totalss >= 3000) {
      $discount = 0.15 ;}

      else {
        $discount = 0.2 ;
      }

?>

<div class="container mt-3">
<form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
  <table class="table">
    <thead>
      <tr>
      <th>reciete</th>
 
      </tr>
    </thead>
    <tbody>
     
    <tr>
<td><p>username</p></td>
<td> <?php 
echo $_SESSION['$usernamess'] ;
?> </td>
</tr>


<tr>
<td><p>total</p></td>
<td> <?php echo $totalss ; 
?> </td>
</tr>


<tr>
<td><p>discounts</p></td>
<td><?php 
// if (!empty($discount) && !empty($totalss)   ) {
  $discounts =  $totalss * $discount ;
  echo $discounts . ' ' . "EGP" ;
// }


 ?>

</td>
</tr>


<tr>
<td><p>tootal after discount </p></td>
<td><?php
// if (  !empty($totalss) && !empty($discounts)   ) {
  echo( $tootaldiscount = $totalss -  $discounts  ) . ' ' . "EGP";
// }





 ?></td>
</tr>

<tr>
<td><p>delievry</p></td>
<td><?php echo $_SESSION['deliever'] . ' '. "EGP" ;?></td>
</tr>


<tr>
<td><p>net total</p></td>
<td><?php  

// if (  isset($totalss)   ) {
  echo $tootaldiscount + $_SESSION['deliever'] . ' ' . "EGP";
// }

 ?></td>
</tr>



    </tbody>
  </table>







</body>
</html>













