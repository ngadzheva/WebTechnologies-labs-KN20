(function(){
    var header = document.getElementsByTagName('header')[0]; // <header>
    var firstName = document.getElementById('first-name'); // <td id="first-name">
    var studentInfo = document.getElementsByClassName('student')[0]; // <tr>...</tr>
    var headerRow = document.querySelector('#header-row');
    var student = document.querySelectorAll('.student');

    header.innerHTML += ' Marks';

    var th = document.createElement('th');
    var text = document.createTextNode('Mark');
    th.append(text);
    headerRow.append(th);

    var td = document.createElement('td');
    td.innerHTML = '6';
    td.setAttribute('id', 'mark');
    var deleteButton = document.getElementById('delete');
    deleteButton.before(td);

    deleteButton.addEventListener('click', removeStudent);

    var addButton = document.querySelector('[name="add"]');
    addButton.addEventListener('click', addStudent);
})();

// window.onload = functionCall();

function addStudent(event) {
    event.preventDefault();

    var firstName = document.getElementsByName('first-name')[0];
    var lastName = document.getElementsByName('last-name')[0];
    var fn = document.getElementsByName('fn')[0];
    var mark = document.getElementsByName('mark')[0];

    var tbody = document.getElementsByTagName('tbody')[0];

    var tr = document.createElement('tr');
    tr.setAttribute('class', 'student');
    var firstNameTd = document.createElement('td');
    firstNameTd.innerHTML = firstName.value;
    var lastNameTd = document.createElement('td');
    lastNameTd.innerHTML = lastName.value;
    var fnTd = document.createElement('td');
    fnTd.innerHTML = fn.value;
    var markTd = document.createElement('td');
    markTd.innerHTML = mark.value;
    var deleteTd = document.createElement('td');
    var button = document.createElement('button');
    button.innerHTML = 'Delete';
    deleteTd.append(button);

    tr.append(firstNameTd, lastNameTd, fnTd, markTd, deleteTd);
    tbody.appendChild(tr);

    firstName.value = '';
    lastName.value = '';
    fn.value = 0;
    mark.value = 0;
}

function removeStudent(event) {
    var studentToDeleteRow = event.target.parentNode.parentNode;
    studentToDeleteRow.parentNode.removeChild(studentToDeleteRow);
}