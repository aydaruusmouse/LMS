const charts = JSON.parse(document.getElementById('chart_data').value);

const chartItem1 = document.getElementById('statisticsChart1');
if (chartItem1) {
    var context = chartItem1.getContext('2d');
    var gradientBGColor = context.createLinearGradient(0, 0, 0, 200);
    gradientBGColor.addColorStop(0.1, '#24D6AC60');
    gradientBGColor.addColorStop(0.4, '#ffffff30');

    const chart1 = new Chart(chartItem1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Des'],
            datasets: [{
                label: 'Total Sales',
                backgroundColor: gradientBGColor,
                borderColor: '#24D6A5',
                data: charts.enrolment,
                fill: true
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    borderWidth: 2,
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    })
}
// End statisticsChart1



const chartItem2 = document.getElementById('statisticsChart2');
if (chartItem2) {
    var context = chartItem2.getContext('2d');
    var gradientBGColor = context.createLinearGradient(0, 0, 0, 200);
    gradientBGColor.addColorStop(0.1, '#ffa60050');
    gradientBGColor.addColorStop(0.4, '#ffffff50');

    const chart2 = new Chart(chartItem2, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Des'],
            datasets: [{
                label: 'Total Earning',
                backgroundColor: gradientBGColor,
                borderColor: '#ffa600',
                data: charts.earning,
                fill: true
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    borderWidth: 2,
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    })
}




const chartItem3 = document.getElementById('statisticsChart3');
if (chartItem3) {
    var context = chartItem3.getContext('2d');
    var gradientBGColor = context.createLinearGradient(0, 0, 0, 200);
    gradientBGColor.addColorStop(0.1, '#ff563050');
    gradientBGColor.addColorStop(0.4, '#ffffff30');

    const chart3 = new Chart(chartItem3, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Des'],
            datasets: [{
                label: 'Total Cost',
                backgroundColor: gradientBGColor,
                borderColor: '#ff5630',
                data: charts.organization,
                fill: true
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    borderWidth: 2,
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    })
}
// End statisticsChart3


const chartItem4 = document.getElementById('statisticsChart4');
if (chartItem4) {
    var context = chartItem4.getContext('2d');
    var gradientBGColor = context.createLinearGradient(0, 0, 0, 200);
    gradientBGColor.addColorStop(0.1, '#3F52E350');
    gradientBGColor.addColorStop(0.4, '#ffffff30');

    const chart4 = new Chart(chartItem4, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Des'],
            datasets: [{
                label: 'Total Investment',
                backgroundColor: gradientBGColor,
                borderColor: '#3F52E3',
                data: charts.course,
                fill: true
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    borderWidth: 2,
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    })
}
// End statisticsChart4







var statisticsItem = document.getElementById("statisticsBarChart");
if (statisticsItem) {
    var earningChartBar = new Chart(statisticsItem, {
        type: 'bar',
        data: {
            labels: charts.advance.labels,
            datasets: [{
                label: 'Total Student',
                data: charts.advance.student,
                fill: false,
                borderColor: '#3F52E3',
                backgroundColor: '#3F52E3',
                borderWidth: 1,
                barThickness: 5,
                borderRadius: 5,
            },
            {
                label: 'Total Course',
                data: charts.advance.course,
                fill: false,
                borderColor: '#24D6A5',
                backgroundColor: '#24D6A5',
                borderWidth: 1,
                barThickness: 5,
                borderRadius: 5,
            },
            {
                label: 'Total Earning',
                data: charts.advance.earning,
                fill: false,
                borderColor: '#FF5630',
                backgroundColor: '#FF5630',
                borderWidth: 1,
                barThickness: 5,
                borderRadius: 5,
            }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true,
                    border: {
                        display: false
                    },
                    grid: {
                        drawBorder: false,
                        borderDash: [0, 0],
                        lineWidth: 0
                    }
                },
                y: {
                    stacked: true,
                    grid: {
                        drawBorder: false,
                        borderDash: [5, 5],
                    }
                }
            },
            plugins: {
                legend: {
                    align: 'start',
                    position: 'right',
                    labels: {
                        boxWidth: 7,
                        boxHeight: 7,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            }
        }
    });
}
// Statistics Bar




const chartItem5 = document.getElementById('statisticsChart5');
if (chartItem5) {
    const chart5 = new Chart(chartItem5, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [
                {
                    label: 'Total Investment',
                    backgroundColor: 'transparent',
                    borderColor: '#24D6A5',
                    data: charts.instructor,
                    fill: false
                }
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    borderWidth: 2,
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    })
}
// End statisticsChart5



const chartItem6 = document.getElementById('statisticsChart6');
if (chartItem6) {
    const chart6 = new Chart(chartItem6, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [
                {
                    label: 'Total Student',
                    backgroundColor: 'transparent',
                    borderColor: '#ff5630',
                    data: charts.student,
                    fill: false
                }
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    borderWidth: 2,
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    })
}
// End statisticsChart6
