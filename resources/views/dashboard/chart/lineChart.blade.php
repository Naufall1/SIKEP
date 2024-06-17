<div
    class="tw-flex {{ is_null(Auth::user()) ? '' : (Auth::user()->hasLevel['level_kode'] == 'RW' ? 'tw-justify-between' : '') }}">
    <div class="tw-w-56">
        <x-input.select id="lineChart" onchange="dropdownChartLine()">
            <option value="bansos" >Bansos</option>
            <option value="kematian" selected>Kematian</option>
        </x-input.select>
    </div>
    @if (is_null(Auth::user()) === false && Auth::user()->hasLevel['level_kode'] == 'RW')
        <div class="tw-w-28">
            <x-input.select class="tw-w-28" id="rtLine" onchange="dropdownChartLine(this.value)">
                <option value="ketua">Semua</option>
                @foreach ($semuaRT as $rt)
                    <option value="{{ $rt->keterangan }}">RT {{ str_pad( $rt->keterangan, 3, '0', STR_PAD_LEFT )}}</option>
                @endforeach
            </x-input.select>
        </div>
    @endif
</div>
<div class="tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartLineBansosContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full">
        <canvas id="chartBansosLine" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<div class="tw-w-full tw-h-full tw-overflow-x-auto">
    <div id="chartLineKematianContainer" class="tw-flex tw-h-[242px] tw-min-w-[580px] tw-w-[580px] sm:tw-w-full">
        <canvas id="chartKematianLine" style="width: 100%; height: 100%;" class="tw-flex"></canvas>
    </div>
</div>

<script>
    let bansosLine;
    let kematianLine;
    document.addEventListener('DOMContentLoaded', function() {
        bansosLine = lineBansos();
        kematianLine = lineKematian();
        dropdownChartLine();
        // hiddenAllChart();
    });

    function createChartLine(ctx, labels, data, label) {
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(1, 'rgba(2,92,192,0)');
        gradient.addColorStop(0, 'rgba(2,92,192,0.1)');

        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    fill: true,
                    // fillColor = gradient,
                    // backgroundColor: '#2C90FF',
                    backgroundColor: gradient,
                    borderJoinStyle: 'miter',
                    borderColor: '#2C90FF',
                    borderWidth: 4,
                    hoverBorderColor: '#025CC0',
                    pointBorderWidth: 5,
                    pointHoverBorderWidth: 5
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            callback: function(value) {
                                const lbl = this.getLabelForValue(value);
                                if (typeof lbl === 'string' && lbl.length > 6) {
                                    return `${lbl.substring(0, 6)}...`;
                                }
                                return lbl;
                            },
                            maxRotation: 0,
                            minRotation: 0,
                        }
                    },
                    y: {
                        ticks: {
                            stepSize: 1 // setelan angka di bagian kiri ...
                        }
                    }
                },
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
                                tooltipEl.innerHTML =
                                    '<div class="tw-flex tw-flex-col tw-gap-1 tw-p-2 tw-bg-n100 tw-border-[1.5px] tw-border-n300 tw-rounded-md"></div>';
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

                                let innerHtml = '<h4 class="tw-placeholder tw-text-sm tw-text-n600">';

                                titleLines.forEach(function(title) {
                                    innerHtml += title;
                                });
                                innerHtml += '</h4>';

                                bodyLines.forEach(function(body) {
                                    const h2 = '<h3 class="tw-text-n1000">' + body;
                                    innerHtml += h2;
                                });

                                let tableRoot = tooltipEl.querySelector('div');
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
                        position: 'none'
                    },
                    title: {
                        display: false,
                    }
                },
            }
        });
    }
    function lineBansos() {
        const ctx = document.getElementById('chartBansosLine').getContext('2d');
        const dataBansos = @json($dataBansosByMonth);
        const bulanTahun = dataBansos.map(item => `${item.bulan} ${item.tahun}`);
        const jmlWarga = dataBansos.map(item => item.jumlah);
        return createChartLine(ctx, bulanTahun, jmlWarga, 'Jumlah');
    }

    function lineKematian() {
        const ctx = document.getElementById('chartKematianLine').getContext('2d');
        const dataKematian = @json($dataMeninggal);
        const bulanTahun = dataKematian.map(item => `${item.bulan} (${item.tahun})`);
        const jmlWarga = dataKematian.map(item => item.count);
        return createChartLine(ctx, bulanTahun, jmlWarga, 'Jumlah');
    }

    function updateChartLine(chartInstance, newData, jenisData) {
        let datasets = chartInstance.data.datasets;
        let labels = chartInstance.data.labels;

        // Jika data baru ada dan tidak kosong, perbarui data chart
        if (newData[jenisData] && newData[jenisData].length > 0) {
            datasets[0].data = newData[jenisData].map((item, index) => {
                return item['jumlah'] !== undefined ? item['jumlah'] : 0;
            });
        } else {
            // Jika data kosong, set semua data pada chart ke 0
            datasets[0].data = labels.map(() => 0);
        }

        chartInstance.update();
    }

    function dropdownChartLine(selectedRT) {
        const selectedChart = document.getElementById('lineChart').value;
        var selectedRTValue = "{{ is_null(Auth::user()) ? 'ketua' : Auth::user()->keterangan }}";
        if (document.getElementById('rtLine') != null) {
            selectedRTValue = document.getElementById('rtLine').value;
        }

        const containers = {
            bansos: 'chartLineBansosContainer',
            kematian: 'chartLineKematianContainer',
        };

        for (const container in containers) {
            if (container === selectedChart) {
                // console.log($('#'+containers[container]).parent().attr('class'));
                $('#'+containers[container]).parent().removeClass('tw-hidden');
            } else {
                // console.log('false');
                $('#'+containers[container]).parent().removeClass('tw-hidden');
                $('#'+containers[container]).parent().addClass('tw-hidden');
            }
        }

        $.ajax({
            url: "{{ route('filter-data') }}",
            type: "POST",
            data: {
                selectedRT: selectedRTValue,
                selectedChart: selectedChart,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                // console.log("selected rt =", selectedRTValue);
                // console.log("data array =", data);
                // console.log("chart obj = ", pekerjaanLine);
                switch (selectedChart) {
                    case 'bansos':
                        updateChartLine(bansosLine, data, 'dataBansosByMonth');
                        break;
                    case 'kematian':
                        updateChartLine(kematianLine, data, 'dataMeninggal');
                        break;
                    default:
                        console.error('dropdownChartDataRT() error');
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    function hiddenAllChart() {
        const containers = {
            bansos: 'chartBarBansosContainer',
            kematian: 'chartBarKematianContainer',
        };

        for (const container in containers) {
            $('#'+containers[container]).parent().addClass('tw-hidden');
        }
    }
</script>

@if (is_null(Auth::user()) === false)
    <script></script>
@endif
