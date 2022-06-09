<?php
    #Include Config
    require_once "config.php";

    # Variables
    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";

    # Sending data when the form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        #Validating Username
        if(empty(trim($_POST["username"])))
        {
            $username_err = "Please enter a username";
        }

        elseif(!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["username"])))
        {
            $username_err = "Username can only contain letters, numbers and 
                                underscores";
        }

        else
        {
            #Preparing to select data
            $sql = "SELECT id FROM users WHERE username = ?";

            if($stmt = mysqli_prepare($Link, $sql))
            {
                #Binding data to the statement
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                #Set parameter
                $param_username = trim($_POST["username"]);

                #Executing the parameter
                if(mysqli_stmt_execute($stmt))
                {
                    #Storing the data
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        $username_err = "This username is already taken";
                    }

                    else
                    {
                        $username = trim($_POST["username"]);
                    }
                } 

                else
                {
                    echo "Oops... something went wrong, please try again later.";
                }

                #close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate Password
        if(empty(trim($_POST["password"])))
        {
            $password_err = "Please enter a password";
        }

        elseif(strlen(trim($_POST["password"])) < 6)
        {
            $password_err = "Password must have at least 6 characters";
        }

        else
        {
            $password = trim($_POST["password"]);
        }

        //Validate Confirm Password
        if(empty(trim($_POST["confirm_password"])))
        {
            $confirm_password_err = "Please confirm password";
        }

        else
        {
            $confirm_password = trim($_POST["confirm_password"]);

            if(empty($password_err) && ($password != $confirm_password))
            {
                $confirm_password_err = "Password did not match";
            }
        }

        //Check for input errors
        if(empty($username_err) && empty($password_err) 
                                        && empty($confirm_password_err))
        {
            // Preparing the statement
            $InsertMethod = "INSERT INTO users (username, password) VALUES (?, ?)";

            if($stmt = mysqli_prepare($Link, $InsertMethod))
            {
                // Bind variables to the prepared parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
                // Set parameters
                $param_username = $username;
                //Password Hash
                $param_password = password_hash($password, PASSWORD_DEFAULT); 

                //Executing the statement
                if(mysqli_stmt_execute($stmt))
                {
                    // Redirect the user to the login page
                    header("location: login.php");
                }

                else
                {
                    echo "Oops Something went wrong, please try again later.";
                }

                //Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Closing the connection
        mysqli_close($Link);
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
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
        <li><a   href="About.php">About</a></li>
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


<h2>Register Form</h2>  
<br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
                                                        method="POST">

<label>Username:</label><br><br>
<input type="text" name="username" class="<?php echo(!empty($username_err)) ? 'is-valid': ''; ?>" value="<?php echo $username; ?>">
<br><br>
<label>Password:</label><br><br>
<input type="password" name="password" class="<?php echo(!empty($password_err)) ? 'is-valid': ''; ?>" value="<?php echo $password; ?>">
<br><br>
<label>Confirm Password:</label><br><br>
<input type="password" name="confirm_password" class="<?php echo(!empty($confirm_password_err)) ? 'is-valid': ''; ?>">
<br><br><br>

<div class="text-center">
            <button type="submit" value="Submit" class="button">
                Submit
            </button>
        </div>
</form>

<br><br>

<h2>Already have an Account? Login Below</h2>
<br>
<div class="text-center">
<a href="Login.php">
        <button type="submit" class="button">
            Login
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