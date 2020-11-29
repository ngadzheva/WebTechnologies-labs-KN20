function Person(name, age) {
    this.name = name;
    this.age = age;
}

Person.prototype.info = function() {
    console.log(`${this.name} ${this.age}`);
};

function Student(name, fn, age) {
    Person.call(this, name, age);

    this.fn = fn;

    let _mark;

    this.getMark = function() {
        return _mark;
    }

    this.setMark = function(newMark) {
        _mark = newMark;
    }
}

Student.prototype.studentInfo = function() {
    console.log(`${this.info()} ${this.fn}`);
};

Student.prototype = Person.prototype;

Student.prototype.sayHi = function() {
    console.log(`Hello, ${this.name}`);
};

const gosho = new Student('Ivan', 88888, 22);
gosho.info();
gosho.sayHi();
gosho.studentInfo();
gosho.setMark(5);
gosho.getMark();

const maria = new Person('Maria', 22);
maria.sayHi();

Student.prototype = Object.create(Person.prototype);
Student.prototype.info = function() {
    console.log(`${Person.prototype.info.call(this)} ${this.fn}`);
};

const student = new Student('Student', 88889, 22);
const person = new Person('Person', 23);

student.info(); // Student 22 88889
person.info(); // Person 23

const student2 = new Student('Student 2', 888887, 24);
student2.info = function() {
    console.log(`${this.fn}`);
};

student2.info(); // 888887

function Age(age) {
    this.age = age;

    this.getAge = function() {
        return this.age;
    };
}

const age = new Age(22);
const ivan = new Student('Ivan', 88888, age.getAge.bind(age));
ivan.info();

const pesho = new Student('Pesho', 88889, age.getAge.bind(age));

Student.prototype.getName = function() {
    console.log(this.name);
};

pesho.getName();
