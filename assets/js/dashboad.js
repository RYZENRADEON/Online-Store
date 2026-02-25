import { httpRequest } from "./utils.js";

export const loadChart = async () => {
    const ctx = document.getElementById('chart1');

    const direction = `/Online-Store/pages/admin/loadChartProcess.php`;
    const method = 'GET';
    const isAsync = true;

    try {
        const responseText = await httpRequest(null, direction, method, isAsync);
        const json = JSON.parse(responseText);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: json.labels,
                datasets: [{
                    label: '# of Quentity',
                    data: json.data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    } catch (error) {
        console.log(`Error: ${error}`);
    }
}

// window.onload = () => {
//     if (document.body.id === 'adminDashboard') {
//         loadChart();
//     }
// };