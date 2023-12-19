import Chart from 'chart.js/auto';

let chart_views = document.getElementById('chart-views')

const data_month_views = [];
const data_month_messages = [];
const labels = [];

let stop = false;

const splitStartDate = start_date.split('-');
const splitEndDate = end_date.split('-');

const objEndDate = {
    year: Number(splitEndDate[0]),
    month: Number(splitEndDate[1])
}

const tempDate = {
    year: Number(splitStartDate[0]),
    month: Number(splitStartDate[1])
}

const dataList = [];

while (!stop && tempDate.year <= objEndDate.year) {

    console.log(tempDate);

    if (tempDate.year !== objEndDate.year) {
        dataList.push({
            year: Number(tempDate.year),
            month: Number(tempDate.month),
            views: 0,
            messages: 0
        });

        total_month_views.forEach(view => {
            if ((view.year === tempDate.year) && (view.month === tempDate.month)) {
                dataList[dataList.length - 1].views = view.views
            }
        });

        total_month_messages.forEach(message => {
            if ((message.year === tempDate.year) && (message.month === tempDate.month)) {
                dataList[dataList.length - 1].messages = message.messages
            }
        });

        if (tempDate.month < 12) {
            tempDate.month++;
        } else {
            tempDate.month = 1;
            tempDate.year++;
        }
    } else {
        if (tempDate.month <= objEndDate.month) {

            dataList.push({
                year: Number(tempDate.year),
                month: Number(tempDate.month),
                views: 0,
                messages: 0
            });

            total_month_views.forEach(view => {
                if ((view.year === tempDate.year) && (view.month === tempDate.month)) {
                    dataList[dataList.length - 1].views = view.views
                }
            });

            total_month_messages.forEach(message => {
                if ((message.year === tempDate.year) && (message.month === tempDate.month)) {
                    dataList[dataList.length - 1].messages = message.messages
                }
            });

            if (tempDate.month < 12) {
                tempDate.month++;
            } else {
                tempDate.month = 1;
                tempDate.year++;
            }
        } else {
            stop = true;
        }
    }
}

dataList.forEach(data => {
    data_month_views.push(data.views)
    data_month_messages.push(data.messages)
    labels.push(data.month.toString().padStart(2, '0') + '/' + data.year)
});

new Chart(chart_views, {
    type: 'line',
    data: {
        labels: labels,
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
            {
                label: 'Messaggi mensili',
                data: data_month_messages,
                borderWidth: 1,
                tension: 0.4,
                fill: false,
                borderColor: "#0000FF",
                backgroundColor: "#0000FF",
            },
        ]
    },
    options: {
        scales: {
            y: {
                title: {
                    display: true,
                    text: 'Visualizzazioni / Messaggi',
                },
                beginAtZero: false,
                precision: 0,
            }
        }
    }
});

document.querySelector('#charts_filters').addEventListener('submit', function (e) {
    e.preventDefault();

    let error = '';
    const form_start_date = new Date(document.querySelector('#start_date').value);
    const form_end_date = new Date(document.querySelector('#end_date').value);

    if (form_start_date > form_end_date) {
        console.log('error');
        error = "L'intervallo tra le date non e' corretto."
        document.querySelector('#error').innerHTML = error;
        return false;
    }
    console.log('no error');

    this.submit();
});