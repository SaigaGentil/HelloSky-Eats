<?php
//require_once('lib/database.php');
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "restaurant_final";
$tbl_name = "restaurant";
$tbl_name2 = "image";

$filename = $_FILES['image']['name'];
$filetmpname = $_FILES['image']['tmp_name'];
//folder where images will be uploaded
$folder = 'uploads/';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 //function for saving the uploaded images in a specific folder
    move_uploaded_file($filetmpname, $folder.$filename);
    //inserting image details (ie image name) in the database
    $sql1 = "INSERT INTO $tbl_name2 (`File_Name`)  VALUES ('$filename')";
    $qry = mysqli_query($conn, $sql1);
    
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
    //$sql2 = "INSERT INTO $tbl_name2 (File_Name) VALUES ('".$_FILES["image"]."')";
    $sql = "INSERT INTO $tbl_name (Name, Description, Address, Contact_Number, Email_Address, Website_Address)
    VALUES ('".$_POST["examplename"]."','".$_POST["exampledescription"]."','".$_POST["exampleaddress"]."','".$_POST["examplephonenbr"]."','".$_POST["exampleemail"]."','".$_POST["examplewebsite"]."')";
   
    //Check if the query was well executed
    if (mysqli_query($conn, $sql)) {
            header('Location: Adminpage.php');
            } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
            }
}
?>



