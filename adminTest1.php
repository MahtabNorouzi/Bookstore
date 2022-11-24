<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<br>
<body>
<a href='html_login.html'>go back to login page</a>
</br><a href='userTest.php'>user page</a>

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


//        echo "<td>".$row['ID']."</td>";
        echo '<td> <a href="delete.php?id='.$row[8].'"> delete </td>';
        echo '<td> <a href="update.php?id='.$row[8].'"> update </td>';


        echo "</tr>\n";
    }

    mysqli_free_result($result);
    ?>
<form action ="admin.php" method = "post">

    <fieldset>
        <legend>Insert</legend>

        name: <br />
        <input type="text" name="name" id = "name"><br />

        author: <br />
        <input type="text" name="author" id = "author"><br />

        publish year: <br />
        <input type="text" name="publish_year" id = "publish_year"><br />

        publish number: <br />
        <input type="text" name="publish_no" id = "publish_no"><br />

        ISBN: <br />
        <input type="text" name="ISBN" id = "ISBN"><br />

        inventory number: <br />
        <input type="text" name="inventory_num" id = "inventory_num"><br />

        customer_ID: <br />
        <input type="text" name="customer_ID" id = "customer_ID"><br />

        image: <br />
        <input type="file" name="image" id = "image"><br />

        <br />
        <input type="submit" name = "submit" id="submit">
        <br />
    </fieldset>
</form>
</body>
</html>