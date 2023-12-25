#!/usr/local/bin/php
<?php
session_save_path(__DIR__ . '/sessions/');
session_name('myWebpage');
session_start();

 header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['username']) || !isset($_POST['credit'])) {
    echo "Either the user or credit was not posted."; 
    exit;
}


$db = new SQLite3('credit.db');

$username = $_POST['username'];
$credit = floatval($_POST['credit']);

//var_dump($credit);

// Check if the username already exists
$existingUser = $db->querySingle("SELECT username FROM users WHERE username = '$username'");

if ($existingUser) {
    // Username exists, perform the update 
    $smt = $db->prepare("UPDATE users SET credit = :credit WHERE username = :username");
    $smt->bindValue(':credit', $credit, SQLITE3_FLOAT);
    $smt->bindValue(':username', $username, SQLITE3_TEXT);
   

    $result = $smt->execute();
    
} 

$result = $db->query("SELECT * FROM users WHERE username = '$username'")->fetchArray();
var_dump($result);



$db->close();


?>

