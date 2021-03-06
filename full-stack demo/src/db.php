<?php
    class Database {
        private $connection;
        private $insertUserStatement;
        private $selectUserStatement;
        private $insertTokenStatement;
        private $selectTokenStatement;
        private $selectUserByIdStatement;

        public function __construct() {
            $config = parse_ini_file("../config/config.ini", true);

            $host = $config['db']['host'];
            $dbname = $config['db']['name'];
            $user = $config['db']['user'];
            $password = $config['db']['password'];

            $this->init($host, $dbname, $user, $password);
        }

        private function init($host, $dbname, $user, $password) {
            try {
                $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                $this->prepareStatements();
            } catch(PDOException $e) {
                return "Connection failed: " . $e->getMessage();
            }
        }

        private function prepareStatements() {
            $sql = "INSERT INTO users(username, password, email) VALUES (:user, :password, :email)";
            $this->insertUserStatement = $this->connection->prepare($sql);

            $sql = "SELECT * FROM users WHERE username=:user";
            $this->selectUserStatement = $this->connection->prepare($sql);

            $sql = "INSERT INTO tokens(token, 'user_id', expires) VALUES (:token, :userId, :expires)";
            $this->insertTokenStatement = $this->connection->prepare($sql);

            $sql = "SELECT * FROM tokens WHERE token=:token";
            $this->selectTokenStatement = $this->connection->prepare($sql);

            $sql = "SELECT * FROM users WHERE id=:id";
            $this->selectUserByIdStatement = $this->connection->prepare($sql);
        }

        public function insertUserQuery($data) {
            try {
                // ["user" => "...", "password => "...", :email => ",,,"]
                $this->insertUserStatement->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function selectUserQuery($data) {
            try {
                // ["user" => "..."]
                $this->selectUserStatement->execute($data);

                return ["success" => true, "data" => $this->selectUserStatement];
            } catch(PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function insertTokenQuery($data) {
            try {
                // ["token" => "...", "user_id => "...", "expires" => "..."]
                $this->insertTokenStatement->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function selectTokenQuery($data) {
            try {
                // ["token" => "..."]
                $this->selectTokenStatement->execute($data);

                return ["success" => true, "data" => $this->selectTokenStatement];
            } catch(PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

        public function selectUserByIdQuery($data) {
            try {
                // ["id" => "..."]
                $this->selectUserByIdStatement->execute($data);

                return ["success" => true, "data" => $this->selectUserByIdStatement];
            } catch(PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }
    }
?>