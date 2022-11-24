<?php
function OpenCon(){
    $db = "mysql";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername , $username , $password , $db);
    $conn->set_charset("utf8");
    if ($conn -> connect_error){
        die("Connection failed!" .$conn -> connect_error);
    }else{
        echo "Connected Successfully!";
        return $conn;
    }
}

function CloseCon($conn){
    $conn -> close();
}

?>