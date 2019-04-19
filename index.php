<!DOCTYPE html>
<!--
Copyright (C) 2019
   Alondra Dorantes <dorantesa2016@forsythtech.edu>
   Dana Caldwell <caldwelld2608@forsythtech.edu>
   Dung Duong <duongd1067@forsythtech.edu>
   Marshall Casey <caseym1325@students.forsythtech.edu>
   William West <westw2305@forsythtech.edu>
Created for the FTCC course CSC-289-900-2019SP.
This program can be freely copied and/or distributed.
-->

<?php
session_start();
//include "db_connect.php";
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
            $query = 'SELECT * FROM users WHERE username = :username AND password = :password';
            $statement = $connect->prepare($query);

            echo $_POST["username"];
            echo $_POST["password"];
            //$statement->execute(['username' => $_POST["username"], 'password' => $_POST["password"]]);
            $username = $_POST["username"];
            $password = $_POST["password"];

            $statement->execute(['username' => $username, 'password' => $password]);

            echo "<pre>";
            //var_dump($statement);


            $items = $statement->fetchAll();
            //var_dump($items);

            echo "</pre>";
            $count = $statement->rowCount();
            echo "Rows:" . $count;
            if($count > 0){
                echo "got here";
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["userdata"] = TRUE;
                header("location:landing_page.php");
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
        <meta charset="UTF-8">
        <title>SM</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>

        <!--<div class="container" style="width:500px;">-->
        <div class="mx-auto" style="width: 400px;">
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>
            <form method="post">
                <label>Username</label>
                <input type="text" name="username" class="form-control" />
                <br>
                
                <label>Password</label>
                <input type="password" name="password" class="form-control" />
                <br>
                <div  align="right">
                    <input type="submit" name="login" class="btn btn-info" value="Login" />
                </div>
                
            </form>
            <br><br>
            <div  align="center">
                <form action="create_account.html">
                    <input type="submit" name="create_button" class="btn btn-success" value="Create Account">
                </form>
                <br>
                <form action="create_account.php">
                    <input type="submit" name="forgot_button" class="btn btn-warning" value="PHP Create Account">
                </form>
            </div>
            <?php
            if (isset($message)) {
                echo '<label class="text-danger">DWR: ' . $message . '</label>';
            }
            ?>
        </div>
    </body>
</html>