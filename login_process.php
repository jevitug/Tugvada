<?php 
    session_start();
    //Database connection
    $host = "50.87.193.51";
    $dbusername = "tugvadac_tugvadamgr";
    $dbpassword = "testing";
    $dbname = "tugvadac_tugvada_data";

    $username='';
    $password='';

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(isset($_POST['login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $hash_pass=md5($password);
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_pass'";
        $reg = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        //if username doesn't exist
        if(mysqli_num_rows($reg) == 0){
            $user_pass_error = "Invalid username or password";
        }
        //if username was found in table
        else{
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            header('location: index.php');
        }
    }
?>