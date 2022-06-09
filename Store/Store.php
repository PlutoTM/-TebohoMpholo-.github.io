<?php
    session_start();
    include('config.php');
    $status = "";

    if(isset($_POST['code']) && $_POST['code'] != "")
    {
        $code = $_POST['code'];
        $result = mysqli_query(
            $Link,
            "SELECT * FROM list WHERE code = $code"
        );

        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        $code = $row['code'];
        $price = $row['price'];
        $image = $row['image'];

        $wishArray = array(
            $code => array(
                'name' => $name,
                'code' => $code,
                'price' => $price,
                'quantity' => 1,
                'image' => $image
            )
        );

        if(empty($_SESSION["wishlist"]))
        {
            $_SESSION["wishlist"] = $wishArray;
            $status = "<h2>Product added to cart!</h2>";
        }

        else
        {
            $wish_keys = array_keys($_SESSION["wishlist"]);

            if(in_array($code,$wish_keys))
            {
                $status = "<h2>Product is already on your Cart!</h2>";
            }

            else
            {
                $_SESSION["wishlist"] = array_merge(
                    $_SESSION["wishlist"],
                    $wishArray
                );

                $status = "<h2>Product is already on your Cart!</h2>";
            }
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
<title>Store</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, 
    initial-scale=1">
<link rel="stylesheet" href="../css/MyStyleSheet.css" type="text/css">

<body>	

<!-- Header -->	
<div id="header">
		<div ><img src="../Images/logo.png" alt="logo" id="logo"/></a></div>	
		

		<div id="nav-container">
		<div id="head-container">
		<button id="head-button"><a href="../Members/account.php"  id="button-text">Account</a></button>
		<button id="head-button"><a href="cart.php" id="button-text">Cart</a></button>
		
		</div>
		<!-- Navigation -->
		<div id="navigation">
		<ul>
        <li><a  href="Home.php">Home</a></li>  
        <li><a href="About.php">About</a></li>
        <li><a  class="active"  href="../store/store.php">Store</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        </ul>
		</div>
		<!-- End Navigation -->
		</div>
		
</div>
	<!-- End Header -->
	
    

	<!-- Main -->
	<div class="container">

    <h2>Our Merchandise</h2>

		<!-- Content -->
		<div id="content">

        <div id="notif">
            <?php echo $status ?>
            <br>
        </div>
			
			<!-- Products -->

			        <!-- Wishlist -->
					<?php
            if(!empty($_SESSION["wishlist"]))
            {
        ?>

            <div id="display">
                <a href="cart.php">
                    
                    <span>
                        <?php $wish_count; ?>
                    </span>
                </a>
            </div>

        <?php
            }
        ?>


        <?php
            $result = mysqli_query($Link, "SELECT * FROM list");

            while($row = mysqli_fetch_assoc($result))
            {
                echo "
				<div>
				<form method = 'post' action = '' style='float: left; width: 30%; border: 1px solid #9495a2 ; margin: 10px; box-shadow: 0px 5px 5px 5px  #9495a2; background:#f3f3f3;'>
					<input type='hidden' name = 'code' value = ".$row['code'].">
					<div>
						<img src=".$row['image']." style='width:100%;'>
					</div><br>
					<div style='font-size: 18px; font-family: sans-serif; ' >
						".$row['name']. "
					</div><br>
					<div style='font-size: 15px; font-family: sans-serif; '>
					R".$row['price']."
					</div><br>

					<button type='submit'  style='margin: 0px 0px 50px 0px;'>Add to Cart</button>
					
				</form>
			</div> 
                ";  
            }

            mysqli_close($Link);
        ?>        
			<!-- End Products -->
			
	</div>

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