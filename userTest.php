<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<br>


<br>
<br>
<br>

<?php
$db = "bookstore";
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername , $username , $password , $db);
$conn->set_charset("utf8");
if ($conn->connect_error)
    die("Connection failed!" .$conn -> connect_error);
$query = "SELECT * FROM `book`";
$result = mysqli_query($conn,$query);
if (!$result) {
    die("Query to show fields from table failed");
}

$fields_num = mysqli_num_fields($result);
echo "<table border='1'><tr>";
for($i=0; $i<$fields_num-1; $i++)
{
    $field = mysqli_fetch_field($result);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";

while($row = mysqli_fetch_row($result))
{
    echo "<tr>";

    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "<td>$row[5]</td>";
    if($row[5] > 0) {
        echo '<td><img src="data:image/jpeg;base64,'.base64_encode( $row[6] ).'"/></td>';
    }else{
        echo '<td><img src="namojud.png"/></td>';
    }
    echo "<td>$row[7]</td>";
    echo '<td> <a href="cart.php?id='.$row[8].'"> add to cart </td>';
    echo "</tr>\n";
}

if(isset($_COOKIE["admin"])){
    echo "</br>";
    echo "<a href='admin.php'>admin</a>";
}echo "</br>";
echo "<a href='html_login.html'>go back to login page</a>";
echo "</br>";
echo "</br>";
echo "<a href='about_us.html'>About Us</a>";

echo   '<h2>Edit Form</h2>';
echo   '<form action="search.php" method="POST"> ';
echo 'search by name: <br />';
echo '<input type="text" name="name"><br />';
echo   '<input type="submit" value="Submit">';



mysqli_free_result($result);
?>