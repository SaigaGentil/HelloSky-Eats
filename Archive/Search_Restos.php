<?php
//require_once('lib/database.php');
require_once('connection_script.php');

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
} 

//If Search button is clicked do the below
if (isset($_POST['search'])){
    $by = $_POST['type'];
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
    
    //Select query that checks and matches with what you typed
    $sql = "SELECT * FROM $tbl_name WHERE Name LIKE '%$searchq%'";
    //Execution of the query
    $results = mysqli_query($conn, $sql);
    //Count the number of rows that matches the search
    $count =  mysqli_num_rows($results);
    
    //If there are records, fetch them
    if($count == 0){
        $output = 'There was no search results!';
    }else{
        while($row = mysqli_fetch_array($results)) {
            $RestoName = $row['Name'];
            $RestoAddr = $row['Address'];
            $id = $row['Restaurant_ID'];
            header("Location: Search_results.php");
        }
    }
}
?>