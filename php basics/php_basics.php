<?php
    $age = 20;
    $message = "I am $age years old";

    echo $message;

    $number = '5asll';

    echo '<br/>';

    echo $age + $number;
    echo 3 == '3abc';

    function add() {
        global $age;

        $five = 5;

        return $age + $five;
    }

    function increment() {
        static $a = 0;

        echo $a;

        ++$a;
    }

    echo "<br/>";
    increment();
    increment();
    increment();

    $array = array();
    $array[0] = 2;
    $array[1] = 5;
    $array[] = 10;
    $array[] = 6;

    echo "<br/>";
    var_dump($array);

    echo "<br/>";
    print_r($array);

    $initializedArray = array(1, 2, 3, 4);

    $arr = [];
    $otherArr = [5, 3, 8];

    foreach($array as $value) {
        echo "<br/>";
        echo $value;
    }

    array_push($array, 8);
    array_unshift($array, 3);

    array_pop($array);
    array_shift($array);

    array_slice($array, 1, 3);
    array_splice($array, 2, 2);
    array_splice($array, 1, 0, 30);

    sort($array);
    rsort($array);

    $namedArray = array("name" => "John", "age" => 23);
    $otherNamedArray = ["name" => "Jack", "age" => 22];

    echo "<br/>";
    var_dump($namedArray);

    echo "<br/>";
    print_r($namedArray);

    $namedArray["name"];
    $namedArray["age"];

    echo $namedArray["test"];

    foreach($namedArray as $key => $value) {
        echo "<br/>";
        echo "$key: $value";
    }

    $twoDimensionalArray = [
        [1, 2, 3],
        [3, 2, 6]
    ];

    $namedArr = [
        "first" => [
            "name" => "Some name",
            "age" => 22
        ],
        "second" => [
            "name" => "asdf"
        ]
    ];

    $letters = ['a', 's', 'd', 'f'];
    implode('', $letters); // asdf
    $string = 'asdf';
    explode('', $string);

    class User {
        // public, private, protected
        private $userName;
        private $password;

        public function __construct($userName, $password) {
            $this->$userName = $userName;
            $this->password = $password;
        }

        public function setUsername($userName) {
            $this->userName = $userName;
        }

        public function getUsername() {
            return $this->userName;
        }
    }

    $user = new User("ivgerves", "pass");
    echo $user->getUsername();


    class Student extends User {
        private $firstName;
        private $lastName;
        private $fn;

        public function __construct($userName, $password, $firstName, $lastName, $fn) {
            parent::__construct($userName, $password);

            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->fn = $fn;
        }

        public function getStudentInfo() {
            return parent::getUsername() . ": " . $this->firstName . " " . $this->lastName;
        }
    }

    $student = new Student("ivgerves", "pass", "Ivan", "Veselinov", 81255);
    echo $student->getStudentInfo();
?>