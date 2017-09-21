<?php
if(!$_GET){
  header('Location: index.php');
}

  $week = $_GET['week'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bod4God Competition Results | Week <?php echo($week); ?></title>
  </head>
  <body>
    <div class="row">
      <div class="container">
        <h2>Results Week <?php echo($week); ?></h2>
      </div>
    </div>
  </body>
</html>
