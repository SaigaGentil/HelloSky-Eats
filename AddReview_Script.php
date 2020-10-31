<?php
//require_once('lib/database.php');
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "restaurant_final";
$tbl_name1 = "review";
$tbl_name2 = "rating";
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
    
    $sql2 = "INSERT INTO $tbl_name2 (Following_Ratings)
    VALUES ('".$_POST["Rating"]."')";
    
    
    $sql1 = "INSERT INTO $tbl_name1 (Reviewer_Name, Comment)
    VALUES ('".$_POST["exampleReviewerName"]."','".$_POST["exampleFormControlReview"]."')";
   
    //Check if the query was well executed
    //mysqli_query($conn, $sql2);
    if (mysqli_query($conn, $sql1) & mysqli_query($conn, $sql2)) {
        
        header('Location: Index.php');
            } else {
               echo "Error: " . $sql1 . "" . mysqli_error($conn);
            }
}
?>



