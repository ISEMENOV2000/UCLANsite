<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $connection = mysqli_connect("****", "****", "****", "****");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM tbl_users WHERE user_full_name = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($password == $row['user_pass']) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['show_welcome'] = true;
            header("Location: products.php");
            exit();
        } else {
            $errorMessage = "Invalid username or password. Please try again.";
        }
    } else {
        $errorMessage = "Invalid username or password. Please try again.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}

if (isset($_SESSION['username'])) {
    header("Location: LogedIn.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <title>Log In</title>
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
        <h1>Log In</h1>
        <?php if (isset($errorMessage)) { ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php } ?>
        <form method="POST" action="SignIn.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Log In</button>
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