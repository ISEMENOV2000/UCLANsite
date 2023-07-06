<?php
$connection = mysqli_connect("****", "****", "****", "****");

if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Handle search query
    $query = $_GET['query'];
    $myQuery = "SELECT * FROM tbl_products WHERE product_title LIKE '%$query%'";
} else {
    // Handle initial page load
    $myQuery = "SELECT * FROM tbl_products";
}

$result = mysqli_query($connection, $myQuery);

// Generate HTML for the products
$html = "";

$i = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    // start a new row after every fourth item
    if ($i % 3 == 0) {
        $html .= '</div><div class="row">';
    }
    $html .= '<div class="adjust">';
    $html .= '<div class="inner">';
    $html .= '<a href="item.php?product_id=' . $row['product_id'] . '">'; // Start of the anchor tag
    $html .= '<img src="' . $row["product_image"] . '" alt="' . $row["product_title"] . '" width="100%" height="auto">';
    $html .= '<div class="title">' . $row["product_title"] . '</div>';
    $html .= '</a>'; // End of the anchor tag
    $html .= "<p>" . $row["product_desc"] . "</p>";
    $html .= "<p>Price: " ."€". $row["product_price"] . "</p>";
    $html .= '<button onclick="addToCart(' . $row['product_id'] . ')">Add to cart</button>';
    if (isset($_SESSION['username'])) {
        $html .= '<button onclick="addReview(' . $row['product_id'] . ')">Review</button>';
    }
    $html .= '</div>';
    $html .= '</div>';
    $i++;
}

echo $html;
mysqli_close($connection);
