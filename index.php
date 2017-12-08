<?php
session_start();
include "connection.php"; 
   @ $input_username = $_POST['input_user'];
   @ $input_password = $_POST['input_password'];
   @ $login = $_POST['login'];*//
   @ $create = $_POST['create'];
    

    if (isset($_GET['logOut']))
    {
        session_unset();
        session_destroy();
    }

    if(isset($login))
    {
        $id = ValidateLogin($input_username, $input_password);
        if ($id != NULL)
        {
            
            $_SESSION['id'] = $id;
            $_SESSION['loggedIn'] = true;
            header("Location: landing_page.php");
        }
        
        else
        {
            echo "wrong username or password";
        }
    }
    
    else if(isset($create))
    {
        $crypted_password = password_hash($input_password, PASSWORD_DEFAULT);

        
        if(!UserExits($input_username))
        {
            CreateUser($input_username, $crypted_password);
            echo "creted user".$input_username;
        }
        else
        {
            echo $input_username."is reserved, please select another one";
        }
    }
?>








<html>
    <head>
    <title>forside</title>
    </head>
    <body>
        <h1>log ind</h1>
        <form method="post" action="index.php">
        username: <input type="text" name="input_user"><br>
        password: <input type="password" name="input_password"><br>
        <input type="submit" value="Login" name="login">
        <input type="submit" value="opret bruger" name="create">
        </form>
    </body>
</html>