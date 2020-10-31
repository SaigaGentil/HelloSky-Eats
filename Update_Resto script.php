<?php
//require_once('lib/database.php');
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "restaurant_final";
$tbl_name = "restaurant";
$tbl_name2 = "image";
/*
$filename = $_FILES['image']['name'];
$filetmpname = $_FILES['image']['tmp_name'];
$folder = 'uploads/';*/
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
/*
move_uploaded_file($filetmpname, $folder.$filename);

    $sql2 = "UPDATE $tbl_name2 SET File_Name = '".$_FILES['image']['name']."' WHERE Image_ID = '$id'";
    mysqli_query($conn, $sql2);
*/
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['edit']))
{
    $id = $_POST['exampleid'];
    
    $filetmpname = $_FILES["image"]["tmp_name"];
    $folder = "uploads/";
    move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" .$_FILES["image"]["name"]);
    $filename = $_FILES["image"]["name"];

    $sql2 = "UPDATE $tbl_name2 SET File_Name = '$filename' WHERE Image_ID = '$id'";
    mysqli_query($conn, $sql2);
    
    //$ifot = $_FILES['ifoto'];
    
    $name = $_POST['examplename'];
    $description = $_POST['exampledescription'];
    $address = $_POST['exampleaddress'];
    $phone = $_POST['examplephonenbr'];
    $email = $_POST['exampleemail'];
    $web = $_POST['examplewebsite'];
    
    $sql = "UPDATE $tbl_name SET Name = '".$_POST["examplename"]."', Description = '".$_POST["exampledescription"]."', Address = '".$_POST["exampleaddress"]."', Contact_Number = '".$_POST["examplephonenbr"]."', Email_Address = '".$_POST["exampleemail"]."', Website_Address = '".$_POST["examplewebsite"]."' WHERE Restaurant_ID = '$id'";
    
    
    if (mysqli_query($conn, $sql)) {
        header('Location: Adminpage.php');
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
    
}

?>