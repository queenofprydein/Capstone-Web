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
$dsn = 'sqlsrv:host='. $host .';dbname='. $dbname;
$dsn = 'sqlsrv:server='. $host .'; Database='. $dbname; 

// Create PDO instance
$connection = new PDO($dsn, $user, $password);

// Set default fetch action for $connection to object
$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

# PRDO QUERY
//$stmt = $connection->query('SELECT * FROM Inventory');
// 
//while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//    echo $row['Description'] . '<br>';
//}

//while($row = $stmt->fetch(PDO::FETCH_OBJ)){
//while($row = $stmt->fetch()){
//    echo $row->Description . '<br>';
//}

# PREPARED STATEMENTS (prepare & execute)

//UNSAFE
//$sql = "SELECT * FROM Inventory WHERE description = '$description'";

// FETCH MUTIPLE POSTS

// User Input
//$description = 'Spock';
//$quantity = 1;
//$id = '1';

// Positional Params
//$sql = 'SELECT * FROM Inventory WHERE description = ?';
//$stmt = $connection->prepare($sql);
//$stmt->execute([$description]);
//$items = $stmt->fetchAll();

// Named Params
//$sql = 'SELECT * FROM Inventory WHERE description = :description AND quantity = :quantity';
//$sql = 'SELECT * FROM Inventory WHERE description = :description';
//$stmt = $connection->prepare($sql);
//$stmt->execute(['description' => $description, 'quantity' => $quantity]);
//$stmt->execute(['description' => $description]);
//$items = $stmt->fetchAll();

//var_dump($items);
//echo "<br>";
//
//foreach($items as $item){
//    echo $item->Description . $item->Quantity . $item->Price . "<br>";
//}

// FETCH SINGLE POST
//$sql = 'SELECT * FROM Inventory WHERE id = :id';
//$stmt = $connection->prepare($sql);
//$stmt->execute(['id' => $id]);
//$item = $stmt->fetch();
//
//echo $item->Description . "<br>";

# GET ROW COUNT [[[[ THIS IS JUST NOT WORKING !!! ]]]]
//$stmt = $connection->prepare('SELECT * FROM Inventory WHERE description = ?');
// do our execute
//$stmt->execute([$description]);
//var_dump($stmt);
//$postCount = $stmt->rowCount();
//echo $postCount;


//#INSERT DATA
//
//$newID = 6;
//$newDescription = "New Stuff";
//$newQuantity = 1;
//$newPrice = 4.99;
//
//$sql = 'INSERT INTO Inventory(id, description, quantity, price) VALUES (:id, :description, :quantity, :price)';
//$stmt = $connection->prepare($sql);
//$stmt->execute(['id' => $newID, 'description' => $newDescription, 'quantity' => $newQuantity, 'price' => $newPrice]);
//echo 'Post Added';


# UPDATE DATA
//$newID = 6;
//$newQuantity = 5;
//
//$sql = 'UPDATE Inventory SET quantity = :quantity WHERE id = :id';
//$stmt = $connection->prepare($sql);
//$stmt->execute(['quantity' => $newQuantity, 'id' => $newID]);
//echo 'Post Changed';

# DELETE DATA
//$newID = 6;
//
//$sql = 'DELETE FROM Inventory WHERE id = :id';
//$stmt = $connection->prepare($sql);
//$stmt->execute(['id' => $newID]);
//echo 'Post Deleted';

# SEARCH DATA
//$search = "%Spock%";
//$sql = "SELECT * FROM Inventory WHERE description LIKE ?";
// do the prepare (make the statement ready to be completed)
//$stmt = $connection->prepare($sql);
// now we want to execute (positional parameters because it is just a '?' in the SQL statement)
//$stmt->execute([$search]);
//$items = $stmt->fetchAll();  // This is where the default object type will be used

//foreach($items as $item){
//    echo $item->Description . "<br>";
//}