import { Chart } from 'chart.js/auto';
window.Chart = Chart;

// Get the current year
const now = new Date();
const year = now.getFullYear();
// Months names
const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
// Total info
let totalOrders = 0;
let amountOfMoney = 0;
// Number of orders for each month
let ordersNumber = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
// Money gained each month
let moneyGained = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
// Find the order creation month
function findOrderCreationMonth(order) {
    const date = new Date(order.created_at);
    const month = date.getMonth();
    return month;
}

// The script should be triggered at DOMContentLoaded
document.addEventListener('DOMContentLoaded', function () {

    // Foreach order increase the corresponding number into the given array
    orders.forEach(order => {
        const month = findOrderCreationMonth(order);
        ordersNumber[month] += 1;
        totalOrders += 1;
    });

    orders.forEach(order => {
        const month = findOrderCreationMonth(order);
        const money = Number(order.total_price);
        moneyGained[month] += money;
        amountOfMoney += money;
    });

    // Set info into the DOM
    const currentYearDiv = document.getElementById('current-year');
    currentYearDiv.append(' ' + year);

    const totalOrdersDiv = document.getElementById('total-orders');
    totalOrdersDiv.append(' ' + totalOrders);

    const amountOfMoneyDiv = document.getElementById('amount-of-money');
    amountOfMoneyDiv.append(' ' + amountOfMoney + ' ' + '€');

    // Create the required charts
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

    const totalMoney = document.getElementById('this-year-money');
    const moneyChart = new Chart(totalMoney, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Fatturato',
                data: moneyGained,
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1,
            }]
        }
    });
}, true);