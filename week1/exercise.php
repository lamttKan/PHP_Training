<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <echo>
        <h1>Hello World</h1>

    </echo>
    <form action="" method="POST">
        <h1>Enter a number</h1> <br>
        Number: <input type="number" name="num"></input>
        <button>Generate List</button>
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["num"])) {
            if (!empty($_POST["num"])) {
                for($i= 1;$i<= $_POST["num"];$i++) {
                    echo "<li>$i</li> " ;
                }
            }else{
                echo "<script>alert('Vui lòng không để trống');</script>";
            }
        }
    }
    ?>
<h1>Bang cuu chuong</h1>
<table border="1px">
    <tr>
        <th></th>
        <?php
        for ($i = 1; $i <= 9; $i++) {
                    echo "<th>$i</th>";
                }
        ?>
    </tr>
    <?php
        for ($i = 1; $i <= 9; $i++) {
            echo "<tr>";
            echo "<th>$i</th>";
            for ($j = 1; $j <= 9; $j++) {
                echo "<td>" . ($i * $j) . "</td>";
            }
            echo "</tr>";
                }
        ?>
</table>
<br>
<form action="" method="POST">
        Name: <input type="text" name="name"></input>
        Age: <input type="number" name="age"></input>
        <button>Submit</button>
    </form>  
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["name"]) && isset($_POST["age"])) {
            if (!empty($_POST["name"]) && !empty($_POST["age"])) {
                echo "<h2>My name is " . $_POST["name"] . " and I am " . $_POST["age"] . " years old</h2>";
            }else{
                echo "<script>alert('Vui lòng không để trống');</script>";
            }
        }
        
    }
    ?>  
</body>
</html>