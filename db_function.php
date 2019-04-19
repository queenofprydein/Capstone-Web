<?php

/* 
 * Copyright (C) 2019 Marshall Casey <caseym1325@students.forsythtech.edu>
 * Created for the FTCC course CSC-289-900-2019SP.
 * This program can be freely copied and/or distributed.
 */

//session_start();

function connection(){
 
   $db_host = 'SQL5008.site4now.net';
   $db_name = 'DB_A47087_smgroup';
   $db_user = 'DB_A47087_smgroup_admin';
   $db_password = 'ftccgroup1';
 
   try{
      $db = new PDO("sqlsrv:server=$db_host; Database=$db_name", $db_user, $db_password);
      return $db;
   } catch (PDOException $err) {
      echo "Error: ". $err->getMessage();
      die();
   }
}
 
?>