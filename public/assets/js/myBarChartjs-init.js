            const barChart_1 = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(barChart_1, {

                type: 'bar',
                data: {
                    defaultFontFamily: 'Poppins',
                    labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь",
                        "Октябрь", "Ноябрь", "Декабрь"
                    ],
                    datasets: [{
                        label: "Отработано часов",
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        borderColor: 'rgba(19, 98, 252, 1)',
                        borderWidth: "0",
                        backgroundColor: 'rgba(19, 98, 252, 1)'
                    }]
                },
                options: {
                    legend: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            // Change here
                            barPercentage: 0.5
                        }]
                    }
                }
            });