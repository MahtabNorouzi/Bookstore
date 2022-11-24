<?php
header('Location: adminTest1.php');
$db = "bookstore";
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername , $username , $password , $db);
$conn->set_charset("utf8");
if ($conn->connect_error)
    die("Connection failed!" .$conn -> connect_error);

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM book where ID = " .$id );


mysqli_close($conn);
?>

