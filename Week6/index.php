<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemweb Week 6</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
for ($x = 5; $x >= 1;--$x){
  for ($y = $x-1; $y >= 0; --$y){
    if($y % 2 == 1){
    echo '<div class="yellow"></div>';
    }
    else
    echo '<div class="black"></div>';
  }
  echo '<br>';
}
?>
</body>
</html>