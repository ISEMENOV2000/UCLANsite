<?php
$connection = mysqli_connect("****", "****", "****", "****");
$myQuery = "SELECT * FROM tbl_products";
$result = mysqli_query($connection, $myQuery);

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <title>Products</title>
</head>
<?php if (isset($_SESSION['show_welcome']) && $_SESSION['show_welcome']): ?>
    <script>
        alert('Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!');
    </script>
    <?php $_SESSION['show_welcome'] = false; ?>
<?php endif; ?>
<body>
<header>
    <div class="topnav-left">
        <img src="images/UCLAN_Logo.png" alt="UCLAN Logo" height="100" width="100">
    </div>
    <div class="topnav-middle">
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search products...">
            <button onclick="searchProducts()">Search</button>
        </div>
    </div>
    <div class="topnav-right">
        <a href="Home.php">Home</a>
        <a href="products.php">Products</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="cart.php">Cart</a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="SignUp.php">Sign up</a>
        <?php endif; ?>
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="SignIn.php">Sign in</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="logout.php">Log out</a>
        <?php endif; ?>
    </div>
</header>
<p>
    <br>
</p>
<p>
    <br>
</p>
<p>
    <br>
</p>

<!-- Add a new div for search results -->
<div id="search-results-container" style="display:none;"></div>

<!-- Wrap each product in a container div -->
<div class="row" id="products-container">
    <?php
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<div class="col">';
        echo '<div class="adjust">';
        echo '<div class="inner">';
        echo '<a href="item.php?product_id=' . $row['product_id'] . '">'; // Start of the anchor tag
        echo '<img src="' . $row["product_image"] . '" alt="' . $row["product_title"] . '" width="100%" height="auto">';
        echo '<div class="title">' . $row["product_title"] . '</div>';
        echo '</a>'; // End of the anchor tag
        echo "<p>" . $row["product_desc"] . "</p>";
        echo "<p>Price: " ."€". $row["product_price"] . "</p>";
        echo '<button onclick="addToCart(' . $row['product_id'] . ')">Add to cart</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>




<div class="clearfix"></div>


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