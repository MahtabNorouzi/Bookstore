<?php

$db = "bookstore";
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername , $username , $password , $db);
$conn->set_charset("utf8");
if ($conn->connect_error)
    die("Connection failed!" .$conn -> connect_error);

$name = $_POST['name'];

$query = "SELECT * FROM `book` WHERE name = '".$name."'";
$result = mysqli_query($conn,$query);

if(!$result){
    die("no book found");
}else{
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

    mysqli_free_result($result);
}

mysqli_close($conn);

?>
