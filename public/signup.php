<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="container">
        <div class="form-box box">


            <header>Sign Up</header>
            <hr>

            <form action="#" method="POST">


                <div class="form-box">

                    <?php

                    session_start();
                    include "../src/config/connection.php";
                    if (isset($_POST['register'])) {

                        $name = $_POST['username'];
                        $email = $_POST['email'];
                        $pass = $_POST['password'];
                        $cpass = $_POST['cpass'];

                        $passwd = password_hash($pass, PASSWORD_DEFAULT);
                        $key = bin2hex(random_bytes(12)); // Tu peux l'utiliser pour l'activation par mail si tu veux

                        try {
                            // Vérifier si l'email existe déjà
                            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
                            $stmt->execute([':email' => $email]);

                            if ($stmt->rowCount() > 0) {
                                echo "<div class='message'>
                                        <p>This email is used, Try another One Please!</p>
                                        </div><br>";
                                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                            } else {
                                if ($pass === $cpass) {
                                      // Insertion du nouvel utilisateur
                                    $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                                    $insert->execute([
                                        ':username' => $name,
                                        ':email' => $email,
                                        ':password' => $passwd
                                    ]);

                                    header("Location: login.php");
                                    exit();
                                } else {
                                    echo "<div class='message'>
                                            <p>Password does not match.</p>
                                            </div><br>";
                                    echo "<a href='signup.php'><button class='btn'>Go Back</button></a>";
                                }
                            }

                        } catch (PDOException $e) {
                            echo "<div class='message'>
                                    <p>Registration failed: " . $e->getMessage() . "</p>
                                    </div><br>";
                            echo "<a href='signup.php'><button class='btn'>Go Back</button></a>";
                        }

                    } else {
                    ?>


                    <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input class="input-field" type="text" placeholder="Username" name="username" required>
                    </div>

                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input class="input-field" type="email" placeholder="Email Address" name="email" required>
                    </div>

                    <div class="input-container">
                        <i class="fa fa-lock icon"></i>
                        <input class="input-field password" type="password" placeholder="Password" name="password"
                            required>
                        <i class="fa fa-eye icon toggle"></i>
                    </div>

                    <div class="input-container">
                        <i class="fa fa-lock icon"></i>
                        <input class="input-field" type="password" placeholder="Confirm Password" name="cpass" required>
                        <i class="fa fa-eye icon"></i>
                    </div>

                </div>


                <center><input type="submit" name="register" id="submit" value="Signup" class="btn"></center>


                <div class="links">
                    Already have an account? <a href="login.php">Signin Now</a>
                </div>

            </form>
        </div>
        <?php
        }
        ?>
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