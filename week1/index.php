<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["item"]) && isset($_POST["brand"])) {
            if (!empty($_POST["item"]) && !empty($_POST["brand"])) {
                echo "Item: " . $_POST["item"] . "<br>" ;
                echo "Brand: " . $_POST["brand"] ;
            }
        }
        
    }
    ?> 
</body>
</html>