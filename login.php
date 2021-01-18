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

        $statement = "SELECT * FROM user_account_table WHERE username = '$username' AND password = '$password' AND active = '1'";
        
        $query = mysqli_query($connection, $statement);
        $results = @mysqli_num_rows($query);

        printf($results);

        if ($results > 0) {
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
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="css/login.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" name="login_button" value="Login">
			</form>
		</div>
	</body>
</html>
