<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$serverName = "SQL Server";   
$uid = "DB_A47087_smgroup_admin";     
$pwd = "ftccgroup1";    
$databaseName = "DB_A47087_smgroup";   
   
$connectionInfo = array( "UID"=>$uid,                              
                         "PWD"=>$pwd,                              
                         "Database"=>$databaseName);   
    
/* Connect using SQL Server Authentication. */    
$conn = sqlsrv_connect( $serverName, $connectionInfo);    
    
//$tsql = "select * from Inventory";    
  
//$tsql = "CREATE TABLE tblContact (    id int,    FirstName varchar(20), LastName varchar(20), Email varchar(20))";

$tsql = "CREATE TABLE Inventory(ID INT NOT NULL PRIMARY KEY, Description VARCHAR (25)NOT NULL, Quantity INT NOT NULL, Price DECIMAL (18, 2) NOT NULL)";

  
/* Execute the query. */    
    
$stmt = sqlsrv_query( $conn, $tsql);    
    
if ( $stmt )    
{    
     echo "Statement executed.<br>\n";    
}     
else     
{    
     echo "Error in statement execution.\n";    
     die( print_r( sqlsrv_errors(), true));    
}    
    
/* Iterate through the result set printing a row of data upon each iteration.*/    
    
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))    
{    
     echo "Col1: ".$row[0]."\n";    
     echo "Col2: ".$row[1]."\n";    
     echo "Col3: ".$row[2]."<br>\n";    
     echo "-----------------<br>\n";    
}    
    
/* Free statement and connection resources. */    
sqlsrv_free_stmt( $stmt);    
sqlsrv_close( $conn);    
?>    