<?php
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
        $count = $row['number'] + 1;
        $sql = "UPDATE `shopping_basket` SET number = ". $count ." ";
        $result = $conn -> query($sql) or die($conn->error);
    else:
        $sql = "INSERT INTO `shopping_basket`(`username`, `book_id`,  `number`) VALUES ('".$_COOKIE["name"]."','".$_GET['id']."', 1)";
        $result = $conn -> query($sql) or die($conn->error);
    endif;
endif;

$query = "SELECT * FROM `shopping_basket`";
$result = mysqli_query($conn,$query);
if (!$result) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result);
echo "<table border='1'><tr>";
for($i=0; $i<$fields_num; $i++)
{
    $field = mysqli_fetch_field($result);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";

while($row = mysqli_fetch_row($result)) {
    echo "<tr>";

    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo '<td> <a href="basket_remove.php?id='.$row[1].'"> delete basket </td>';

}