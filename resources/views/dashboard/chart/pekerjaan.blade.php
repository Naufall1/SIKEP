    <div class="tw-flex {{(Auth::user()->hasLevel['level_kode'] == 'RW') ? 'tw-justify-between' : ''}}">
        <x-input.select class="tw-w-56" id="chartType" onchange="dropdownChartData()">
            <option value="pekerjaan">Pekerjaan</option>
            <option value="jenis_kelamin">Jenis Kelamin</option>
        </x-input.select>
        @if (Auth::user()->hasLevel['level_kode'] == 'RW')
            <x-input.select class="tw-w-28" id="rt">
                <option value="all">Semua</option>
            </x-input.select>
        @endif
        {{-- <label for="chartType">pilih chart:</label>
        <select id="chartType" onchange="dropdownChartPekerjaan()">
            <option value="pie">Pie Chart</option>
            <option value="bar">Bar Chart</option>
        </select> --}}
    </div>

    <div id="pieChartContainer" class="tw-flex tw-grow">
        <canvas id="chartPekerjaanPie" class="tw-w-full tw-flex tw-h-full"></canvas>
    </div>

    {{-- <div id="barChartContainer" style="width: 500px; float: left; display: none;">
        <canvas id="chartPekerjaanBar" width="400" height="400"></canvas>
    </div> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
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

    function dropdownChartData() {
        var selectedChart = document.getElementById('chartData').value;

        if (selectedChart === 'pie') {
            pieChart();
        } else if (selectedChart === 'bar') {
            barChart();
        }
    }
</script>


{{-- <div style="max-width: 80px;">
    <div style="width: 400px; float: left;">
        <canvas id="chartPekerjaanPie" width="400" height="400"></canvas>
    </div>

    <div style="max-width: 800px; overflow-x: auto;">
        <!-- Bar Chart -->
        <canvas id="chartPekerjaanBar" width="800" height="400"></canvas>
    </div>
</div> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctxPie = document.getElementById('chartPekerjaanPie').getContext('2d');
        // var ctxBar = document.getElementById('chartPekerjaanBar').getContext('2d');

        var dataPekerjaan = @json($dataPekerjaan);

        var jenisPekerjaan = dataPekerjaan.map(function(item) {
            return item.jenis_pekerjaan;
        });

        var jmlWarga = dataPekerjaan.map(function(item) {
            return item.total;
        });

        // gpt warna random
        var backgroundColors = ['#E5F1FF', '#CCE4FF', '#A8D1FF', '#56A6FF', '#2C90FF', '#0284FF', '#025CC0', '#01448E', '#013065', '#01244C', '#001833'];

        var borderColors = ['#E5F1FF', '#CCE4FF', '#A8D1FF', '#56A6FF', '#2C90FF', '#0284FF', '#025CC0', '#01448E', '#013065', '#01244C', '#001833']
        // var borderColors = dataPekerjaan.map(function() {
        //     return 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) +
        //         ',' + Math.floor(Math.random() * 256) + ', 1)';
        // });

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
                    borderWidth: 1.5
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: false,
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
