import Chart from 'chart.js/auto';

let chart_views = document.getElementById('chart-views')
let chart_message = document.getElementById('chart-message')



const data_month_views = [];

const data_month_messages = [];

const labels_views = []

const labels_messages = []




if (total_month_messages) {
    for (let i = 0; i < total_month_messages.length; i++) {

        data_month_messages.push(total_month_messages[i]['messages'])
        console.log(data_month_messages);
        labels_messages.push(total_month_messages[i]['month'].toString().padStart(2, '0') + '/' + total_month_messages[i]['year'])
    }
    console.log('mese', data_month_messages);



    new Chart(chart_message, {
        type: 'line',
        data: {
            labels: labels_messages,
            datasets: [
                {
                    label: 'Messaggi per mese',
                    data: data_month_messages,
                    borderWidth: 1,
                    tension: 0.4,
                    fill: false,
                    borderColor: "#FF385C",
                    backgroundColor: "#FF385C",
                },

            ]
        },
        options: {
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Messaggi',
                    },
                    beginAtZero: true,
                    min: 0,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
}


if (total_month_views) {
    for (let i = 0; i < total_month_views.length; i++) {
        data_month_views.push(total_month_views[i]['views'])
        labels_views.push(total_month_views[i]['month'].toString().padStart(2, '0') + '/' + total_month_views[i]['year'])
    }
    console.log('mese', total_month_views);

    new Chart(chart_views, {
        type: 'line',
        data: {
            labels: labels_views,
            datasets: [
                {
                    label: 'Visualizzazioni mensili',
                    data: data_month_views,
                    borderWidth: 1,
                    tension: 0.4,
                    fill: false,
                    borderColor: "#FF385C",
                    backgroundColor: "#FF385C",
                },

            ]
        },
        options: {
            scales: {

                y: {
                    title: {
                        display: true,
                        text: 'Visualizzazioni  ',
                    },
                    beginAtZero: true
                }
            }
        }
    });

}

if (total_month_messages) {
    for (let i = 0; i < total_month_messages.length; i++) {

        data_month_messages.push(total_month_messages[i]['messages'])
        console.log(data_month_messages);
        labels_messages.push(total_month_messages[i]['month'].toString().padStart(2, '0') + '/' + total_month_messages[i]['year'])
    }
    console.log('mese', data_month_messages);



    new Chart(chart_message, {
        type: 'line',
        data: {
            labels: labels_messages,
            datasets: [
                {
                    label: 'Messaggi per mese',
                    data: data_month_messages,
                    borderWidth: 1,
                    tension: 0.4,
                    fill: false,
                    borderColor: "#FF385C",
                    backgroundColor: "#FF385C",
                },

            ]
        },
        options: {
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Messaggi',
                    },
                    beginAtZero: true,
                    min: 0,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
}








/* const data_year_views = []; 

const data_year_messages = [];*/
/* if (total_year_views) {
    for (let i = 0; i < total_year_views.length; i++) {
        data_year_views.push(total_year_views[i]['views']) ['views']
         data_year_views.push(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3) 
    }
    console.log('anno', data_year_views);
} */

/* 
if (total_year_messages) {
    for (let i = 0; i < total_year_messages.length; i++) {
        data_year_messages.push(total_year_messages[i])
    }
    console.log('anno', data_year_messages);
} */