<?php
include 'dbconnection.php';
$conn = OpenCon();
//$username = $_POST['username'];
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

$query = "SELECT * FROM my_table WHERE name = '". mysqli_real_escape_string($conn,$username) ."' AND password = '". mysqli_real_escape_string($conn,$password) ."'" ;

$result = mysqli_query($conn,$query);
$result_executed = $result->fetch_assoc();
setcookie("name", $result_executed['name'], time() + (86400 * 30), "/");
setcookie("admin", $result_executed['admin'], time() + (86400 * 30), "/");

$count = mysqli_num_rows($result);
//echo mysqli_real_escape_string($conn,$username);
echo '<br>';
//$result = $conn -> query($query);
if($count == 1){
    $admin = "SELECT admin FROM my_table WHERE name = '". mysqli_real_escape_string($conn,$username) ."' AND password = '". mysqli_real_escape_string($conn,$password) ."'" ;
    $adminresult = mysqli_query($conn,$admin);

    while($row = mysqli_fetch_assoc($adminresult)) {
        $ifAdmin = $row['admin'];
        //echo $ifAdmin;
    }

    if($ifAdmin != null){
        header('Location: adminTest1.php');
    }else {
        //echo "true";
        header('Location: userTest.php');
    }

}else{
    die("failed to find this user in database");
}
//session_start();
CloseCon($conn);
?>