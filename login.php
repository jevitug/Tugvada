<?php include('login_process.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tugvada Login</title>
        <link rel="stylesheet" type="text/css" href="./login.css">
    </head>
    <body>
        <form id="loginform" action="login.php" method="POST">
            <h1>Login</h1>
            <div
                <?php if (isset($user_pass_error)): ?>
                    class="form_error"
                <?php endif ?>
            >
                <?php if (isset($user_pass_error)): ?>
                    <span><?php echo $user_pass_error; ?></span>
                <?php endif ?>
                <div class="inputLabel">    
                    <label>Username</label>
                </div>
                <input type="text" id="username" name="username" placeholder="" value="<?php echo $username; ?>" required>
            </div>
            
            <div
                <?php if (isset($user_pass_error)): ?>
                    class="form_error"
                <?php endif ?>
            >        
                <div class="inputLabel">
                    <label>Password</label>
                </div>    
                <input type="password" id="password" name="password" placeholder="" value="<?php echo $password; ?>" required>
            </div>
            <div>
                <button type="submit" name="login" id="login_btn">Login</button>
            </div>
            <hr>
            <p> Don't have an account? <a href="signup.php">Register</a></p>
        </form>
    </body>
</html>