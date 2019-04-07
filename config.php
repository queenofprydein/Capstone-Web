<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

   define('DB_SERVER', 'sqlsrv:Database=DB_A47087_smgroup;server=sql5008.site4now.net');
   define('DB_USERNAME', 'DB_A47087_smgroup_admin');
   define('DB_PASSWORD', 'ftccgroup1');
   define('DB_DATABASE', 'database');
   $db = PDO($dsn, $user, $password);
?>