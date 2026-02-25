const togglesignup      = document.getElementById('togglesignup');
const togglesignin      = document.getElementById('togglesignin');
const signupBtn         = document.getElementById('signupBtn');
const signinBtn         = document.getElementById('signinBtn');
const forgotPasswordBtn = document.getElementById('forgotPasswordBtn');
const resetPasswordBtn  = document.getElementById('resetPasswordBtn');
const adSigninBtn       = document.getElementById('adSigninBtn');
const adminUserPage     = document.getElementById('adminUserPage');
const regBrandBtn       = document.getElementById('regBrandBtn');
const regColorBtn       = document.getElementById('regColorBtn');
const regCategoryBtn    = document.getElementById('regCategoryBtn');
const regSizeBtn        = document.getElementById('regSizeBtn');
const regProductBtn     = document.getElementById('regProductBtn');
const regStockBtn       = document.getElementById('regStockBtn');
const editProductBtn    = document.getElementById('editProductBtn');
const img               = document.getElementById('editProductImg');
const preview           = document.getElementById('productPreview');//same
const printBtn          = document.getElementById('printBtn');
// const searchBtn         = document.getElementById('searchBtn');
const profPicUploadBtn  = document.getElementById('profPicUploadBtn');
const updateProfileBtn  = document.getElementById('updateProfileBtn');
const addToCatrBtn      = document.getElementById('addToCatrBtn');
// const delCartBtn        = document.getElementById('delCartBtn');//same
const buyNowBtn         = document.getElementById('buyNowBtn');

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

// --PAGE_LOAD--
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

