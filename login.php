<?php
// Initialize the session
session_start();

// Include config file
include 'admin/login_config.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// validate credentials in database
if (isset($_POST["login_button"])) {

    //  Verify password and username is set
    if ( !isset($_POST['username'], $_POST['password']) ) {
        exit('Please fill both the username and password fields!');
    } else {
        if ($connection) {
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        $statement = "SELECT * FROM user_account_table WHERE username = '$username' AND password = '$password'";
        
        if ($connection) {
            echo "SQL ALIVE";
        }
        

        $query = mysqli_query($connection, $statement);
        $results = @mysqli_num_rows($query);

        printf($results);

        if ($results > 0) {
            $_SESSION["id"] = 1;
            $_SESSION["username"] = mysqli_query($connection, $results);
            $login_date = "UPDATE user_account_table SET last_logon= 'NOW()' WHERE username ='$username'";
            mysqli_query($connection, $login_date);
            header("location: index.php");
        }

        } else {
            die("no database connection");
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    </head>
    <body>
        <div class="wrapper">
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>
            <form method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="login_button" value="Login">
                </div>
            </form>
        </div>    
    </body>
</html>