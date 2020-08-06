<?php
session_start();
$person1=$_SESSION['name'];
$person2=$_POST['person2'];
$placedBet=$_POST['betToPlace'];
$placedBet=str_replace("'", '',$placedBet);
$placedBet=filter_var($placedBet, FILTER_SANITIZE_STRING);
$betAmount=$_POST['betAmount'];

//Database connection
$host = "localhost";
$dbusername = "test";
$dbpassword = "";
$dbname = "test_tugvada";

//Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_error()){
    die('Connection Error ('. mysqli_connect_errno() .')'. mysqli_connect_error());
}
else{
    $sql = "INSERT INTO test (person1, person2, placedBet, betAmount)
        values('$person1', '$person2', '$placedBet', '$betAmount')";
    if($conn->query($sql)){
        echo "Bet has been placed";
    }
    else{
        echo "Error: ". $sql ."<br>". $conn->error;
    }
    $conn->close();
    header('location: home.php');
}
?>