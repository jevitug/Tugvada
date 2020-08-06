<?php
    session_start();
    //Database connection
    $host = "localhost";
    $dbusername = "test";
    $dbpassword = "";
    $dbname = "test_tugvada";

    $username='';
    $email='';
    $password='';
    $confpassword='';

    //Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(isset($_POST['register'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $hash_pass = md5($password);
        $email=$_POST['email'];
        $confpassword=$_POST['confpassword'];
        
        $sql_u = "SELECT * FROM users WHERE username='$username'";
        $sql_e = "SELECT * FROM users WHERE email='$email'";
        $reg_u = mysqli_query($conn, $sql_u) or die(mysqli_error($conn));
        $reg_e = mysqli_query($conn, $sql_e) or die(mysqli_error($conn));
        
        /*Big if statement here that OR's all the below if's, then 
          individually check each of the below if's so the error
          messages appear all at once */
        if(mysqli_num_rows($reg_u) > 0 || mysqli_num_rows($reg_e) > 0 ||
            $password != $confpassword){
            //if username already in use
            if(mysqli_num_rows($reg_u) > 0){
                $name_error = "Sorry, this username is already taken";
            }
            //if email already in use
            if(mysqli_num_rows($reg_e) > 0){
                $email_error = "Sorry, this email is already taken";
            }
            //if passwords don't match
            if($password != $confpassword){
                $match_error = "Passwords don't match";
            }
        }
        else{
            //proceed to insert into table
            $query = "INSERT INTO users (username, email, password)
                    VALUES('$username', '$email', '" . $hash_pass . "')";
            $result = mysqli_query($conn, $query) or die(mysqli_error($db));
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            header('location: home.php');
        }
    }
?>