import { loadChart } from "./dashboad.js"; 

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