const loadProdcut = async (page) => {
    const direction = `/Online-Store/pages/admin/fetchProduct.php?page=${page}`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(null, direction, method, isAsync);
        document.getElementById('content').innerHTML = responseText;
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const loadStock = async (page) => {
    const direction = `/Online-Store/pages/admin/fetchStock.php?page=${page}`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(null, direction, method, isAsync);
        document.getElementById('content').innerHTML = responseText;
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const search = async (page) => {
    const text = document.getElementById('search').value;

    const direction = `/Online-Store/pages/user/searchProductProcess.php?search=${text}&page=${page}`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(null, direction, method, isAsync);
        document.getElementById('content').innerHTML = responseText;
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const loadCart = async () => {
    const direction = `/Online-Store/pages/user/loadCartProcess.php`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(null, direction, method, isAsync);
        document.getElementById('content').innerHTML = responseText;
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

// const loadChart = async () => {
//     const ctx = document.getElementById('chart1');

//     const direction = `/Online-Store/pages/admin/loadChartProcess.php`;
//     const method = 'GET';
//     const isAsync = true;

//     try {
//         const responseText = await formSubmitHandler(null, direction, method, isAsync);
//         const json = JSON.parse(responseText);

//         new Chart(ctx, {
//             type: 'line',
//             data: {
//                 labels: json.labels,
//                 datasets: [{
//                     label: '# of Quentity',
//                     data: json.data,
//                     borderWidth: 1
//                 }]
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true
//                     }
//                 }
//             }
//         });
//     } catch (error) {
//         console.log(`Error: ${error}`);
//     }
// }

// --ONLOAD--
window.onload = () => {
    if (document.body.id === "adminUserPage") {
        const page = document.body.dataset.page;
        loadUsers(page);
    }

    if (document.body.id === "adminProductPage") {
        const page = document.body.dataset.page;
        loadProdcut(page);
    }

    if (document.body.id === "adminStockPage") {
        const page = document.body.dataset.page;
        loadStock(page);
    }

    if (document.body.id === 'adSearch') {
        const page = document.body.dataset.page;
        search(page);
    }

    if (document.body.id === 'cart') {
        loadCart();
    }

    if (document.body.id === 'adminDashboard') {
        console.log('working');
        loadChart();
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

const changeProductStatus = async (productId, newStatus, page) => {
    const form = new FormData();

    form.append('productId', productId);
    form.append('newStatus', newStatus);

    const direction = '/Online-Store/pages/admin/changeProductStatus.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Product status updated successfully.');
            // const currentPage = document.body.dataset.page;
            loadProdcut(page);
        } else {
            alert(`Failed to update product status: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const changeStockStatus = async (stockId, newStatus, page) => {
    const form = new FormData();

    form.append('stockId', stockId);
    form.append('newStatus', newStatus);

    const direction = '/Online-Store/pages/admin/changeStockStatus.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Stock status updated successfully.');
            // const currentPage = document.body.dataset.page;
            loadStock(page);
        } else {
            alert(`Failed to update stock status: ${responseText}`);
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

if (regColorBtn) {
    regColorBtn.addEventListener('click', registerColor);
}

const registerCategory = async () => {
    const categoryName = document.getElementById('regCategoryName');

    const form = new FormData();
    form.append('categoryName', categoryName.value);

    const direction = '/Online-Store/pages/admin/registerCategoryProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() == 'success') {
            alert('Category registered successfully.');
            window.location.reload();
        } else {
            alert(`Failed to register category: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (regCategoryBtn) {
    regCategoryBtn.addEventListener('click', registerCategory);
}

const registerSize = async () => {
    const sizeName = document.getElementById('regSizeName');

    const form = new FormData();
    form.append('sizeName', sizeName.value);

    const direction = '/Online-Store/pages/admin/registerSizeProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() == 'success') {
            alert('Size registered successfully.');
            window.location.reload();
        } else {
            alert(`Failed to register size: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (regSizeBtn) {
    regSizeBtn.addEventListener('click', registerSize);
}

const registerProduct = async () => {
    const regProducteName = document.getElementById('regProducteName');
    const regProducteDes = document.getElementById('regProducteDes');
    const regProductCat = document.getElementById('regProductCat');
    const regProductCol = document.getElementById('regProductCol');
    const regProductBrand = document.getElementById('regProductBrand');
    const regProductSize = document.getElementById('regProductSize');
    const regProductImg = document.getElementById('regProductImg');

    const form = new FormData();

    form.append('regProducteName', regProducteName.value);
    form.append('regProducteDes', regProducteDes.value);
    form.append('regProductCat', regProductCat.value);
    form.append('regProductCol', regProductCol.value);
    form.append('regProductBrand', regProductBrand.value);
    form.append('regProductSize', regProductSize.value);
    form.append('regProductImg', regProductImg.files[0]);

    const direction = '/Online-Store/pages/admin/registerProductProcess.php';
    const method = 'POST';
    const isAsync = true;
    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() == 'success') {
            alert('Product registered successfully.');
            window.location.reload();
        } else {
            alert(`Failed to register product: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (regProductBtn) {
    regProductBtn.addEventListener('click', registerProduct);
}

const registerStock = async () => {
    const regStockPro = document.getElementById('regStockPro');
    const regStockPrice = document.getElementById('regStockPrice');
    const regStockQty = document.getElementById('regStockQty');

    const form = new FormData();

    form.append('regStockPro', regStockPro.value);
    form.append('regStockPrice', regStockPrice.value);
    form.append('regStockQty', regStockQty.value);

    const direction = '/Online-Store/pages/admin/registerStockProcess.php';
    const method = 'POST';
    const isAsync = true;
    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() == 'success') {
            // sweetAlerts(true, "Stock registerBrand", responseText, 'success');
            window.location.reload();
        } else {
            alert(`Failed to register stock: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (regStockBtn) {
    regStockBtn.addEventListener('click', registerStock);
}

// sweet alaert and toast 
const sweetAlerts = (type, title, text, icon) => {
    type == true ? Toast.fire({
        icon: icon,
        title: title,
        text: text
    }) : Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'Close'
    });

    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
}

const loadProductUpdateModal = async (prodId) => {
    const form = null;
    const direction = `/Online-Store/pages/admin/fetchProductDetails.php?id=${prodId}`;
    const method = 'GET';
    const isAsync = true;
    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText) {
            const data = JSON.parse(responseText);
            updateProductUpdateModal(data);
        } else {
            alert(`Failed to load product update modal: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const updateProductUpdateModal = (prodData) => {
    document.getElementById('editProducteId').value = prodData.product_id;
    document.getElementById('editProducteName').value = prodData.product_name;
    document.getElementById('editProducteDes').value = prodData.description;
    document.getElementById('editProductCat').value = prodData.cat_id;
    document.getElementById('editProductCol').value = prodData.color_id;
    document.getElementById('editProductBrand').value = prodData.brand_id;
    document.getElementById('editProductSize').value = prodData.size_id;
    document.getElementById('productPreview').src = prodData.img;//same

    new bootstrap.Modal('#editProductModal').show();
}

document.addEventListener('click', (e) => {
    const btn = e.target.closest('.edit-product-btn');
    if (!btn) return;

    const prodId = btn.dataset.id;
    loadProductUpdateModal(prodId);
});

if (img && preview) {
    img.addEventListener('change', () => {
        const file = img.files[0];
        if (file) {
            const reder = new FileReader();
            reder.onload = (e) => {
                preview.src = e.target.result;
            };
            reder.readAsDataURL(file);
        }
    });
}

const updateProduct = async () => {
    const editProducteId = document.getElementById('editProducteId');
    const editProducteName = document.getElementById('editProducteName');
    const editProducteDes = document.getElementById('editProducteDes');
    const editProductCat = document.getElementById('editProductCat');
    const editProductCol = document.getElementById('editProductCol');
    const editProductBrand = document.getElementById('editProductBrand');
    const editProductSize = document.getElementById('editProductSize');
    const editProductImg = document.getElementById('editProductImg');

    const form = new FormData();

    form.append('editProducteId', editProducteId.value);
    form.append('editProducteName', editProducteName.value);
    form.append('editProducteDes', editProducteDes.value);
    form.append('editProductCat', editProductCat.value);
    form.append('editProductCol', editProductCol.value);
    form.append('editProductBrand', editProductBrand.value);
    form.append('editProductSize', editProductSize.value);
    form.append('editProductImg', editProductImg.files[0]);

    const direction = '/Online-Store/pages/admin/updateProductProcess.php';
    const method = 'POST';
    const isAsync = true;
    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() == 'success') {
            alert('Product updated successfully.');
            window.location.reload();
        } else {
            alert(`Failed to upload product: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (editProductBtn) {
    editProductBtn.addEventListener('click', updateProduct);
}

const printReport = () => {
    const original = document.body.innerHTML;
    const printArea = document.getElementById('printArea');
    document.body.innerHTML = printArea.innerHTML;
    window.print();

    document.body.innerHTML = original;
}

if (printBtn) {
    printBtn.addEventListener('click', printReport);
}

const filter = async (page) => {
    const search = document.getElementById('search');
    const category = document.getElementById('category');
    const brand = document.getElementById('brand');
    const color = document.getElementById('color');
    const size = document.getElementById('size');
    const from = document.getElementById('priceFrom');
    const to = document.getElementById('priceTo');

    const form = new FormData();

    form.append('search', search.value);
    form.append('category', category.value);
    form.append('brand', brand.value);
    form.append('color', color.value);
    form.append('size', size.value);
    form.append('from', from.value);
    form.append('to', to.value);
    form.append('page', page.value);

    const direction = '/Online-Store/pages/user/filterProductProcess.php';
    const method = 'POST';
    const isAsync = true;
    try {
        const respostext = await formSubmitHandler(form, direction, method, isAsync);
        document.getElementById('content').innerHTML = respostext;
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const profileImageUpload = async () => {
    const profileImg = document.getElementById('profileImg');

    const form = new FormData();
    form.append('profileImg', profileImg.files[0]);

    const direction = '/Online-Store/pages/user/updateProfileImgProcess.php';
    const method = 'POST';
    const isAsync = true;
    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() == 'success') {
            alert('Profile image uploaded successfully.');
            window.location.reload();
        } else {
            alert(`Failed to upload profile image: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (profPicUploadBtn) {
    profPicUploadBtn.addEventListener('click', profileImageUpload);
}

const updateProfileDetails = async () => {
    const fname = document.getElementById('fname');
    const lname = document.getElementById('lname');
    const mobile = document.getElementById('mobile');

    const addNo = document.getElementById('addNo');
    const addLine1 = document.getElementById('addLine1');
    const addLine2 = document.getElementById('addLine2');
    const addCity = document.getElementById('addCity');
    const addPCode = document.getElementById('addPCode');

    const form = new FormData();

    form.append('fname', fname.value);
    form.append('lname', lname.value);
    form.append('mobile', mobile.value);
    form.append('addNo', addNo.value);
    form.append('addLine1', addLine1.value);
    form.append('addLine2', addLine2.value);
    form.append('addCity', addCity.value);
    form.append('addPCode', addPCode.value);

    const direction = '/Online-Store/pages/user/updateProfileDetailsProcess.php';
    const method = 'POST';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(form, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Profile Details Updated successfully.');
            window.location.reload();
        } else {
            alert(`Failed to update profile details: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const addToCart = async (stockId) => {
    const cartQty = document.getElementById('cartQty').value;

    const direction = `/Online-Store/pages/user/addToCartProcess.php?stock=${stockId}&qty=${cartQty}`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(null, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Product added into cart successfully.');
            window.location.reload();
        } else {
            alert(`Failed to add product into cart: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

if (addToCatrBtn) {
    const stockId = document.body.dataset.stockId;
    addToCatrBtn.addEventListener('click', () => addToCart(stockId));
}

const removeFromCart = async (cartId) => {

    const direction = `/Online-Store/pages/user/deleteCartItemProcess.php?cartId=${cartId}`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(null, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            alert('Cart item deleted successfully.');
            loadCart();
        } else {
            alert(`Failed to delete cart item: ${responseText}`);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const cartQtyChange = async (cartId, status) => {
    const direction = `/Online-Store/pages/user/updateCartQtyProcess.php?cartId=${cartId}&status=${status}`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await formSubmitHandler(null, direction, method, isAsync);
        if (responseText.trim() === 'success') {
            loadCart();
        } else {
            alert(responseText);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

const checkout = async () => {
    const form = new FormData();
    form.append('cart', true);

    const direction = `/Online-Store/pages/user/paymentProcess.php`;
    const method = 'POST';
    const isAsync = true;

    try {
        const jsonResponseText = await formSubmitHandler(form, direction, method, isAsync);
        const responseText = JSON.parse(jsonResponseText);

        if (responseText.status === 'success') {
            doCheckout(responseText.payment, "checkoutProcess.php");
        } else {
            alert(responseText.error);
        }
    } catch (error) {
        alert(`Error: ${error}`);
    }
}

document.addEventListener('click', (e) => {
    if (e.target && e.target.id === 'checkoutBtn') {
        checkout();
    }
});

const doCheckout = (payment, url) => {
    // Payment completed. It can be a successful failure.
    payhere.onCompleted = async function onCompleted(orderId) {
        alert("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer

        const form = new FormData();
        form.append('payment', JSON.stringify(payment));

        const direction = url;
        const method = 'POST';
        const isAsync = true;

        try {
            const jsonResponseText = await formSubmitHandler(form, direction, method, isAsync);
            const responseText = JSON.parse(jsonResponseText);
            if (responseText.status === 'success') {
                console.log(responseText);
                window.location.href = `invoice.php?orderHistoryId=${responseText.orderHistoryId}`;
            } else {
                console.log(`Failed to checkout products: ${responseText.error}`);
            }
        } catch (error) {
            alert(`Error: ${error}`);
        }

    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        alert("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        alert("Error:" + error);
    };

    payhere.startPayment(payment);
}

const buyNow = async (stockId) => {
    const cartQty = document.getElementById('cartQty').value;
    if (cartQty > 0) {
        const form = new FormData();

        form.append('cart', false);
        form.append('cartQty', cartQty);
        form.append('stockId', stockId);

        const direction = 'paymentProcess.php';
        const method = 'POST';
        const isAsync = true;

        try {
            const jsonResponseText = await formSubmitHandler(form, direction, method, isAsync);
            const responseText = JSON.parse(jsonResponseText);

            if (responseText.status === 'success') {

                responseText.payment.stock_id = stockId;
                responseText.payment.qty = cartQty;

                doCheckout(responseText.payment, "buyNowProcess.php");
            } else {
                alert(responseText.error);
            }
        } catch (error) {
            console.log(`Error: ${error}`);
        }

    } else {
        alert('Quentity cannot be less that 1');
    }
    console.log(stockId + " | " + cartQty.value);
}

if (buyNowBtn) {
    const stockId = document.body.dataset.stockId;
    buyNowBtn.addEventListener('click', () => buyNow(stockId));
}