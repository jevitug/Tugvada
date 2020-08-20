<?php
session_start();
$person1=$_SESSION['name'];
$person2=$_POST['person2'];
$placedBet=$_POST['betToPlace'];
$placedBet=str_replace("'", '',$placedBet);
$placedBet=filter_var($placedBet, FILTER_SANITIZE_STRING);
$betAmount=$_POST['betAmount'];

//Database connection
$host = "50.87.193.51";
$dbusername = "tugvadac_tugvadamgr";
$dbpassword = "testing";
$dbname = "tugvadac_tugvada_data";

//Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_error()){
    die('Connection Error ('. mysqli_connect_errno() .')'. mysqli_connect_error());
}
else{
    $sql = "INSERT INTO bets (person1, person2, placedBet, betAmount)
        values('$person1', '$person2', '$placedBet', '$betAmount')";
    if($conn->query($sql)){
        //echo "Bet has been placed";
    }
    else{
        echo "Error: ". $sql ."<br>". $conn->error;
    }
    $conn->close();
    header('location: index.php');
}
?>