<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
<head>
    <title>Page Title</title>
</head>
<body>

<?php 

//$mssqldriver = '{ODBC Driver 13 for SQL Server}';

$hostname='sqlsrv:Database=DB_A47087_smgroup;server=sql5008.site4now.net';
$dbname='DB_A47087_smgroup';
$username='DB_A47087_smgroup_admin';
$password='ftccgroup1';

$conn = new PDO("sqlsrv:Server=$hostname;Database=$dbname", $username, $password);

//$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
//$conn->setAttribute( PDO::SQLSRV_ATTR_QUERY_TIMEOUT, 1 ); 

$query = 'select * from Locker'; 

// simple query 
$stmt = $conn->query( $query ); 
while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){ 
    print_r( $row['Description'] . "<br>" ); 
} 

$stmt = null; 
?>
    </body>
</html>