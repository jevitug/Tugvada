<?php include 'signup_process.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tugvada Sign Up</title>
        <link rel="stylesheet" type="text/css" href="./signup.css">
    </head>
    <body>
        <form id="signupform" action="signup.php" method="POST">
            <h1>Register</h1>
            
            <div 
                <?php if (isset($email_error)): ?> 
                    class="form_error" 
                <?php endif ?>
            >
                <?php if (isset($email_error)): ?>
                    <span><?php echo $email_error; ?></span>
                <?php endif ?>
                <div class="inputLabel">
                    <label>Email</label>
                </div>
                <input type="email" id="email" name="email" placeholder="" value="<?php echo $email; ?>" required> 
            </div>
            
            <div
                <?php if (isset($name_error)): ?>
                    class="form_error"
                <?php endif ?>
            >
                <?php if (isset($name_error)): ?>
                    <span><?php echo $name_error; ?></span>
                <?php endif ?>
                <div class="inputLabel">    
                    <label>Username</label>
                </div>
                <input type="text" id="username" name="username" placeholder="" value="<?php echo $username; ?>" required>
            </div>
            
            <div
                <?php if (isset($match_error)): ?>
                    class="form_error"
                <?php endif ?>
            >        
                <div class="inputLabel">
                    <label>Password</label>
                </div>    
                <input type="password" id="password" name="password" placeholder="" value="<?php echo $password; ?>" required>
            </div>
        
            <div
                <?php if (isset($match_error)): ?>
                    class="form_error"
                <?php endif ?>
            >    
                <div class="inputLabel">
                    <label>Confirm Password</label>
                </div>
                <input type="password" id="confpassword" name="confpassword" placeholder="" value="<?php echo $confpassword; ?>" required>
                <?php if (isset($match_error)): ?>
                    <span><?php echo $match_error; ?></span>
                <?php endif ?>
            </div>
            <div>
                <button type="submit" name="register" id="reg_btn">Register</button>
            </div>
            <p> Already have an account? <a href="login.php">Sign in</a></p>
        </form>
    </body>
</html>