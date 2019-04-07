<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Connect to a MySQL database using driver invocation */
//$dsn = 'sqlsrv:dbname=DB_A47087_smgroup;host=sql5008.site4now.net';
$dsn = 'sqlsrv:Database=DB_A47087_smgroup;server=sql5008.site4now.net';
$user = 'DB_A47087_smgroup_admin';
$password = 'ftccgroup1';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
