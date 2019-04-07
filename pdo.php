<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = 'SQL5008.site4now.net';
$user = 'DB_A47087_smgroup_admin';
$password = 'ftccgroup1';
$dbname = 'DB_A47087_smgroup';

// Set DSN
$dsn = 'sqlsrv:host='. $host .';dbname='. $dbname;
$dsn = 'sqlsrv:server='. $host .'; Database='. $dbname; 

// Create PDO instance
$connection = new PDO($dsn, $user, $password);

# PRDO QUERY

$stmt = $pdo->query();