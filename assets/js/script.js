const togglesignup = document.getElementById('togglesignup');
const togglesignin = document.getElementById('togglesignin');
const signupBtn = document.getElementById('signupBtn');
const signinBtn = document.getElementById('signinBtn');
const forgotPasswordBtn = document.getElementById('forgotPasswordBtn');
const resetPasswordBtn = document.getElementById('resetPasswordBtn');
const adSigninBtn = document.getElementById('adSigninBtn');
const adminUserPage = document.getElementById('adminUserPage');
const regBrandBtn = document.getElementById('regBrandBtn');
const regColorBtn = document.getElementById('regColorBtn');

const changeview = () => {
    document.getElementById('signupBox').classList.toggle('d-none');
    document.getElementById('signinBox').classList.toggle('d-none');
}

if (togglesignup) {
    togglesignup.addEventListener('click', changeview);
}
if (togglesignin) {
    togglesignin.addEventListener('click', changeview);
}


const formSubmitHandler = (form, direction, method, isAsync) => {
    return new Promise((resolve, reject) => {
        const req = new XMLHttpRequest();
        req.open(method, direction, isAsync);

        req.onload = () => {
            if (req.status >= 200 && req.status < 300) {
                resolve(req.responseText);
            } else {
                reject(`HTTP ${req.status}: ${req.statusText}`);
            }
        };

        req.onerror = () => reject('Network error');
        req.send(form);
    });
}

const signUp = async () => {
    const fName = document.getElementById('suFname');
    const lName = document.getElementById('suLname');
    const mobile = document.getElementById('suMobile');
    const email = document.getElementById('suEmail');
    const password = document.getElementById('suPassword');

    const form = new FormData();

    form.append('fname', fName.value);
    form.append('lname', lName.value);
    form.append('mobile', mobile.value);
    form.append('email', email.value);
    form.append('password', password.value);

    const direction = '/Online-Store/pages/user/signupProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
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

if (signupBtn) {
    signupBtn.addEventListener('click', signUp);
}

const signIn = async () => {
    const email = document.getElementById('siEmail');
    const password = document.getElementById('siPassword');
    const rememberMe = document.getElementById('rememberMe');

    const form = new FormData();

    form.append('email', email.value);
    form.append('password', password.value);
    form.append('rememberMe', rememberMe.checked);

    const direction = '/Online-Store/pages/user/signinProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
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
if (signinBtn) {
    signinBtn.addEventListener('click', signIn);
}


const forgotPassword = async () => {
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

}

if (forgotPasswordBtn) {
    forgotPasswordBtn.addEventListener('click', forgotPassword);
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

if (resetPasswordBtn) {
    resetPasswordBtn.addEventListener('click', resetPassword);
}

const adminSignIn = async () => {
    const email = document.getElementById('adSiEmail');
    const password = document.getElementById('adSiPassword');

    const form = new FormData();

    form.append('email', email.value);
    form.append('password', password.value);

    const direction = '/Online-Store/pages/admin/adminSignInProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Admin Sign In Successful');
            window.location.href = '/Online-Store/pages/admin/adminDashboard.php';
        } else {
            const errorMsgDiv = document.querySelector('.errorMsgDiv3');
            const errorMsg = document.getElementById('errorMsg3');
            errorMsg.innerText = responseText;
            errorMsgDiv.classList.remove('d-none');
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (adSigninBtn) {
    adSigninBtn.addEventListener('click', adminSignIn);
}

const loadUsers = async (page) => {
    const direction = `/Online-Store/pages/admin/fetchUsers.php?page=${page}`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(null, direction, method, isAsync);
        document.getElementById('content').innerHTML = responseText;
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

window.onload = () => {
    if (document.body.id === "adminUserPage") {
        const page = document.body.dataset.page;
        loadUsers(page);
    }
};

const changeUserStatus = async (userId, newStatus, page) => {
    const form = new FormData();

    form.append('userId', userId);
    form.append('newStatus', newStatus);

    const direction = '/Online-Store/pages/admin/changeUserStatus.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('User status updated successfully.');
            // const currentPage = document.body.dataset.page;
            loadUsers(page);
        } else {
            alert(`Failed to update user status: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const registerBrand = async () => {
    const brandName = document.getElementById('regBrandName');

    const form = new FormData();
    form.append('brandName', brandName.value);

    const direction = '/Online-Store/pages/admin/registerBrandProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() == 'success') {
            alert('Brand registered successfully.');
            window.location.reload();
        } else {
            alert(`Failed to register brand: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (regBrandBtn) {
    regBrandBtn.addEventListener('click', registerBrand);
}

const registerColor = async () => {
    const colorName = document.getElementById('regColorName');

    const form = new FormData();
    form.append('colorName', colorName.value);

    const direction = '/Online-Store/pages/admin/registerColorProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() == 'success') {
            alert('Color registered successfully.');
            window.location.reload();
        } else {
            alert(`Failed to register color: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if(regColorBtn) {
    regColorBtn.addEventListener('click', registerColor);
}