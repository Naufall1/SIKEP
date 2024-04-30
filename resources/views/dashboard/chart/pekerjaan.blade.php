    <div class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RW' ? 'tw-justify-between' : '' }}">
        <div class="tw-w-56">
            <x-input.select id="chartType" onchange="dropdownChartData()">
                <option value="pekerjaan">Pekerjaan</option>
                <option value="jenis_kelamin">Jenis Kelamin</option>
            </x-input.select>
        </div>
        @if (Auth::user()->hasLevel['level_kode'] == 'RW')
        <div class="tw-w-28">
            <x-input.select class="tw-w-28" id="rt">
                <option value="all">Semua</option>
            </x-input.select>
        </div>
        @endif
        {{-- <label for="chartType">pilih chart:</label>
        <select id="chartType" onchange="dropdownChartPekerjaan()">
            <option value="pie">Pie Chart</option>
            <option value="bar">Bar Chart</option>
        </select> --}}
    </div>

    <div id="pieChartContainer" class="tw-flex tw-w-full">
        <canvas height="224" id="chartPekerjaanPie" style="width: 100%;" class=" tw-flex"></canvas>
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
            var backgroundColors = ['#E5F1FF', '#CCE4FF', '#A8D1FF', '#56A6FF', '#2C90FF', '#0284FF', '#025CC0',
                '#01448E', '#013065', '#01244C', '#001833'
            ];

            var borderColors = ['#E5F1FF', '#CCE4FF', '#A8D1FF', '#56A6FF', '#2C90FF', '#0284FF', '#025CC0',
                '#01448E', '#013065', '#01244C', '#001833'
            ]
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
                        tooltip: {
                            // Disable the on-canvas tooltip
                            enabled: false,

                            external: function(context) {
                                // Tooltip Element
                                let tooltipEl = document.getElementById('chartjs-tooltip');

                                // Create element on first render
                                if (!tooltipEl) {
                                    tooltipEl = document.createElement('div');
                                    tooltipEl.id = 'chartjs-tooltip';
                                    tooltipEl.innerHTML = '<div class="tw-flex tw-flex-col tw-gap-1 tw-p-2 tw-bg-n100 tw-border-[1.5px] tw-border-n300 tw-rounded-md"></div>';
                                    document.body.appendChild(tooltipEl);
                                }

                                // Hide if no tooltip
                                const tooltipModel = context.tooltip;
                                if (tooltipModel.opacity === 0) {
                                    tooltipEl.style.opacity = 0;
                                    return;
                                }

                                // Set caret Position
                                tooltipEl.classList.remove('above', 'below', 'no-transform');
                                if (tooltipModel.yAlign) {
                                    tooltipEl.classList.add(tooltipModel.yAlign);
                                } else {
                                    tooltipEl.classList.add('no-transform');
                                }

                                function getBody(bodyItem) {
                                    return bodyItem.lines;
                                }

                                // Set Text
                                if (tooltipModel.body) {
                                    const titleLines = tooltipModel.title || [];
                                    const bodyLines = tooltipModel.body.map(getBody);
                                    // console.log(bodyLines);

                                    let innerHtml = '<h4 class="tw-placeholder tw-text-sm tw-text-n600">';

                                    titleLines.forEach(function(title) {
                                        innerHtml += title;
                                    });
                                    innerHtml += '</h4>';

                                    bodyLines.forEach(function(body, i) {
                                        const colors = tooltipModel.labelColors[i];
                                        // let style = 'background:' + colors.backgroundColor;
                                        // style += '; border-color:' + colors.borderColor;
                                        // style += '; border-width: 2px';
                                        const h2 = '<h3 class="tw-text-n1000">' + body;
                                        innerHtml += h2;
                                    });
                                    innerHtml += '</h3>';

                                    let tableRoot = tooltipEl.querySelector('div');
                                    console.log(tableRoot);
                                    tableRoot.innerHTML = innerHtml;
                                }

                                const position = context.chart.canvas.getBoundingClientRect();
                                const bodyFont = Chart.helpers.toFont(tooltipModel.options.bodyFont);

                                // Display, position, and set styles for font
                                tooltipEl.style.opacity = 1;
                                tooltipEl.style.position = 'absolute';
                                tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel
                                    .caretX + 'px';
                                tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel
                                    .caretY + 'px';
                                tooltipEl.style.font = bodyFont.string;
                                tooltipEl.style.padding = tooltipModel.padding + 'px ' + tooltipModel
                                    .padding + 'px';
                                tooltipEl.style.pointerEvents = 'none';
                            }
                        },
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 14,
                                boxHeight: 14,
                                useBorderRadius: true,
                                font: {
                                    family: "Plus Jakarta Sans",
                                    size: "14"
                                }
                            },
                        },
                        title: {
                            display: false,
                        }
                    },
                    layout: {
                        padding: true
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
