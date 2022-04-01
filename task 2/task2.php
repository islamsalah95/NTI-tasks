<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?php 
$users = [
  [
      'id' => 1,
      'name' => 'ahmed',
      "gender" => 'male',
      'hobbies' => [
          'football', 'swimming', 'running'
      ],
      'activities' => [
          "school" => 'drawing',
          'home' => 'painting'
      ],
  ],
  
  


  [
    'id' => 2,
    'name' => 'fatma',
    "gender" => 'female',
    'hobbies' => [
        'football', 'swimming', 'running'
    ],
    'activities' => [
        "school" => 'drawing',
        'home' => 'painting'
    ],
],




[
  'id' => 3,
  'name' => 'salah',
  "gender" => 'male',
  'hobbies' => [
      'football', 'swimming', 'running'
  ],
  'activities' => [
      "school" => 'drawing',
      'home' => 'painting'
  ],
],

  
  


];


// print_r($users );

?>

</head>
<body>

<div class="container mt-3">
           
  <table class="table">
    <thead>
      <tr>

      <th>ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Hobbies</th>
        <th>Activities</th>
      </tr>
    </thead>
    <tbody>
     
    
       
    <?php foreach ($users as $index => $user) { ?>
      <tr>
    <td> <?php echo $user['id']  ?></td>
    <td> <?php echo $user['name']  ?></td>
    <td> <?php echo $user['gender']  ?></td>

  <td> <?php         foreach ($user['hobbies'] as $index => $hobbiess) {
  echo  $hobbiess . ' , '  ; } echo trim($hobbiess,' , ' );
  ?></td>

   
   
   <td> <?php     foreach ($user['activities'] as $index => $activitiey) {
    echo  $activitiey . ' , '  ; }echo trim($activitiey,' , ' ); ?></td>

     <?php }?>
    
    
    </tr>
    </tbody>
  </table>
</div>














</body>
</html