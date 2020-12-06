class Person {
    constructor(name, age) {
        this.name = name;
        this.age = age;
    }

    info() {
        console.log(`${this.name} ${this.age}`);
    }
}

const ivan = new Person('Ivan', 22);
ivan.info();

class Student extends Person {
    constructor(name, age, fn) {
        super(name, age);

        this.fn = fn;

        let _mark;

        this.getMark = () => _mark;

        this.setMark = (mark) => _mark = mark;
    }

    studentInfo() {
        super.info();
        console.log(`${this.fn}`)
    }
}

const maria = new Student('Maria', 22, 88888);
maria.setMark(5);