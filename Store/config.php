<?php
    $Link = mysqli_connect("localhost", "root", "", "wishlist");

    if($Link === false)
    {
        echo "Failed to connect";
        die();
    }
?>