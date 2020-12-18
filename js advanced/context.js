name = 'Super Global';
const pesho = { age: 22, name: 'Pesho' };
const gosho = { age: 21, name: 'Gosho' };
const ivan = { age: 23, name: 'Ivan' };

const sayHi = function() {
    return `Hi, I am ${this.name}`;
};

sayHi(); // Hi, I am Super Global

pesho.sayHi = sayHi;
pesho.sayHi(); // Hi, I am Pesho

sayHi.call(gosho); // Hi, I am Gosho

pesho.sayHi.apply(ivan); // Hi, I am Gosho

const student = {
    name: 'Student',
    fn: 88888,
    info: function() {
        console.log(`${this.name} ${this.fn}`);
    }
};

student.info();

const studentInfo = student.info;
studentInfo();

const bindedStudentInfo = student.info.bind(student);
bindedStudentInfo();

const greeting = () => console.log(`Hello, ${this.name}`);
ivan.greeting = greeting;
ivan.greeting.apply(ivan);