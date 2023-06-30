import { Chart } from 'chart.js/auto';
window.Chart = Chart;

// Months names
const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

// The script should be triggered at DOMContentLoaded
document.addEventListener('DOMContentLoaded', function () {

    // Get current date and month
    const date = new Date();
    let month = months[date.getMonth()];

    const yearOrders = document.getElementById('this-year-orders');
    const ordersChart = new Chart(yearOrders, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Ordini ricevuti',
                data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }]
        }
    });
}, true);