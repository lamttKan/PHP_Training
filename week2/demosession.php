<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    ?>
    <h2>LamLam</h2>
<?php
   echo "My favor is color is " . $_SESSION["favcolor"] ;
   echo "My favor is color is " . $_SESSION["favanimal"] ;
?>
</body>
</html>