<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lam Pro Vip</h1>
    <?php
        setCookie("myname","norman", time() + (86000 * 2),"/");
    ?>
    <?php
    echo "My name is " . $_COOKIE["myname"];
    ?>
    <?php
    session_start();
    ?>
    <a href="demosession.php">Click this link</a>
    <?php
    $_SESSION["favcolor"] = "black";
    $_SESSION["favanimal"] = "cat";
    echo "Session variables are set.";
    ?>
</body>
</html>