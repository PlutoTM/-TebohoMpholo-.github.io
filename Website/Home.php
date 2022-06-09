<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, 
    initial-scale=1">
<link rel="stylesheet" href="../css/MyStyleSheet.css" type="text/css">

<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: rgba(199, 2, 199, 0.726);
  font-weight: bold;
  font-size: 30px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next 
{
  right: 0;
  border-radius: 4px 0 0 4px;
}

.prev
{
  left: 0;
  border-radius: 4px 0 0 4px;
}


/* On hover */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: black;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active1, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>
<body>
 

<!-- Header -->	
<div id="header">
		<div ><img src="../Images/logo.png" alt="logo" id="logo"/></a></div>	
		

		<div id="nav-container">
		<div id="head-container">
		<button id="head-button"><a href="../Members/account.php"  id="button-text">Account</a></button>
		<button id="head-button"><a href="../store/cart.php" id="button-text">Cart</a></button>
		
		</div>
		<!-- Navigation -->
		<div id="navigation">
		<ul>
        <li><a class="active" href="Home.php">Home</a></li>  
        <li><a href="About.php">About</a></li>
        <li><a href="../store/store.php">Store</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        </ul>
		</div>
		<!-- End Navigation -->
		</div>
		
</div>
	<!-- End Header -->


  
<!-- Banner Image -->
    <img src="../Images/Banner.png" class="responsive">
    <div class="container">

    <div class="slideshow-container">

<div class="mySlides fade">
  <img src="../Images/Floorplan1.png" style="height: 180px">
</div>

<div class="mySlides fade">
  <img src="../Images/Floorplan3.JPG"  style="height: 180px">
</div>

<div class="mySlides fade">
  <img src="../Images/Floorplan2.JPG"  style="height: 180px">
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active1", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active1";
}
</script>
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