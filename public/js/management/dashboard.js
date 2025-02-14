var optionsRevenue = {
    chart: {
        type: 'line',
        height: 300
    },
    series: [{
        name: 'Revenue ($)',
        data: [85000, 92000, 110000, 95000, 120000, 125000, 140000, 130000, 150000, 160000, 175000, 180000]
    }],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    }
};
new ApexCharts(document.querySelector("#revenueChart"), optionsRevenue).render();

var optionsTicketSales = {
    chart: {
        type: 'bar',
        height: 300
    },
    series: [{
        name: 'Tickets Sold',
        data: [2350, 1800, 1500, 1200, 900]
    }],
    xaxis: {
        categories: ['Jakarta - Bali', 'Jakarta - Surabaya', 'Jakarta - Medan', 'Jakarta - Makassar', 'Jakarta - Yogyakarta']
    }
};
new ApexCharts(document.querySelector("#ticketSalesChart"), optionsTicketSales).render();

var optionsTicketClass = {
    chart: {
        type: 'pie',
        height: 300
    },
    series: [55, 30, 15],
    labels: ['Economy', 'Business', 'First Class'],
    colors: ['#28a745', '#ffc107', '#dc3545']
};
new ApexCharts(document.querySelector("#ticketClassChart"), optionsTicketClass).render();

var optionsPassengerAge = {
    chart: {
        type: 'donut',
        height: 300
    },
    series: [70, 20, 10],
    labels: ['Adult', 'Child', 'Infant'],
    colors: ['#007bff', '#17a2b8', '#6c757d']
};
new ApexCharts(document.querySelector("#passengerAgeChart"), optionsPassengerAge).render();