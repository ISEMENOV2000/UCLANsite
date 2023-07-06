<?php
session_start();
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the values submitted via the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connect to the database
    $connection = mysqli_connect("****", "****", "****", "****");

    // Check if the connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the highest user_id value from the database
    $query = "SELECT MAX(user_id) AS max_user_id FROM tbl_users";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $next_user_id = $row["max_user_id"] + 1;

    // Prepare the SQL query
    $query = "INSERT INTO tbl_users (user_id, user_full_name, user_address, user_email, user_pass) VALUES (?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = mysqli_prepare($connection, $query);

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, "issss", $next_user_id, $username, $username, $email, $password);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    // Redirect the user to a success page
    header("Location: products.php");
    exit();
}
if (isset($_SESSION['username'])) {
header("Location: LogedIn.php");
exit();}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SignUp</title>
</head>
<body>
<header>
    <div class="topnav-left">
        <img src="images/UCLAN_Logo.png" alt="UCLAN Logo">
    </div>
    <div class="topnav-right">
        <a href="Home.php">Home</a>
        <a href="products.php">Products</a>
        <a href="cart.php">Cart</a>
    </div>
</header>

<main>
<p>
    <br>
</p>
<p>
    <br>
</p>
<p>
    <br>
</p>

<div class="container">
    <h1>Sign Up</h1>
    <form method="POST" action="SignUp.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Sign Up</button>
    </form>
</div>
<p>
    <br>
</p>

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