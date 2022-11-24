
<?php if (isset($_POST['form_submitted'])):
header("Location: adminTest1.php");
ob_start();
$db = "bookstore";
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername , $username , $password , $db);
$conn->set_charset("utf8");
if ($conn->connect_error)
    die("Connection failed!" .$conn -> connect_error);

//$id = $_POST['ID'];
$name = $_POST['name'];
$author = $_POST['author'];
$publish_year = $_POST['publish_year'];
$publish_no = $_POST['publish_no'];
$ISBN = $_POST['ISBN'];
$inventory_num = $_POST['inventory_num'];
$image = addslashes(file_get_contents($_POST['image']));
$customer_ID = $_POST['customer_ID'];
mysqli_query($conn,"UPDATE book SET name='".$name."' ,author='".$author."', publish_year='".$publish_year."' , publish_no='".$publish_no."', ISBN='".$ISBN."', inventory_num='".$inventory_num."', image='".$image."' , customer_ID='".$customer_ID."' where ID = " .$_POST['id'] );
    CloseCon($conn);
    ?>

<?php else:
    $db = "bookstore";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername , $username , $password , $db);
    $conn->set_charset("utf8");
    if ($conn->connect_error)
        die("Connection failed!" .$conn -> connect_error);

    $id=$_GET['id'];

    $query = "SELECT * FROM book where ID=" .$id;
    $result = mysqli_query($conn,$query);

    $row = mysqli_fetch_row($result);
    //$row = $result->fetch_assoc();

    echo   '<h2>Edit Form</h2>';

    echo   '<form action="update.php" method="POST"> ';
    echo   '<input type="hidden" name="id" value="'.$id.'">';

    echo 'name: <br />';
    echo '<input type="text" name="name" value="'.$row[0].'"><br />';

    echo 'author: <br />';
    echo '<input type="text" name="author" value="'.$row[1].'"><br />';

    echo 'publish year: <br />';
    echo '<input type="text" name="publish_year" value="'.$row[2].'"><br />';

    echo 'publish number: <br />';
    echo '<input type="text" name="publish_no" value="'.$row[3].'"><br />';

    echo 'ISBN: <br />';
    echo '<input type="text" name="ISBN" value="'.$row[4].'"><br />';

    echo 'inventory number: <br />';
    echo '<input type="text" name="inventory_num" value="'.$row[5].'"><br />';

    echo 'customer_ID: <br />';
    echo '<input type="text" name="customer_ID" value="'.$row[7].'"><br />';

    echo 'image: <br />';
    //echo '<td><img src="data:image/jpeg;base64,'.base64_encode( $row[6] ).'"/></td>';

    echo '<input type="file" name="image" value="data:image/jpeg;base64,'.base64_encode( $row[6] ).'"><br />';

    echo   '<input type="hidden" name="form_submitted" value="1" />';

    echo   '<input type="submit" value="Submit">';

    echo   '</form>';

endif;
mysqli_close($conn);
?>


