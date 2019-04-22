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

//echo '<br>';
//if (isset($_SESSION["username"])){
//    echo '<h2>Name before: '. $_SESSION["username"].'</h2>';    
//} else {
//    echo '<h2>username is not set</h2>';
//}
//echo '<br>';
//if (isset($_SESSION["username"])){
//    echo '<h2>Data before: '. $_SESSION["userdata"].'</h2>';    
//} else {
//    echo '<h2>userdata is not set</h2>';
//}
//echo '<br>';

include "db_function.php";
$message = "";

//$_SESSION["userdata"] = "FALSE";


$connect = connection();


//SQL Query
//$results = $newAccount->query($sql);
//End Query

//echo "<br>Hash SQL Results<br>";
//echo "<pre>";
//var_dump($results);
//echo "</pre>";

try {
    // Set DSN (Data Source Name)
    //    $dsn = 'sqlsrv:server='. $host .'; Database='. $dbname; 

    // Create PDO instance
    //    $connection = new PDO($dsn, $user, $password);
    
    //$connect = new PDO("sqlsrv:host=$host; dbname=$database", $username, $password); 
    
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    
    
    if(isset($_POST["login"])){
        if(empty($_POST["username"]) || empty($_POST["password"])){
            $message = '<label>All fields are required</label>';
        } else {
            $query = 'SELECT Hash FROM Volunteer_Login WHERE Login_Name = :username';
            $statement = $connect->prepare($query);
            //$statement->execute(['username' => $_POST["username"], 'password' => $_POST["password"]]);
//            $username = $_POST["username"];
//            $password = $_POST["password"];

            $statement->execute(['username' => $_POST["username"]]);
            //$hash_code = $statement->fetchAll();
            $result = $statement->fetch();
            
//            echo $result["Hash"];
            
//            echo "<br><pre>";
//            print_r($result);
//            echo "</pre></br>";
//            
//            $hash_code = $hash_stmt->Hash;
//            
//            echo "<br><pre>";
//            print_r($hash_code);
//            echo "</pre></br>";
            
            if (password_verify($_POST["password"], $result["Hash"])) {
                $_SESSION["username"] = $_POST["username"];
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
        <style>
            div.ex1 {
              width:500px;
              margin: auto;
              border: 3px solid #73AD21;
            }

            div.ex2 {
              max-width:500px;
              margin: auto;
            }
        </style>
    </head>
    <body>

        <!--<div class="container" style="width:500px;">-->
        <div class="ex2">
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
                       <?php
                       if (isset($message)) {
                           echo '<label class="text-danger" align="right">' . $message . '</label>';
                       }
                       ?>   
                       <input type="submit" name="login" class="btn btn-info" value="Login">
                </div>
            </form>
            <br><br>
            <div  align="center">
                <form action="create_account.php">
                    <input type="submit" name="create_button" class="btn btn-success" value="Create Account">
                </form>
            </div>
        </div>
    </body>
</html>