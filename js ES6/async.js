const fs = require('fs');
const { writeFile } = require('fs/promises');

const changeFn = fn => fn.replace(/00/g, '12');

let result;

fs.readFile('students.txt', 'utf-8', (error, data) => {
    if(error) {
        console.error(`Failed reading file: ${error}`);
        return;
    }

    result = changeFn(data.toString());

    fs.writeFile('editedStudents.txt', result, (error) => {
        if(error) {
            console.error(`Failed writing file: ${error}`);
            return;
        }

        fs.readFile('editedStudents.txt', 'utf-8', (error, data) => {

        });
    });
});

fs.writeFile('editedStudents.txt', result, (error) => {
    if(error) {
        console.error(`Failed writing file: ${error}`);
        return;
    }
});

const read = (file, callbackSuccess, callbackError) => {
    return new Promise((resolve, reject) => {
        fs.readFile(file, 'urf-8', (error, data) => {
            if(error) {
                reject(error);
            }

            resolve(data);
        });
    });
}

const write = (file, data) => {
    return new Promise((resolve, reject) => {
        fs.writeFile(file, data, (error) => {
            if(error) {
                reject(error);
            }

            resolve();
        });
    });
}

read('students.txt')
    .then(result => changeFn(result.toString()))
    .then(editedResult => writeFile('promisedStudents.txt', editedResult))
    .then(() => console.log('DONE'))
    .catch(error => console.error(error));