<?php
      function DatabaseConnection()
      {
      $ip = "localhost";
      $user = "root";
      $pass = "";
      $db_name = "loginsystem";
      
      $connection = new mysqli($ip, $user, $pass, $db_name);
      
      if($connection->connect_error)
      {
          die("forbindelsen mislykkedes");
      }
          return $connection;
      }
      
      function DatabaseClose($conn)
      {
        mysqli_close($conn);
      }

      function RunQuery($query)
      {
        $connection = DatabaseConnection();
        $data = $connection->query($query);
        DatabaseClose($connection);
        return $data;
      }

      function UserExits($username)
      {
        $query = "SELECT username FROM users";
        $db_usernames = RunQuery($query);
        
        $found = false;
        while($row = $db_usernames->fetch_assoc())
        {
            if($row["username"] == $username)
            {
                $found = true;
            }
        }
          return $found;
      }
        
      function CreateUser($username, $password)
      {
            $query = "INSERT INTO users(username, password) VALUES ('$username','$password')";
            RunQuery($query);
      }
      function ValidateLogin($username, $password)
      {
          $query = "SELECT username, password FROM users";
          $data = RunQuery($query);
          
           echo $username."<br>";
              echo $password."<br>";
           
          echo "---DB----<br>";
          while($row = $data->fetch_assoc())
          {
             $db_username = $row["username"];
             $db_password = $row["password"];
              
             
              echo $db_username."<br>";
              echo $db_password."<br>";
              if($username == $db_username && password_verify($password, $db_password))
              {
                  return true;
              }
          }
          return false;
      }
    
   
 ?>
    
    