import Chart from 'chart.js';

fetch('/stats')
    .then(response => response.json())
    .then(data => {
        const bacData = data.bacs.map(({ type, count }) => ({ label: type, data: count }));
        const dechetData = data.dechets.map(({ type, count }) => ({ label: type, data: count }));

        const bacChart = new Chart(document.getElementById('bac-chart'), {
            type: 'pie',
            data: {
                labels: bacData.map(d => d.label),
                datasets: [{
                    data: bacData.map(d => d.data),
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                    ],
                }],
            },
        });

        const dechetChart = new Chart(document.getElementById('dechet-chart'), {
            type: 'pie',
            data: {
                labels: dechetData.map(d => d.label),
                datasets: [{
                    data: dechetData.map(d => d.data),
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                    ],
                }],
            },
        });
    });