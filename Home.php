<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
<header>
    <div class="topnav-left">
        <img src="images/UCLAN_Logo.png" alt="UCLAN Logo">
    </div>
    <div class="topnav-right">
        <a href="Home.php">Home</a>
        <a href="products.php">Products</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="cart.php">Cart</a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="SignUp.php">Sign Up</a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="SignIn.php">Sign in</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="logout.php">Log out</a>
        <?php endif; ?>
    </div>
</header>
<main>
    <!-- hardcode spacing above the video -->
    <p>
        <br>
    </p>
    <p>
        <br>
    </p>
    <p>
        <br>
    </p>

    <div class="center">
        <div class="text">
            <h1>
                Where opportunity creates success
            </h1>
        </div>
        <div class="text2">
            <p>Every student at The University of Central Lancashire is automatically a member of the Students* Union.
                We're here to make life better for students - inspiring you to succeed and achieve your goals.
                Everything you need to know about UCLan Students* Union. Your membership starts here.
            </p>
        </div>
        <h2>Offers</h2>
        <div class="offers">
            <?php
            $connection = mysqli_connect("****", "****", "****", "****");

            $query = "SELECT * FROM tbl_offers";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<div class='offer'>";
                echo "<h3>" . $row['offer_title'] . "</h3>";
                echo "<p>" . $row['offer_dec'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
        <h2>Together</h2>
        <iframe width="462" height="347"
                src=https://www.youtube.com/embed/FM2vz_KYWTs>
        </iframe>
        <h2>Join our global community</h2>
        <iframe width="462" height="347"
                src=https://www.youtube.com/embed/GMw-Sj3dudI>
        </iframe>
    </div>


</main>


<footer>






    <table style="width:100%">
        <tr>
            <td>Links
                <p><a href="https://www.uclancyprus.ac.cy/">https://www.uclancyprus.ac.cy/</a></p>
                <br>
                <br>
            </td>
            <td>Contact
                <p> Email: info@uclancyprus.ac.cy</p>
                <p> Phone: 01772 89 3000</p></td>
            <td>Location
                <p>University Ave 12-14, Pyla 7080</p>
                <br>
                <br></td>

        </tr>
    </table>
    Author: Ivan Semenov
</footer>



<link rel="stylesheet" href="style.css" type= "text/css">
</body>
</html>