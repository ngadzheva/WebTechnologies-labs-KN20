var age = 23;
var interpolatedString = `I am ${age} years old`;

console.log(1 + '1');
console.log('1' + 1);

console.log('2' - 1);

console.log('1' == 1);
console.log('1' === 1);

console.log(1 + +'1');

console.log('a' * 1);

console.log('b' + 'a' + +'a' + 'a');

var students = ['Ivan', 'Maria', 'Anton'];

// students.pop(); // delete last element
// students.shift(); // delete first element
students.push('Hristina'); // add element at the end
students.unshift('Dimitar'); // add element at the beginning

// ['Dimitar', 'Ivan', 'Maria', 'Anton', 'Hristina']

students.slice(1, 2); // ['Ivan', 'Maria']

students.splice(1, 3); // ['Ivan', 'Maria', 'Anton']
students.splice(1, 0, 'Some student'); // ['Ivan', 'Some student', 'Maria', 'Anton']

students.sort();

var KNStudents = students.map(function(student) {
    return `${student} studies Computer science`;
});
// ['Ivan studies Computer science', ...]

students.reduce(function(acc, curr) {
    return acc += `${curr}, `;
}, '');
// 'Ivan, Some student, Maria, Anton'

students.filter(function(student, index) {
    return index % 2 !== 0;
});

for (var i = 0; i < students.length; ++i) {
    console.log(students[i]);
}

students.forEach(function(student, index) {
    console.log(student);
});

var student = {
    firstName: 'Ivan',
    lastName: 'Ivanov',
    age: 23,
    facultyNumber: 88888,
    func: function() {
        console.log("Hello, student");
    }
};

var hashProp = 'facutryNumber';
student.firstName; // Ivan
student['age']; // 23
student[hashProp] // 88888

var studentInfo = '';
for(var key in student) {
    studentInfo += `${student[key]} `;
}
// 'Ivan Ivanov 23 88888'

var studentInfo = '';
Object.keys(student).forEach(function (key) {
    studentInfo += `${student[key]} `;
});

var studentInfo = '';
Object.values(student).forEach(function (value) {
    studentInfo += value;
});

Object.entries(student).forEach(function ([ key, value ]) {
    studentInfo += `${key}: ${value} \n`;
});

var students = {
    student1: {
        firstName: 'Ivan',
        lastName: 'Ivanov',
        age: 23,
        facultyNumber: 88888
    },
    student2: {
        firstName: 'Ivan',
        lastName: 'Ivanov',
        age: 24,
        facultyNumber: 88889
    }
};

students.student1.firstName; // Ivan

var jsonStudent = `{
    "firstName": "Maria",
    "lastName": "Georgieva",
    "age": 20,
    "facultyNumber": 88898
}`;

var jsonToObject = JSON.parse(jsonStudent);
jsonToObject.firstName;

var objToJSON = JSON.stringify(students);

console.log(objToJSON);

function asdf() {
    for (i = 0; i < 10; ++i) {
        var c = i;
    }

    c += 10;

    console.log(c);
}

c = 5;
asdf();
console.log(c);