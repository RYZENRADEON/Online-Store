const togglesignup = document.getElementById('togglesignup');
const togglesignin = document.getElementById('togglesignin');
const signupBtn = document.getElementById('signupBtn');
const signinBtn = document.getElementById('signinBtn');

const changeview = () => {
    document.getElementById('signupBox').classList.toggle('d-none');
    document.getElementById('signinBox').classList.toggle('d-none');
}

togglesignup.addEventListener('click', changeview);
togglesignin.addEventListener('click', changeview);

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

    const direction = "signupProcess.php";
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

signupBtn.addEventListener('click', signUp);

const signIn = async () => {
    const email = document.getElementById('siEmail');
    const password = document.getElementById('siPassword');
    const rememberMe = document.getElementById('rememberMe');
    // alert(rememberMe.checked);

    const form = new FormData();

    form.append('email', email.value);
    form.append('password', password.value);
    form.append('rememberMe', rememberMe.checked);

    const direction = "signinProcess.php";
    const method = "POST";
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === "success") {
            alert("Sign In Successful");
            window.location.href = "home.php";
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

signinBtn.addEventListener('click', signIn);