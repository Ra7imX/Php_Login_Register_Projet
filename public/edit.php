<?php
session_start();

include("../src/config/connection.php");

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

    <div class="container">
        <div class="form-box box">

            <?php

                if (isset($_POST['update'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $id = $_SESSION['id'];

                    try {
                        $edit_query = $conn->prepare("UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id");
                        $edit_query->execute([
                            ':username' => $username,
                            ':email' => $email,
                            ':password' => $password,
                            ':id' => $id
                        ]);

                        echo "<div class='message'>
                            <p>Profile Updated!</p>
                            </div><br>";
                        echo "<center><a href='home.php'><button class='btn'>Go Home</button></a></center>";

                    } catch (PDOException $e) {
                        echo "Error updating profile: " . $e->getMessage();
                    }

                } else {
                    $id = $_SESSION['id'];

                    try {
                        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
                        $stmt->execute([':id' => $id]);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($result) {
                            $res_username = $result['username'];
                            $res_email = $result['email'];
                            $res_password = $result['password'];
                            $res_id = $result['id'];
                        }

                    } catch (PDOException $e) {
                        die("Error occurred: " . $e->getMessage());
                    }

            ?>

            <header>Change Profile</header>
            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="form-box">

                    <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input class="input-field" type="text" placeholder="Username" name="username"
                            value="<?php echo $res_username; ?>" required>
                    </div>

                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input class="input-field" type="email" placeholder="Email Address" name="email"
                            value="<?php echo $res_email; ?>" required>
                    </div>

                    <div class="input-container">
                        <i class="fa fa-lock icon"></i>
                        <input class="input-field password" type="password" placeholder="Password" name="password"
                            value="<?php echo $res_password; ?>" required>
                        <i class="fa fa-eye toggle icon"></i>
                    </div>

                </div>


                <div class="field">
                    <center><input type="submit" name="update" id="submit" value="Update" class="btn">
                    </center>
                </div>


            </form>
        </div>
        <?php } ?>
    </div>

    <script>
    const toggle = document.querySelector(".toggle"),
        input = document.querySelector(".password");
    toggle.addEventListener("click", () => {
        if (input.type === "password") {
            input.type = "text";
            toggle.classList.replace("fa-eye-slash", "fa-eye");
        } else {
            input.type = "password";
        }
    })
    </script>

</body>

</html>