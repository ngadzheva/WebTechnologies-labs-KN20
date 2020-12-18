const logout = event => {
    event.preventDefault();

    ajax('src/api.php/logout', {method: 'GET'}, false, 'login.html');
};

(function(){
    ajax('src/api.php/dashboard', {method: 'GET'}, true);

    const logoutBtn = document.getElementById('logout');

    logoutBtn.addEventListener('click', logout);
})();