<?php

/* 
 * Copyright (C) 2019 Marshall Casey <caseym1325@students.forsythtech.edu>
 * Created for the FTCC course CSC-289-900-2019SP.
 * This program can be freely copied and/or distributed.
 */

session_start();
$host = "SQL5008.site4now.net";
$db_username = "DB_A47087_smgroup_admin";
$db_password = "ftccgroup1";
$database = "DB_A47087_smgroup";
$message = "";

try {
    // Set DSN (Data Source Name)
//    $dsn = 'sqlsrv:server='. $host .'; Database='. $dbname; 

    // Create PDO instance
//    $connection = new PDO($dsn, $user, $password);
    
    //$connect = new PDO("sqlsrv:host=$host; dbname=$database", $username, $password); 
    $connect = new PDO("sqlsrv:server=$host; database=$database", $db_username, $db_password); 
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_POST["login"])){
        if(empty($_POST["username"]) || empty($_POST["password"])){
            $message = '<label>All fields are required</label>';
        } else {
            $query = "SELECT * FROM users WHERE username = :username AND password = :password";
            $statement = $connect->prepare($query);
            
            echo $_POST["username"];
            echo $_POST["password"];
//            $statement->execute(['username' => $username, 'password' => $password]);
            $statement->execute(
                array(
                    'username' => $_POST["username"],
                    'password' => $_POST["password"]
                )
            );
            echo "<pre>";
            var_dump($statement);
            echo "</pre>";
            $count = $statement->rowCount();
            echo "Rows:" . $count;
            if($count > 0){
                echo "got here";
                $_SESSION["username"] = $_POST["username"];
                header("location:login_success.php");
            } else {
                $message = '<label>Wrong data</label>';
            }
        }
    }
    
} catch (PDOException $error) {
    $message = $error->getMessage();
}


?>

<html>
    <head>
        <title>Login Test</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    </head>
    <body>
        <br>
        <?php
            if(isset($message)){
                echo '<label class="text-danger">DWR: '.$message.'</label>'; 
            }
        ?>
        <div class="container" style="width:500px;">
            <h3>PHP Login Script using PDO</h3>
            <form method="post">
                <label>Username</label>
                <input type="text" name="username" class="form-control" />
                <br>
                
                <label>Password</label>
                <input type="password" name="password" class="form-control" />
                <br>
                
                <input type="submit" name="login" class="btn btn-info" value="Login" />
                
            </form>
           
        </div>
    </body>
</html>