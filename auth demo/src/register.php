<?php
    require_once "user.php";
    require_once "utility.php";

    $errors = [];
    $response = [];

    if ($_POST) {
        $username = testInput($_POST["username"]);
        $password = testInput($_POST["password"]);
        $confirmPassword = testInput($_POST["confirm-password"]);
        $email = testInput($_POST["email"]);

        if (!$username) {
            $errors[] = "Username is required";
        }

        if (!$password) {
            $errors[] = "Password is required";
        }

        if (!$confirmPassword) {
            $errors[] = "Confirm Password is required";
        }

        if ($username && $password && $confirmPassword) {
            if ($password !== $confirmPassword) {
                $errors[] = "Confirm Password does not match password";
            } else {
                $user = new User($username, $password);
                $exists = $user->userExists();
    
                if ($exists) {
                    $errors[] = "This username already exists";
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $user->createUser($passwordHash, $email);
    
                    header("Location: login.html");
                }
            }
        }

        if($errors) {
            foreach ($errors as $error) {
                echo $error;
                echo "<br/>";
            }
        } else {
            echo "User is successfully registered!";
        }
    } else {
        echo "Invalid request";
    }
?>