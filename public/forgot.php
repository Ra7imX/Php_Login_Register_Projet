<?php
session_start();
include("../src/config/connection.php");

$message = '';
$error = '';

if (isset($_POST["forgot_password"])) {
    $email = $_POST["email"];

    if (empty($email)) {
        $error = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);

            if ($stmt->rowCount() > 0) {
                // In a real application, you would generate a token and send an email here.
                // For this example, we'll just show a success message.
                $message = "If your email address is in our database, you will receive a password reset link.";
            } else {
                $error = "Your email is not in our database! ";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .message {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 15px;
        margin: 10px 0;
        border-radius: 5px;
        text-align: center;
    }

    .error-message {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
        padding: 15px;
        margin: 10px 0;
        border-radius: 5px;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-box box">
            <header>Forgot Password</header>
            <hr>
            <?php if ($message): ?>
            <div class="message">
                <p><?php echo $message; ?></p>
            </div><br>
            <?php endif; ?>
            <?php if ($error): ?>
            <div class="error-message">
                <p><?php echo $error; ?></p>
            </div><br>
            <?php endif; ?>
            <form action="#" method="POST">
                <div class="form-box">
                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input class="input-field" type="email" placeholder="Enter your Email Address" name="email"
                            required>
                    </div>
                </div>
                <center><input type="submit" name="forgot_password" id="submit" value="Reset Password" class="btn">
                </center>
                <div class="links">
                    Remember your password? <a href="login.php">Login Now</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>