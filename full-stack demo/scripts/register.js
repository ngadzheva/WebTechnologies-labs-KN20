const register = event => {
    event.preventDefault();

    const userName = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const email = document.getElementById('email').value;

    const user = {
        userName,
        password,
        confirmPassword,
        email
    };

    const settings = {
        method: 'POST',
        headers: {
            'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: `data=${JSON.stringify(user)}`
    };

    ajax('src/api.php/register', settings, false, 'login.html');
};

(function() {
    const registerBtn = document.getElementById('register');

    registerBtn.addEventListener('click', register);
})();