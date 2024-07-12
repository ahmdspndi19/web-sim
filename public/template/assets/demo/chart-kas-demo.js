document.addEventListener("DOMContentLoaded", function () {
    fetch("{{ route('chart.data') }}")
        .then((response) => response.json())
        .then((data) => {
            // Fungsi untuk mengonversi angka bulan menjadi nama bulan
            function getMonthName(monthNumber) {
                const monthNames = [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ];
                return monthNames[monthNumber - 1];
            }

            // Mengolah data bulanan
            const monthlyLabels = [];
            const monthlyIncome = [];
            const monthlyExpense = [];

            for (const [year, months] of Object.entries(data.monthly)) {
                for (const [month, types] of Object.entries(months)) {
                    monthlyLabels.push(
                        getMonthName(parseInt(month)) + " " + year
                    );
                    monthlyIncome.push(
                        types.Pemasukan ? types.Pemasukan[0].total : 0
                    );
                    monthlyExpense.push(
                        types.Pengeluaran ? types.Pengeluaran[0].total : 0
                    );
                }
            }

            // Mengolah data mingguan
            const weeklyLabels = [];
            const weeklyIncome = [];
            const weeklyExpense = [];

            for (const [year, weeks] of Object.entries(data.weekly)) {
                for (const [week, types] of Object.entries(weeks)) {
                    weeklyLabels.push(`Week ${week} ${year}`);
                    weeklyIncome.push(
                        types.Pemasukan ? types.Pemasukan[0].total : 0
                    );
                    weeklyExpense.push(
                        types.Pengeluaran ? types.Pengeluaran[0].total : 0
                    );
                }
            }

            // Monthly Bar Chart
            new Chart(document.getElementById("monthlyBarChart"), {
                type: "bar",
                data: {
                    labels: monthlyLabels,
                    datasets: [
                        {
                            label: "Pemasukan",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: monthlyIncome,
                        },
                        {
                            label: "Pengeluaran",
                            backgroundColor: "rgba(217,83,79,1)",
                            borderColor: "rgba(217,83,79,1)",
                            data: monthlyExpense,
                        },
                    ],
                },
                options: {
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                maxTicksLimit: 6,
                            },
                        },
                        y: {
                            min: 0,
                            maxTicksLimit: 5,
                            grid: {
                                display: true,
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            display: true,
                        },
                    },
                },
            });

            // Weekly Bar Chart
            new Chart(document.getElementById("weeklyBarChart"), {
                type: "bar",
                data: {
                    labels: weeklyLabels,
                    datasets: [
                        {
                            label: "Pemasukan",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: weeklyIncome,
                        },
                        {
                            label: "Pengeluaran",
                            backgroundColor: "rgba(217,83,79,1)",
                            borderColor: "rgba(217,83,79,1)",
                            data: weeklyExpense,
                        },
                    ],
                },
                options: {
                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                maxTicksLimit: 6,
                            },
                        },
                        y: {
                            min: 0,
                            maxTicksLimit: 5,
                            grid: {
                                display: true,
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            display: true,
                        },
                    },
                },
            });
        });
});
