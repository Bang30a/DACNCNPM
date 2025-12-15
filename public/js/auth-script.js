const wrapper = document.querySelector('.wrapper');
const registerLink = document.querySelector('.register-link');
const loginLink = document.querySelector('.login-link');

if (registerLink && wrapper) {
    registerLink.onclick = (e) => {
        e.preventDefault();
        wrapper.classList.add('active');
    }
}

if (loginLink && wrapper) {
    loginLink.onclick = (e) => {
        e.preventDefault();
        wrapper.classList.remove('active');
    }
}