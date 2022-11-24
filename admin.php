<?php

$db = "bookstore";
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername , $username , $password , $db);
$conn->set_charset("utf8");
if ($conn->connect_error)
    die("Connection failed!" .$conn -> connect_error);

//ezafe kardane yek ketabe jadid
$name = $_POST['name'];
$author = $_POST['author'];
$publish_year = $_POST['publish_year'];
$publish_no = $_POST['publish_no'];
$ISBN = $_POST['ISBN'];
$inventory_num = $_POST['inventory_num'];
$image = addslashes(file_get_contents($_POST['image']));
$customer_ID = $_POST['customer_ID'];

$name = mysqli_real_escape_string($conn, $name);
$author = mysqli_real_escape_string($conn, $author);
$publish_year = (int) $publish_year;
$publish_no = (int) $publish_no;
$ISBN = (int) $ISBN;
$inventory_num = (int) $inventory_num;
$customer_ID = (int) $customer_ID;

$query  = "INSERT INTO book (name, author,publish_year, publish_no, ISBN, inventory_num, customer_ID,image) 
VALUES ('".$name."','".$author."','".$publish_year."','".$publish_no."','".$ISBN."','".$inventory_num."', '".$customer_ID."' , '".$image."')";
$result = mysqli_query($conn, $query);

if ($result) {
    //SUCCESS
    echo "successfully added to database";
    header('Location: adminTest1.php');
}else {
    //FAILURE
    die("Database query failed. " . mysqli_error($conn));
    //last bit is for me, delete when done
}



mysqli_close($conn);

?>