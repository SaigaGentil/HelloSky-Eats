<?php
//require_once('lib/database.php');
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "restaurant_final";
$tbl_name = "restaurant";
$tbl_name2 = "image";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
} 

//Test connection
if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
} 
else{
    $id = $_GET['id']; //Get the Restaurant_ID from the link
    $sql = "DELETE FROM $tbl_name WHERE Restaurant_ID='$id'"; //Store a DELETE query in a '$sql' variable.
    $sql2 = "DELETE FROM $tbl_name2 WHERE Image_ID='$id'";
    mysqli_query($conn, $sql2);
       
    //Check if the query was well executed
    if (mysqli_query($conn, $sql)) {
        header('Location: Adminpage.php');
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
}
?>