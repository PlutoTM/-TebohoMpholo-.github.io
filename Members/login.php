<?php
    // Start of session
    session_start();

    // Check if user is logged in
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        header("location: account.php");
        exit;
    }

    //Include Config
    require_once "config.php";

    // Define variables
    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    // Process the data sent
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        // Check for empty username
        if(empty(trim($_POST["username"])))
        {
            $username_err = "<p>Please enter a username.</p>";
        }

        else
        {
            $username = trim($_POST["username"]);
        }

        // Check for empty password
        if(empty(trim($_POST["password"])))
        {
            $password_err = "<p>Please enter a password.</p>";
        }

        else
        {
            $password = trim($_POST["password"]);
        }

        //Validate Credentials
        if(empty($username_err) && empty($password_err))
        {
            // Preparing a select statement
            $LinkTest = "SELECT id, username, password 
                            FROM users WHERE username = ?;";

            if($stmt = mysqli_prepare($Link, $LinkTest))
            {
                // Bind statements as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                //Set parameter
                $param_username = $username;

                //Attempt to execute the statement
                if(mysqli_stmt_execute($stmt))
                {
                    // Store the result
                    mysqli_stmt_store_result($stmt);

                    // check if user exists id yes then 
                    // validate if passwords match
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        // Bind result variable
                        mysqli_stmt_bind_result($stmt, $id, $username 
                                                        ,$hashed_password);
                        
                        //Validating password
                        if(mysqli_stmt_fetch($stmt))
                        {
                            if(password_verify($password, $hashed_password))
                            {
                                //Password is correct
                                session_start();

                                // Store session details
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                //Redirect user to the account/members page
                                header("location: account.php");
                            }

                            else
                            {
                                //Password is not matching/valid 
                                $login_err = "Invalid username or password";
                            }
                        }
                    }

                    else
                    {
                        // Username doesn't exist
                        $login_err = "Invalid username or password";
                    }
                }

                else
                {
                    echo "Oops! something went wrong...";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        //Close Connection
        mysqli_close($Link);
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, 
    initial-scale=1">
<link rel="stylesheet" href="../css/MyStyleSheet.css" type="text/css">

</head>
<body>
 

<!-- Header -->	
<div id="header">
		<div ><img src="../Images/logo.png" alt="logo" id="logo"/></a></div>	
		

		<div id="nav-container">
		<div id="head-container">
		<button id="head-button"><a href="account.php"  id="button-text">Account</a></button>
		<button id="head-button"><a href="../store/cart.php" id="button-text">Cart</a></button>
		
		</div>
		<!-- Navigation -->
		<div id="navigation">
		<ul>
        <li><a  href="Home.php">Home</a></li>  
        <li><a  href="About.php">About</a></li>
        <li><a href="../store/store.php">Store</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        </ul>
		</div>
		<!-- End Navigation -->
		</div>
		
</div>

	<!-- End Header -->

    <body>

    <div id="form1">
        <h2>Login</h2>
        <br><br>
        <?php 
        if(!empty($login_err))
        {
            echo  $login_err;
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                            method="POST">
            <label>Username:</label><br><br>
            <input type="text" name="username" 
                class="<?php echo (!empty($username)) ? 'is-valid' : '' ?> ">

            <?php echo $username_err; ?>
            <br><br>
            <label>Password: </label><br><br>
            <input type="password" name="password" 
                class="<?php echo (!empty($password)) ? 'is-valid' : '' ?> ">

            <?php echo $password_err; ?>
            <br><br><br>
        

            <button type="submit" value="Login" class="button">
            Login
            </button>
        </form>
        <h2>Dont have an Account? Register Below</h2>
        <br>
        <div class="text-center">
        <a href="register.php">
                    <button type="submit" class="button">
                        Register
                    </button>
                    </a>
        </div>
    </div>


    <!-- Footer -->
    <footer>
    <div class="grid-container">
    

    <div class="col2">
        <h3>Connect with Us</h3>
        <div>
        <a href="https://www.facebook.com/techspotechnologyexpo/"><img src="../Images/facebook.png" id="icons1"></a>
        <a href="https://twitter.com/techspotweets/"><img src="../Images/instagram.png" id="icons1"></a>
        <a href="https://www.linkedin.com/company/techspo"><img src="../Images/linkedin.png" id="icons1"></a>
        <a href="https://www.instagram.com/techspo/"><img src="../Images/pinterest.png" id="icons1"></a>
        <a href="https://za.pinterest.com/techspo/"><img src="../Images/twitter-social-logotype.png" id="icons1"></a>
        </div>
    </div>

    </div>

    <div id="footerp">
        <p >
        © Copyright 2021 by Techspo  |  Privacy Policy  |  Code of Conduct  |  Terms of use
        </p>
    </div>
</footer>

    </body>
</html>