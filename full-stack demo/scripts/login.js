const login = event => {
    event.preventDefault();

    const userName = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('remember-me').value;

    const user = {
        userName,
        password,
        rememberMe
    };

    const settings = {
        method: 'POST',
        headers: {
            'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: `data=${JSON.stringify(user)}`
    };

    ajax('src/api.php/login', settings, false, 'dashboard.html');
};

(function() {
    const loginBtn = document.getElementById('login');

    loginBtn.addEventListener('click', login);
})();