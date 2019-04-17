<?php

/* 
 * Copyright (C) 2019 Marshall Casey <caseym1325@students.forsythtech.edu>
 * Created for the FTCC course CSC-289-900-2019SP.
 * This program can be freely copied and/or distributed.
 */

session_start();

if(isset($_SESSION["username"])){
    echo'<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
    echo'<br><br><a href="logout.php">Logout</a>';
} else {
    header("location:login.php");
}
?>
