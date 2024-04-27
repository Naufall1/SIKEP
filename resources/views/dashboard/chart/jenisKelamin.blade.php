<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Jenis Kelamin</title>
    <!-- Sertakan library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="max-width: 800px;">
        <!-- Pilihan Chart -->
        <div>
            <label for="chartType">Pilih chart:</label>
            <select id="chartType" onchange="dropdownChart()">
                <option value="pie">Pie Chart</option>
                <option value="bar">Bar Chart</option>
            </select>
        </div>

        <!-- Container untuk Pie Chart -->
        <div id="pieChartContainerKelamin" style="width: 400px; float: left;">
            <canvas id="chartJenisKelaminPie" width="400" height="400"></canvas>
        </div>

        <!-- Container untuk Bar Chart -->
        <div id="barChartContainerKelamin" style="width: 800px; float: left; display: none;">
            <canvas id="chartJenisKelaminBar" width="800" height="400"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            jenisKelaminPieChart();
        });

        function jenisKelaminPieChart() {
            document.getElementById('pieChartContainerKelamin').style.display = 'block';
            document.getElementById('barChartContainerKelamin').style.display = 'none';
        }

        function jenisKelaminBarChart() {
            document.getElementById('pieChartContainerKelamin').style.display = 'none';
            document.getElementById('barChartContainerKelamin').style.display = 'block';
        }

        function dropdownChart() {
            var selectedChart = document.getElementById('chartType').value;

            if (selectedChart === 'pie') {
                jenisKelaminPieChart();
            } else if (selectedChart === 'bar') {
                jenisKelaminBarChart();
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctxPie = document.getElementById('chartJenisKelaminPie').getContext('2d');
            var ctxBar = document.getElementById('chartJenisKelaminBar').getContext('2d');


            var dataJenisKelamin = @json($dataJenisKelamin);

            var jenisKelamin = dataJenisKelamin.map(function(item) {
                 return item.jenis_kelamin;
            });

            var jumlah = dataJenisKelamin.map(function(item) {
                return item.jumlah;
            });

            var backgroundColors = jenisKelamin.map(function() {
                return 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.2)';
            });

            var borderColors = jenisKelamin.map(function() {
                return 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 1)';
            });

            // Ajax pie chart
            var pieChartKelamin = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: jenisKelamin,
                    datasets: [{
                        label: 'Jumlah Warga',
                        data: jumlah,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Warga Berdasarkan Jenis Kelamin (Pie Chart)'
                        }
                    }
                }
            });

            // Ajax bar chart
            var barChartKelamin = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: jenisKelamin,
                    datasets: [{
                        label: 'Jumlah Warga',
                        data: jumlah,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Jumlah Warga Berdasarkan Jenis Kelamin (Bar Chart)'
                        },
                        zoom: {
                            pan: {
                                enabled: true,
                                mode: 'x',
                                speed: 10,
                                threshold: 10
                            },
                            zoom: {
                                wheel: {
                                    enabled: true,
                                },
                                pinch: {
                                    enabled: true
                                },
                                mode: 'x',
                                speed: 0.1,
                                threshold: 2
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
