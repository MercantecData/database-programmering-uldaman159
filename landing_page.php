<?php
session_start();

if(isset($_SESSION["id"]) && isset($_SESSION["loggedIn"]))
{
    $hej = 0;
}

else
{
    header("Location: index.php");
    echo "ok";
}


?>

<html>
    <head>
        <title>landing</title>
    </head>
    
    <body>
        <form action="index.php" method="get" >
            <input type="submit" value="LogOut" name="logOut">
        </form>
    </body>
</html>