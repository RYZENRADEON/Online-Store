const togglesignup = document.getElementById('togglesignup');
const togglesignin = document.getElementById('togglesignin');
const signupBtn = document.getElementById('signupBtn');
const signinBtn = document.getElementById('signinBtn');
const forgotPasswordBtn = document.getElementById('forgotPasswordBtn');
const resetPasswordBtn = document.getElementById('resetPasswordBtn');

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
    const method = "POST";
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === "success") {
            alert("Sign Up Successful");
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

    const direction = "/Online-Store/pages/user/signinProcess.php";
    const method = "POST";
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === "success") {
            alert("Sign In Successful");
            window.location.href = "/Online-Store/pages/user/home.php";
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

    const responseText = await formSubmitHandler(form, direction, method, isAsync);
    if (responseText.trim() == "sent") {
        alert('Password reset link sent to your email. Please check your inbox.');
    } else {
        alert('Error: ' + responseText);
    }
}

if (forgotPasswordBtn) {
    forgotPasswordBtn.addEventListener('click', forgotPassword);
}

const resetPassword =async () => {
    const password = document.getElementById("newPassword");
    const confirmPassword = document.getElementById("confirmPassword");
    const vcode = document.getElementById("vcode");
    const form = new FormData();
    
    form.append('password', password.value);
    form.append('confirmPassword', confirmPassword.value);
    form.append('vcode', vcode.value);
    
    const direction = '/Online-Store/pages/user/resetPasswordProcess.php';
    const method = 'POST';
    const isAsync = true;
    
    const responseText = await formSubmitHandler(form, direction, method, isAsync);
    if (responseText.trim() == "success") {
        alert('Password has been reset successfully.');
        window.location.href = "/Online-Store/index.php";
    } else {
        alert('Error: ' + responseText);
    }
}

if(resetPasswordBtn) {
    resetPasswordBtn.addEventListener('click', resetPassword);
}