<?php
    require_once "utility.php";
    require_once "user.php";

    session_start();

    $errors = [];

    if ($_POST) {
        $username = isset($_POST["username"]) ? testInput($_POST["username"]) : "";
        $password = isset($_POST["password"]) ? testInput($_POST["password"]) : "";

        if (!$username) {
            $errors[] = "Input username";
        }

        if (!$password) {
            $errors[] = "Input password";
        }

        if ($username && $password) {
            $user = new User($username, $password);
            $isUserValid = $user->isValid();

            if ($isUserValid["success"]) {
                $_SESSION["username"] = $username;
                $_SESSION["userId"] = $user->getUserId();
                
                header("Location: dashboard.html");
            } else {
                echo $isUserValid["error"];
            }
        } else {
            foreach ($errors as $error) {
                echo $error;
                echo "<br/>";
            }
        }
    } else {
        echo "Invalid type of request";
    }
?>