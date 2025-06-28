<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <title>Contact Form</title>
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

    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-box box">

            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            include "../src/config/connection.php";

            if (isset($_POST['submit'])) {
                echo "<h2>Processing Contact Form...</h2>";
                
                // Get and sanitize form data
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $subject = trim($_POST['subject']);
                $message = trim($_POST['message']);

                // Basic validation
                if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                    echo "<div class='error-message'>
                        <p>❌ All fields are required!</p>
                        </div><br>";
                    echo "<a href='home.php'><button class='btn'>Go Back</button></a>";
                    exit;
                }

                // Validate email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div class='error-message'>
                        <p>❌ Invalid email format!</p>
                        </div><br>";
                    echo "<a href='home.php'><button class='btn'>Go Back</button></a>";
                    exit;
                }

                try {

                    $query = "INSERT INTO contact (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
                    $stmt = $conn->prepare($query);
                    
                    $result = $stmt->execute([
                        ':name' => $name,
                        ':email' => $email,
                        ':subject' => $subject,
                        ':message' => $message
                    ]);

                    if ($result) {
                        echo "<div class='message'>
                            <p>✅ Message sent successfully!</p>
                            <p>Thank you for contacting us, " . htmlspecialchars($name) . "!</p>
                            </div><br>";
                    } else {
                        echo "<div class='error-message'>
                            <p>❌ Failed to insert message into database</p>
                            </div><br>";
                    }

                    echo "<center><a href='home.php'><button class='btn'>Go Back to Homepage</button></a></center";

                } catch (PDOException $e) {
                    echo "<div class='error-message'>
                        <p>❌ Database Error Occurred</p>
                        <p><strong>Error Details:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                        </div><br>";

                    echo "<a href='home.php'><button class='btn'>Go Back</button></a>";
                }
            } else {
                // If accessed directly without form submission
                echo "<div class='error-message'>
                    <p>❌ No form data received</p>
                    </div><br>";
                echo "<a href='home.php'><button class='btn'>Go Back to Homepage</button></a>";
            }
            ?>

        </div>
    </div>
</body>

</html>