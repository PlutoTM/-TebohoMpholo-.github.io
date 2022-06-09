<?php
    session_start();

    // Check if user is logged in
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true)
    {
        header("location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Account</title>
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
        <li><a href="About.php">About</a></li>
        <li><a href="../store/store.php">Store</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        </ul>
		</div>
		<!-- End Navigation -->
		</div>
		
</div>

	<!-- End Header -->


    <body>

    <div class="container">
    <h2>Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
    <br>

        <!--<a href="reset.php"><p>Reset Password</p></a>-->

		<div id="account">
		<a href="logout.php"  style="text-decoration-line: none;"><button class="button">Logout</button></a>
        <a href="../website/cart.php"  style="text-decoration-line: none;"><button class="button">View Cart</button></a>
		</div>
		<br><br><br>
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