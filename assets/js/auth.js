import { httpRequest } from "./utils.js";

const signinBtn = document.getElementById('signinBtn');
const signupBtn = document.getElementById('signupBtn');
const forgotPasswordBtn = document.getElementById('forgotPasswordBtn');
const resetPasswordBtn = document.getElementById('resetPasswordBtn');

async function logIn() {
    const email = document.getElementById('siEmail');
    const password = document.getElementById('siPassword');
    const rememberMe = document.getElementById('rememberMe');

    const form = new FormData();

    form.append('action', 'logIn');
    form.append('email', email.value);
    form.append('password', password.value);
    form.append('rememberMe', rememberMe.checked);

    const direction = '/Online-Store/controllers/user_controller.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await httpRequest(form, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Sign In Successful');
            window.location.href = '/Online-Store/pages/user/home.php';
        }
        else {
            const errorMsgDiv1 = document.querySelector('.errorMsgDiv1');
            const errorMsg1 = document.getElementById('errorMsg1');
            errorMsg1.innerText = responseText;
            errorMsgDiv1.classList.remove('d-none');
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

async function signUp() {
    const fName = document.getElementById('suFname');
    const lName = document.getElementById('suLname');
    const mobile = document.getElementById('suMobile');
    const email = document.getElementById('suEmail');
    const password = document.getElementById('suPassword');

    const form = new FormData();

    form.append('action', 'register');
    form.append('fname', fName.value);
    form.append('lname', lName.value);
    form.append('mobile', mobile.value);
    form.append('email', email.value);
    form.append('password', password.value);

    const direction = '/Online-Store/controllers/user_controller.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await httpRequest(form, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Sign Up Successful');
            window.location.href = '/Online-Store/index.php';
        }
        else {
            const errorMsgDiv2 = document.querySelector('.errorMsgDiv2');
            const errorMsg2 = document.getElementById('errorMsg2');
            errorMsg2.innerText = responseText;
            errorMsgDiv2.classList.remove('d-none');
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const forgotPassword = async () => {
    const loader = document.getElementById('loader');
    const text = document.getElementById('forgotPasswordBtnText');

    loader.classList.remove('d-none');//loading animation test
    text.classList.add('d-none');

    const email = document.getElementById("fpEmail");

    const form = new FormData();
    form.append('email', email.value);

    const direction = '/Online-Store/pages/user/forgotPasswordProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === 'sent') {
            alert('Password reset link sent to your email. Please check your inbox.');
        } else {
            alert(responseText);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }

    loader.classList.add('d-none');
    text.classList.remove('d-none');
}

const resetPassword = async () => {
    const password = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    const vcode = document.getElementById('vcode');
    const form = new FormData();

    form.append('password', password.value);
    form.append('confirmPassword', confirmPassword.value);
    form.append('vcode', vcode.value);

    const direction = '/Online-Store/pages/user/resetPasswordProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Password has been reset successfully.');
            window.location.href = '/Online-Store/index.php';
        } else {
            alert(responseText);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (signinBtn) {
    signinBtn.addEventListener('click', logIn)
}
if (signupBtn) {
    signupBtn.addEventListener('click', signUp);
}
if (forgotPasswordBtn) {
    forgotPasswordBtn.addEventListener('click', forgotPassword);
}
if (resetPasswordBtn) {
    resetPasswordBtn.addEventListener('click', resetPassword);
}