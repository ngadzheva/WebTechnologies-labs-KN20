<?php
    require_once "db.php";
    require_once "user.php";

    class TokenUtility {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function createToken($token, $userId, $expires) {
            $this->db->insertTokenQuery(["token" => $token, "userId" => $userId, "expires" => $expires]);
        }

        public function checkToken($token) {
            $query = $this->db->selectTokenQuery(["token" => $token]);

            if($query["success"]) {
                $foundToken = $query["data"]->fetch(PDO::FETCH_ASSOC);

                if($foundToken) {
                    if($foundToken["expires"] > time()) {
                        $query = $this->db->selectUserByIdQuery(["id" => $foundToken["user_id"]]);

                        if($query["success"]) {
                            $foundUser = $query["data"]->fetch(PDO::FETCH_ASSOC);

                            if($foundUser) {
                                $user = new User($foundUser["username"], $foundUser["password"]);
                                $user->setEmail($foundUser["email"]);

                                return ["success" => true, "userData" => $user];
                            } else {
                                return ["success" => false, "error" => "Invalid token"];
                            }
                        } else {
                            return $query;
                        }
                    } else {
                        return ["success" => false, "error" => "Session expired"];
                    }
                } else {
                    return ["success" => false, "error" => "Invalid session"];
                }
            } else {
                return $query;
            }
        }
    }
?>