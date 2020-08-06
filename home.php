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
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
            <p>Welcome back, <?=$_SESSION['name']?>!</p>
        </div>
        <?php 
            $conn = new mysqli('localhost', 'test', '', 'test_tugvada');
            $currName = $_SESSION['name'];
            $resultSet1 = $conn->query("SELECT username FROM users WHERE username != '$currName'");
            $query="SELECT * FROM test WHERE person1='$currName' OR person2='$currName'";
            $resultSet2 = mysqli_query($conn, $query);
            $dataRow="";
            while($rows2=mysqli_fetch_array($resultSet2)){
                $dataRow=$dataRow."<tr><td>$rows2[0]</td><td>$rows2[2]</td><td>$rows2[1]</td><td>$rows2[3]</td></tr>";
            }
        ?>
        <button id="placebet">Place a Bet</button>
        <button id="showbets">Show My Bets In Progress</button>
        <button id="hidebets" style="display:none;">Hide Bets In Progress</button>
        <form name="betform" id="betform" onsubmit="onSubmit()" style="display:none;" action="place_bet_process.php" method="POST">
            <label for="person2">Who Would You Like to Bet Against?</label>
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
            <textarea name = "betToPlace" id="betToPlace" placeholder="What's your bet?" rows="4" cols="35" required></textarea><br>
            <label for="betAmount">Enter a dollar amount to bet:</label>
            <input type="number" name="betAmount" id="betAmount" min="0.01" step="0.01" value="00.01"><br>
            <button type="reset" id="cancel" name="cancel" onclick="onCancel()">Cancel</button>
            <input type="submit" value="Place Bet">
        </form>
        <table id="betsinprogress" style="display:none;">     
            <tr>
                <th>Person 1</th>
                <th>Made this bet</th>
                <th>with Person 2</th>
                <th>for this Amount</th>
            <tr>
            <?php echo $dataRow;?>
        </table> 
        <script type="text/javascript">
            document.getElementById("placebet").onclick = function(){
                document.getElementById("placebet").style.display = "none";
                document.getElementById("betform").style.display = "block";
            }
            document.getElementById("showbets").onclick = function(){
                document.getElementById("betsinprogress").style.display = "block";
                this.style.display = "none";
                document.getElementById("hidebets").style.display = "block";
            }
            document.getElementById("hidebets").onclick = function(){
                document.getElementById("betsinprogress").style.display = "none";
                document.getElementById("showbets").style.display = "block";
                this.style.display = "none";
            }
            function onCancel(){
                document.getElementById("placebet").style.display = "block";
                document.getElementById("betform").style.display = "none";
            }
            function onSubmit(){
                alert("Your bet has been placed!");
                document.getElementById("placebet").style.display = "block";
                document.getElementById("betform").style.display = "none";
            }
        </script>   
	</body>
</html>