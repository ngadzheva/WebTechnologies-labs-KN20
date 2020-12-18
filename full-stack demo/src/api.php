<?php
    require_once "user.php";
    require_once "utility.php";
    require_once "tokenUtility.php";

    session_start();

    header("Content-type: application/json");

    $requestURL = $_SERVER["REQUEST_URI"];

    if(preg_match("/login$/", $requestURL)) {
        login();
    } elseif(preg_match("/register$/", $requestURL)) {
        register();
    } elseif(preg_match("/dashboard$/", $requestURL)) {
        dashboard();
    } elseif(preg_match("/logout$/", $requestURL)) {
        logout();
    } else {
        echo json_encode(["error" => "URL not found"]);
    }

    function login() {
        $errors = [];
        $response = [];
        $user;

        if ($_POST) {
            $data = json_decode($_POST["data"], true);

            $username = isset($data["userName"]) ? testInput($data["userName"]) : "";
            $password = isset($data["password"]) ? testInput($data["password"]) : "";
            $remember = isset($data["rememberMe"]) ? $data["rememberMe"] : false;

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

                    if ($remember) {
                        $tokenUtility = new TokenUtility();
                        $token = bin2hex(random_bytes(8));
                        $expires = time() + 60 * 60 * 24 * 30;

                        setcookie("token", $token, $expires, "/");
                        $tokenUtility->createToken($token, $_SESSION["userId"], $expires);
                    }
                } else {
                    $errors[] = $isUserValid["error"];
                }
            } 
        } else {
            $errors[] = "Invalid request";
        }

        if($errors) {
            $response = ["success" => false, "error" => $errors];
        } else {
            $response = ["success" => true];
        }

        echo json_encode($response);
    }

    function register() {
        $errors = [];
        $response = [];

        if ($_POST) {
            $data = json_decode($_POST["data"], true);

            $username = testInput($data["userName"]);
            $password = testInput($data["password"]);
            $confirmPassword = testInput($data["confirmPassword"]);
            $email = testInput($data["email"]);

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
                    }
                }
            }
        } else {
            $errors[] = "Invalid request";
        }

        if($errors) {
            $response = ["success" => false, "error" => $errors];
        } else {
            $response = ["success" => true];
        }

        echo json_encode($response);
    }

    function dashboard() {
        $response = [];

        if($_SESSION) {
            if($_SESSION["username"]) {
                $response = ["success" => true, "data" => $_SESSION["username"]];
            } else {
                $response = ["success" => false, "error" => "Unauthorized access"];
            }
        } else {
            // remember user cookie
            if(isset($_COOKIE["token"])) {
                $tokenUtility = new TokenUtility();
                $isValid = $tokenUtility->checkToken($_COOKIE["token"]);

                if($isValid["success"]) {
                    $userData = $isValid["userData"];
                    $_SESSION["username"] = $userData->getUsername();
                    $_SESSION["userId"] = $userData->getUserId();

                    $response = ["success" => true, "data" => $_SESSION["username"]];
                } else {
                    $response = $isValid;
                }
            } else {
                $response = ["success" => false, "error" => "Session expired"];
            }
        }

        echo json_encode($response);
    }

    function logout() {
        if ($_SESSION) {
            session_unset();
            session_destroy();

            setcookie("token", "", time() - 60, "/");
            
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
?>