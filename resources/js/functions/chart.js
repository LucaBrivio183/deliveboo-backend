import { Chart } from 'chart.js/auto';
window.Chart = Chart;

console.log(orders);
// Months names
const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
// Number of orders for each month
let ordersNumber = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

// The script should be triggered at DOMContentLoaded
document.addEventListener('DOMContentLoaded', function () {

    // For each order find the creation month
    // and then increase the corresponding number into the given array
    orders.forEach(order => {
        const date = new Date(order.created_at);
        const month = date.getMonth();
        ordersNumber[month] += 1;
    });

    const yearOrders = document.getElementById('this-year-orders');
    const ordersChart = new Chart(yearOrders, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Ordini ricevuti',
                data: ordersNumber,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }]
        }
    });
}, true);