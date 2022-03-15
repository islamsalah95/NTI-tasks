<?php 
session_start();
$yourphone = ' ';
$yourphone = $_SESSION['phones']  ;






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
 
  
  <table class="table table-striped">
    <thead>
      <tr>
      <th>questions</th>
        <th>grades</th>
      </tr>
    </thead>
    <tbody>   
    <!-- first form  -->
<tr>

          <td>are you satisfied with the level of cleaning?</td>

          <td><?php            echo $_SESSION['grade11'] ;   ?></td>







<!-- second form -->
<tr>
          <td>are you satisfied with the services prices ?</td>

          <td><?php   echo $_SESSION['grade22'] ;  ?></td>






</tr>


<!-- third form -->
<tr>
          <td>are you satisfied with nurses services ?</td>

          <td><?php   echo $_SESSION['grade33'] ;  ?></td>




 

</tr>


<!-- form four -->


<tr>
          <td>are you satisfied with the level of doctors in the hosptal ?</td>

          <td><?php   echo $_SESSION['grade44'] ;  ?></td>








</tr>



<!-- form five -->
<tr>
          <td>are you satisfied with the level of calmness ?</td>

          <td><?php   echo $_SESSION['grade55'] ;  ?></td>







</tr>
 </tbody>
  </table>



<div>
    <?php
             echo $_SESSION['result11'] ;

        ?>
</div>

</body>
</html>