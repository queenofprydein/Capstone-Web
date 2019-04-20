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
        <div class="ex2">
            <img src="images/SamaritanLogohires.jpg" class="img-fluid" alt="Samaritan Ministries Logo">
            <br>
            <br>
            <form method="post">
                <label>Username</label>
                <input type="text" name="new_username" class="form-control" />
                <br>
                
                <label>Password</label>
                <input type="password" name="new_password" class="form-control" />
                <br>
                
                <label>Repeat Password</label>
                <input type="password" name="new_repeat_password" class="form-control" />
                <br>
                <div  align="right">
                    <input type="submit" name="create_account" class="btn btn-info" value="Create Account" />
                </div>
            </form>
            <form action="index.php" >
                <div align="center">
                    <input type="submit" name="button_cancel" class="btn btn-warning" value="Cancel">
                </div>
            </form>

            <?php
            
            if(isset($_POST['create_account'])) {
           
                    

                if(empty($_POST["new_username"]) || empty($_POST["new_password"])){
                    $message = '<label>All fields are required</label>';
                } else {
                    if($_POST["new_password"] == $_POST["new_repeat_password"]){
                        include 'db_function.php';

                        $newUser_Login_Name = $_POST["new_username"];
                        $newUser_Password = $_POST["new_password"];
                        $newUser_Hash = password_hash($newUser_Password, PASSWORD_DEFAULT);

                        $sql =  "INSERT INTO Volunteer_Login (";
                        $sql .= "Login_Name, ";
                        $sql .= "Hash";
                        $sql .= ") VALUES (";
                        $sql .= "'". $newUser_Login_Name ."', ";
                        $sql .= "'". $newUser_Hash ."'";
                        $sql .= ")";

                        //echo "<br>Hash SQL<br>";
                        //echo $sql;


                        $newAccount = connection();


                        //SQL Query
                        $results = $newAccount->query($sql);
                        //End Query

                        //echo "<br>Hash SQL Results<br>";
                        //echo "<pre>";
                        //var_dump($results);
                        //echo "</pre>";

                        // IF SUCCESSFUL NEED TO LOGIN USER
                    } else {
                        echo 'Password Do Not Match';
                    } 
                }

            }
            ?>
        </div>
    </body>
</html>