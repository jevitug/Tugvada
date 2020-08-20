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
		<title>Home Page</title>
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
			<h2>Home Page</h2>
            <p>Welcome back, <?=$_SESSION['name']?>!</p>
        </div>
        <?php 
            $conn = new mysqli('50.87.193.51', 'tugvadac_tugvadamgr', 'testing', 'tugvadac_tugvada_data');
            $currName = $_SESSION['name'];
            $resultSet1 = $conn->query("SELECT username FROM users WHERE username != '$currName'");
            $query="SELECT * FROM bets WHERE person1='$currName' OR person2='$currName'";
        ?>
        <div id="wrapper">
            <button id="placebet">Place a Bet</button>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <form name="betform" id="betform" onsubmit="onSubmit()" action="place_bet_process.php" method="POST">
                    <div class="inputLabel">
                        <label for="person2">Who Would You Like to Bet Against?</label><br>
                    </div>
                    <select name="person2" id="person2" required>
                        <option value="" name="none"></option>
                    <?php 
                        while($rows = $resultSet1->fetch_assoc()){
                            $person2 = $rows['username'];
                            echo "<option value='$person2' name='$person2'>$person2</option>";
                        }
                        //$conn->close();
                    ?>
                    </select><br>
                    <div class="inputLabel">
                        <label for="betToPlace">What's your bet?</label>
                    </div>
                    <textarea name = "betToPlace" id="betToPlace" placeholder="What's your bet?" rows="4" cols="35" style="resize:none;"required></textarea><br>
                    <div class="inputLabel">
                        <label for="betAmount">Enter a dollar amount to bet:</label>
                    </div>
                    <input type="number" name="betAmount" id="betAmount" min="0.01" step="0.01" value="00.01"><br>
                    <div id="formbtns">
                        <button type="reset" id="cancel" name="cancel" onclick="onCancel()">Cancel</button>
                        <input type="submit" value="Place Bet">
                    </div>    
                </form>
            </div>
        </div>
        <script type="text/javascript">
            document.getElementById("placebet").onclick = function(){
                //document.getElementById("placebet").style.display = "none";
                document.getElementById("betform").style.display = "block";
                document.getElementById("myModal").style.display = "block";
            }
            function onCancel(){
                document.getElementById("placebet").style.display = "block";
                document.getElementById("betform").style.display = "none";
                document.getElementById("myModal").style.display = "none";
            }
            function onSubmit(){
                alert("Your bet has been placed!");
                document.getElementById("placebet").style.display = "block";
                document.getElementById("betform").style.display = "none";
            }
            window.onclick = function(event){
                if(event.target == document.getElementById("myModal")){
                    document.getElementById("myModal").style.display = "none";
                }
            }
        </script>   
	</body>
</html>