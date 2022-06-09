<?php
    session_start();
    $status="";

    if (isset($_POST['action']) && $_POST['action']=="remove")
    {
        if(!empty($_SESSION["wishlist"])) 
        {
            foreach($_SESSION["wishlist"] as $key => $value) 
            {
                if($_POST["code"] == $key)
                {
                    unset($_SESSION["wishlist"][$key]);
                    $status = "<h3>Product is removed from your cart!</h3>";
                }

                if(empty($_SESSION["wishlist"]))
                {
                    unset($_SESSION["wishlist"]);
                }
            }		
        }
    }

    if (isset($_POST['action']) && $_POST['action']=="change")
    {
        foreach($_SESSION["wishlist"] as &$value)
        {
            if($value['code'] === $_POST["code"])
            {
                $value['quantity'] = $_POST["quantity"];
                break; 
            }
        }      
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Cart</title>
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
        <li><a  href="About.php">About</a></li>
        <li><a href="../store/store.php">Store</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        </ul>
		</div>
		<!-- End Navigation -->
		</div>
		
</div>
	<!-- End Header -->

    <div class="container">

        <main>
            <?php
            if(isset($_SESSION["wishlist"]))
            {
                $total_price = 0;
            ?>	

            <table class="table">
                <tbody>
                    
                    <tr>
                        <td></td>
                        <td>ITEM NAME</td>
                        <td>QUANTITY</td>
                        <td>UNIT PRICE</td>
                        <td>ITEMS TOTAL</td>
                    </tr>

                    <?php		
                        foreach ($_SESSION["wishlist"] as $product)
                        {
                    ?>

                    <tr>
                        <td>
                            <img src='<?php echo $product["image"]; ?>' style="width:100%;"/>
                        </td>
                        <br>
                        <td>
                            <?php echo $product["name"]; ?>
                            <br />

                            <form method='post' action=''>
                                <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                <input type='hidden' name='action' value="remove" /><br>
                                <button type='submit' class='remove'>Remove Item</button>
                            </form>
                        </td>
                        <td>
                            <form method='post' action=''>
                                <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                <input type='hidden' name='action' value="change" />
                                <select name='quantity' class='quantity' onChange="this.form.submit()">
                                    <option <?php if($product["quantity"]==1) echo "selected";?>
                                    value="1">1</option>
                                    <option <?php if($product["quantity"]==2) echo "selected";?>
                                    value="2">2</option>
                                    <option <?php if($product["quantity"]==3) echo "selected";?>
                                    value="3">3</option>
                                    <option <?php if($product["quantity"]==4) echo "selected";?>
                                    value="4">4</option>
                                    <option <?php if($product["quantity"]==5) echo "selected";?>
                                    value="5">5</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <?php echo "R".$product["price"]; ?>
                        </td>
                        <td>
                            <?php echo "R".$product["price"]*$product["quantity"]; ?>
                        </td>
                    </tr>
                        <?php
                            $total_price += ($product["price"]*$product["quantity"]);
                            }
                        ?>
                    <tr>
                        <td colspan="5" text-align="right">
                            <strong>TOTAL: <?php echo "R".$total_price; ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div>
                <br>
                    <button type="submit" value="Submit" style="width: 200px; height:30px;">
                        Proceed To Check Out
                    </button>
                </div>
            <?php
                }
                
                else
                {
                    echo "<h2>Your Cart is empty!</h2><br><br><br><br><br>";
                }
            ?>

            <?php echo $status; ?>
        </main>
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