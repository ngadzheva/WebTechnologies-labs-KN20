<?php
    if($_SERVER["REQUEST_METHOD"] === "GET") {
        echo "This request is used only for getting data";
    }

    if($_POST) {
        $username = isset($_POST["username"]) ? testinput($_POST["username"]) : "";
        $email = isset($_POST["email"]) ? testInput($_POST["email"]) : "";
        $age = isset($_POST["age"]) ? testInput($_POST["age"]) : 0;
        $gender = isset($_POST["gender"]) ? testInput($_POST["gender"]) : "Unknown";

        echo "$username: $gender";
    }

    function testInput($input) {
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);

        return $input;
    }
?>