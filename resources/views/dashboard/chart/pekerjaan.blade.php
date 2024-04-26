
<div style="max-width: 800px;">
    <div>
        <label for="chartType">pilih chart:</label>
        <select id="chartType" onchange="dropdownChart()">
            <option value="pie">Pie Chart</option>
            <option value="bar">Bar Chart</option>
        </select>
    </div>

    <div id="pieChartContainer" style="width: 500px; float: left;">
        <canvas id="chartPekerjaanPie" width="400" height="400"></canvas>
    </div>

    <div id="barChartContainer" style="width: 500px; float: left; display: none;">
        <canvas id="chartPekerjaanBar" width="400" height="400"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        pieChart();

    });

    function pieChart() {
        document.getElementById('pieChartContainer').style.display = 'block';
        document.getElementById('barChartContainer').style.display = 'none';
    }

    function barChart() {
        document.getElementById('pieChartContainer').style.display = 'none';
        document.getElementById('barChartContainer').style.display = 'block';
    }

    function dropdownChart() {
        var selectedChart = document.getElementById('chartType').value;

        if (selectedChart === 'pie') {
            pieChart();
        } else if (selectedChart === 'bar') {
            barChart();
        }
    }
</script>


<div style="max-width: 80px;">
    <div style="width: 400px; float: left;">
        <canvas id="chartPekerjaanPie" width="400" height="400"></canvas>
    </div>

    <div style="max-width: 800px; overflow-x: auto;">
        <!-- Bar Chart -->
        <canvas id="chartPekerjaanBar" width="800" height="400"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctxPie = document.getElementById('chartPekerjaanPie').getContext('2d');
        var ctxBar = document.getElementById('chartPekerjaanBar').getContext('2d');

        var dataPekerjaan = @json($dataPekerjaan);

        var jenisPekerjaan = dataPekerjaan.map(function(item) {
            return item.jenis_pekerjaan;
        });

        var jmlWarga = dataPekerjaan.map(function(item) {
            return item.total;
        });

        // gpt warna random
        var backgroundColors = dataPekerjaan.map(function() {
            return 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.2)';
        });

        var borderColors = dataPekerjaan.map(function() {
            return 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 1)';
        });

        // ajax pie chart
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: jenisPekerjaan,
                datasets: [{
                    label: 'Jumlah Warga',
                    data: jmlWarga,
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
                        text: 'Warga yang bekerja Piechart'
                    }
                }
            }
        });

        // ajax bar chart
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: jenisPekerjaan,
                datasets: [{
                    label: 'Jumlah Warga',
                    data: jmlWarga,
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
                        text: 'Warga yang bekerja Barchart',
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
