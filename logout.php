<?php

/* 
 * Copyright (C) 2019 Marshall Casey <caseym1325@students.forsythtech.edu>
 * Created for the FTCC course CSC-289-900-2019SP.
 * This program can be freely copied and/or distributed.
 */

session_start();
session_destroy();

    echo '<h3>Login Success, Welcome - '.$_SESSION["username"].'</h3>';
    echo '<h3>Data flag is set to: ' . $_SESSION["userdata"].'</h3>';
header("location:landing_page.php");

?>