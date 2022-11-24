<?php
header("Location: cart.php");
$db = "bookstore";
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername , $username , $password , $db);
$conn->set_charset("utf8");
if ($conn->connect_error)
    die("Connection failed!" .$conn -> connect_error);

if (isset($_GET['id'])):
    $id=$_GET['id'];
    $sql = "SELECT s.number FROM shopping_basket s WHERE username='".$_COOKIE["name"]."' and book_id=".$id;
    $result = $conn -> query($sql) or die($conn->error);
    $row = mysqli_fetch_array($result);
    if($row != null and $row['number'] != null):
        $count = $row['number'] - 1;
        if($count >= 1):
            $sql = "UPDATE `shopping_basket` SET number = ". $count ." WHERE username='".$_COOKIE["name"]."' and book_id=".$id;
        else:
            mysqli_query($conn,"DELETE FROM shopping_basket WHERE username='".$_COOKIE["name"]."' and book_id=".$id);
        endif;
        $result = $conn -> query($sql) or die($conn->error);

    endif;
endif;
mysqli_close($conn);

?>
