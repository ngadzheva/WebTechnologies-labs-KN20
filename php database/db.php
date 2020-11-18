<?php
    $host = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "www";

    try {
        $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $sql = "CREATE TABLE students(
            fn INT(8) UNSIGNED NOT NULL,
            userID INT NOT NULL,
            firstName VARCHAR(30) NOT NULL,
            lastName VARCHAR(30) NOT NULL,
            PRIMARY KEY (fn),
            FOREIGN KEY(userID) REFERENCES users(id)
        )";
        $connection->exec($sql);

        $studentFn = 82333;
        $sql = "INSERT INTO student(fn, userID, firstName, lastName) VALUES (82333, 1, 'Ivan', 'Ivanov')";
        $connection->exec($sql);

        // prepared statement
        $sql = "INSERT INTO students(fn, userID, firstName, lastName) VALUES(?, ?, ?, ?)";
        $statement = $connection->prepare($sql);
        $statement->execute([82335, 2, 'Maria', 'Georgieva']);

        $sql = "SELECT * FROM users";
        $result = $connection->query($sql);
        $res = $result->fetchAll(PDO::FETCH_NUM);

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            var_dump($row);
            echo "<br/>";
            echo $row['id'] . " " . $row['username'] . ": " . $row['email'];
            echo "<br/>";
        }

        $sql = "UPDATE students SET fn=:fn WHERE userID=:id";
        $statement = $connection->prepare($sql);
        $statement->execute(["fn" => 82334, "id" => 1]);
    } catch(PDOException $error) {
        echo $error->getMessage();
    }
?>