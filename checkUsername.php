<?php
//my web_api

//IF HEROKU APP ISNT WORKING MAKE SURE:
//MYSQL THINGY IS DOWNLOADED ONTO HEROKU APP THROUGH HEROKU
//MAKE SURE TO INCLUDE dbconnection.php FILE IN FOLDER WHEN PUSHED TO GITHUB
//CHANGE CONVIG VARS IN HEROKU TO SAME CONVIG VARS AS LAST APP

include 'dbConnection.php';

$conn = connectToDB("lab8");

$username = $_GET['username'];

//query allows SQL injection!
//$sql = "SELECT * FROM lab8_user WHERE username = '$username'";

$sql = "SELECT * FROM lab8_user WHERE username = :username";

$stmt = $conn->prepare($sql);
$stmt->execute( array(":username"=> $username ));
$record = $stmt->fetch(PDO::FETCH_ASSOC);

//print_r($record);

echo json_encode($record);

?>