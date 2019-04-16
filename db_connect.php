<?php

/* 
 * Copyright (C) 2019 Marshall Casey <caseym1325@students.forsythtech.edu>
 * Created for the FTCC course CSC-289-900-2019SP.
 * This program can be freely copied and/or distributed.
 */

$host = 'SQL5008.site4now.net';
$user = 'DB_A47087_smgroup_admin';
$password = 'ftccgroup1';
$dbname = 'DB_A47087_smgroup';

// Set DSN
$dsn = 'sqlsrv:server='. $host .'; Database='. $dbname; 

// Create PDO instance
$connection = new PDO($dsn, $user, $password);

// Set default fetch action for $connection to object
$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
