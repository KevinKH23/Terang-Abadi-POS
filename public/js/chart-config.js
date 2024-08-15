$(document).ready(function () {
    var a = document.getElementById("salesPurchasesChart");
    $.get("/sales-purchases/chart-data", function (e) {
        new Chart(a, {
            type: "bar",
            data: {
                labels: e.sales.original.days,
                datasets: [
                    {
                        label: "Penjualan",
                        data: e.sales.original.data,
                        backgroundColor: ["#6366F1"],
                        borderColor: ["#6366F1"],
                        borderWidth: 1,
                    },
                    {
                        label: "Pembelian",
                        data: e.purchases.original.data,
                        backgroundColor: ["#A5B4FC"],
                        borderColor: ["#A5B4FC"],
                        borderWidth: 1,
                    },
                ],
            },
            options: { scales: { y: { beginAtZero: !0 } } },
        });
    });
    var e = document.getElementById("currentMonthChart");
    $.get("/current-month/chart-data", function (a) {
        new Chart(e, {
            type: "doughnut",
            data: {
                labels: ["Penjualan", "Pembelian"],
                datasets: [
                    {
                        data: [a.sales, a.purchases],
                        backgroundColor: ["#F59E0B", "#0284C7"],
                        hoverBackgroundColor: ["#F59E0B", "#0284C7"],
                    },
                ],
            },
        });
    });
    var t = document.getElementById("paymentChart");
    $.get("/payment-flow/chart-data", function (a) {
        console.log(a),
            new Chart(t, {
                type: "line",
                data: {
                    labels: a.months,
                    datasets: [
                        {
                            label: "Payment Sent",
                            data: a.payment_sent,
                            fill: !1,
                            borderColor: "#EA580C",
                            tension: 0,
                        },
                        {
                            label: "Payment Received",
                            data: a.payment_received,
                            fill: !1,
                            borderColor: "#2563EB",
                            tension: 0,
                        },
                    ],
                },
            });
    });
});
