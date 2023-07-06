<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_POST['product_id']) || !isset($_POST['review_title']) || !isset($_POST['review_desc']) || !isset($_POST['review_rating'])) {
    header("Location: item.php?product_id=" . $_POST['product_id']);
    exit();
}

$connection = mysqli_connect("****", "****", "****", "****");

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$review_title = $_POST['review_desc'];
$review_desc = $_POST['review_desc'];
$review_rating = $_POST['review_rating'];
$review_timestamp = date("Y-m-d H:i:s");

$myQuery = "INSERT INTO tbl_reviews (user_id, product_id, review_title, review_desc, review_rating, review_timestamp) VALUES ($user_id, $product_id, '$review_title', '$review_desc', $review_rating, '$review_timestamp')";
$result = mysqli_query($connection, $myQuery);

if ($result) {
    $_SESSION['review_success'] = "Your review has been submitted successfully.";
} else {
    $_SESSION['review_error'] = "Error submitting review. Please try again later.";
}

mysqli_close($connection);

header("Location: item.php?product_id=" . $product_id);
exit();