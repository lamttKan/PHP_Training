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
        if (isset($_POST["item"])) {
            if (!empty($_POST["item"])) {
                echo "Item: " . "". $_POST["item"] ."";
            }else{
                echo "<script>alert('Vui lòng không để trống');</script>";
            }
        }
    }
    ?>
    <form action="index.php" method="POST">
        <input type="hidden" name="item" value="<?php echo isset($_POST["item"]) ? $_POST["item"] : ''; ?>">
        Enter brand to buy: <input type="text" name="brand"></input>
        <button>Submit</button>
    </form> 
</body>
</html>