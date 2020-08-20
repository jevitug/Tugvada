<?php 
    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<title>Bets in Progress Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Tugvada</h1>
                <a href="index.php">Home</a>
                <a href="bets_in_progress.php">Bets in Progress</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Bets in Progress Page</h2>
            <p>Bets in Progress for User: <?=$_SESSION['name']?>!</p>
        </div>
        <?php 
            //start the connection
            $conn = new mysqli('50.87.193.51', 'tugvadac_tugvadamgr', 'testing', 'tugvadac_tugvada_data');
            $currName = $_SESSION['name'];
            //query to get bets placed by or against current user
            $query="SELECT * FROM bets WHERE person1='$currName' OR person2='$currName'";
            $resultSet = mysqli_query($conn, $query);
            $dataRow="";
            while($rows2=mysqli_fetch_array($resultSet)){
                $dataRow=$dataRow."<tr><td>$rows2[0]</td><td>$rows2[2]</td><td>$rows2[1]</td><td>$rows2[3]</td></tr>";
            }
            $conn->close();
        ?>
        <div id="tableWrapper">
            <table id="betsinprogress">     
                <tr>
                    <th>Person 1</th>
                    <th>Made this bet</th>
                    <th>with Person 2</th>
                    <th>for this Amount</th>
                <tr>
                <?php echo $dataRow;?>
            </table> 
        </div>
    </body>
</html>