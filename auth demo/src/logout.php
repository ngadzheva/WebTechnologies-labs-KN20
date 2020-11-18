<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_SESSION) {
            session_unset();
            session_destroy();
            
            echo "User logged out";
        } else {
            echo "Session has already expired";
        }
    } else {
        echo "Invalid request";
    }
?>