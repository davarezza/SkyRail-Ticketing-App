$.getJSON('/dashboard/revenue-data')
    .then(data => {
        var revenueNumbers = data.revenues.map(value => parseInt(value.replace(/\./g, '')) || 0);

        var optionsRevenue = {
            chart: {
                type: 'line',
                height: 300
            },
            series: [{
                name: 'Revenue (IDR)',
                data: revenueNumbers
            }],
            xaxis: {
                categories: data.months
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "IDR " + val.toLocaleString("id-ID");
                    }
                }
            }
        };

        new ApexCharts(document.querySelector("#revenueChart"), optionsRevenue).render();
    })
    .fail(error => console.error("Error fetching revenue data:", error));

$.getJSON('/dashboard/ticket-sales')
    .then(data => {
        const formattedTickets = data.tickets.map(value => Math.floor(value));

        var optionsTicketSales = {
            chart: {
                type: 'bar',
                height: 300
            },
            series: [{
                name: 'Tickets Sold',
                data: formattedTickets
            }],
            xaxis: {
                categories: data.routes
            }
        };

        new ApexCharts(document.querySelector("#ticketSalesChart"), optionsTicketSales).render();
    })
    .fail(error => console.error("Error fetching ticket sales data:", error));

$.getJSON('/dashboard/ticket-class')
    .then(data => {
        var optionsTicketClass = {
            chart: {
                type: 'pie',
                height: 300
            },
            series: data.tickets,
            labels: data.classes,
            colors: ['#28a745', '#ffc107', '#dc3545']
        };

        new ApexCharts(document.querySelector("#ticketClassChart"), optionsTicketClass).render();
    })
    .fail(error => console.error("Error fetching ticket class data:", error));

$.getJSON('/dashboard/passenger-age')
    .then(data => {
        var optionsPassengerAge = {
            chart: {
                type: 'donut',
                height: 300
            },
            series: data.counts,
            labels: data.types,
            colors: ['#007bff', '#17a2b8', '#6c757d']
        };

        new ApexCharts(document.querySelector("#passengerAgeChart"), optionsPassengerAge).render();
    })
    .fail(error => console.error("Error fetching passenger age data:", error));
