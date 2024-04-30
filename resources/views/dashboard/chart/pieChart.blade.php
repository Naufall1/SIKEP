<div class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RW' ? 'tw-justify-between' : '' }}">
    <div class="tw-w-56">
        <x-input.select id="chartType" onchange="dropdownChartData()">
            <option value="pekerjaan" selected>Pekerjaan</option>
            <option value="jenis_kelamin">Jenis Kelamin</option>
            <option value="tingkat_pendidikan">Tingkat Pendidikan</option>
            <option value="agama">Agama</option>
        </x-input.select>
    </div>
    @if (Auth::user()->hasLevel['level_kode'] == 'RW')
    <div class="tw-w-28">
        <x-input.select class="tw-w-28" id="rt" onchange="dropdownChartData()">
            <option value="all">Semua</option>
                @foreach ($semuaRT as $rt)
            <option value="{{ $rt->rt }}">RT. {{ $rt->keterangan }}</option>
        @endforeach
        </x-input.select>
    </div>
    @endif
</div>

<div id="chartPekerjaanContainer" class="tw-flex tw-w-full">
    <canvas height="224" id="chartPekerjaanPie" style="width: 100%;" class="tw-flex"></canvas>
</div>

<div id="chartJenisKelaminContainer" class="tw-flex tw-w-full" style="display: none" >
    <canvas height="224" id="chartJenisKelaminPie" style="width: 590px;" class="tw-flex"></canvas>
</div>

<div id="chartAgamaContainer" class="tw-flex tw-w-full" style="display: none" >
    <canvas height="224" id="chartAgamaPie" style="width: 590px;" class="tw-flex"></canvas>
</div>

<div id="chartTingkatPendidikanContainer" class="tw-flex tw-w-full" style="display: none" >
    <canvas height="224" id="chartTingkatPendidikanPie" style="width: 590px;" class="tw-flex"></canvas>
</div>

<script>
    function dropdownChartData() {
        const selectedChart = document.getElementById('chartType').value;
        const containers = {
            pekerjaan: 'chartPekerjaanContainer',
            jenis_kelamin: 'chartJenisKelaminContainer',
            agama: 'chartAgamaContainer',
            tingkat_pendidikan: 'chartTingkatPendidikanContainer'
        };

        if (selectedChart in containers) {
        for (const container in containers) {
            document.getElementById(containers[container]).style.display = (container === selectedChart) ? 'block' : 'none';
        }

        // Panggil fungsi grafik yang sesuai
        window[selectedChart]();
    } else {
        console.error('error pada fungsi dropdownChartData()'); // tampil ndek console inspect
    }
}

    document.addEventListener('DOMContentLoaded', function() {
        chartPekerjaan();
        chartJenisKelamin();
        chartAgama();
        chartTingkatPendidikan();
    });

    function createChart(ctx, labels, data, label) {
        return new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: ['#2C90FF', '#025CC0', '#01448E', '#013065', '#01244C', '#001833'],
                    borderColor: ['#2C90FF', '#0284FF', '#025CC0', '#01448E', '#013065', '#01244C'],
                    borderWidth: 1.5
                }]
            },
            options: {
                responsive: false,
                plugins: {
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
                        }
                    },
                    title: { display: false },
                },
                layout: { padding: true }
            }
        });
    }

    function chartAgama() {
        const ctx = document.getElementById('chartAgamaPie').getContext('2d');
        const dataAgama = @json($dataAgama);
        const agama = dataAgama.map(item => item.agama);
        const jmlWarga = dataAgama.map(item => item.jumlah);
        createChart(ctx, agama, jmlWarga, 'Jumlah Warga');
    }

    function chartTingkatPendidikan() {
        const ctx = document.getElementById('chartTingkatPendidikanPie').getContext('2d');
        const dataTingkatPendidikan = @json($dataTingkatPendidikan);
        const pendidikan = dataTingkatPendidikan.map(item => item.pendidikan);
        const jmlWarga = dataTingkatPendidikan.map(item => item.jumlah);
        createChart(ctx, pendidikan, jmlWarga, 'Jumlah Warga');
    }

    function chartPekerjaan() {
        const ctx = document.getElementById('chartPekerjaanPie').getContext('2d');
        const dataPekerjaan = @json($dataPekerjaan);
        const jenisPekerjaan = dataPekerjaan.map(item => item.jenis_pekerjaan);
        const jmlWarga = dataPekerjaan.map(item => item.total);
        createChart(ctx, jenisPekerjaan, jmlWarga, 'Jumlah Warga');
    }

    function chartJenisKelamin() {
        const ctx = document.getElementById('chartJenisKelaminPie').getContext('2d');
        const dataJenisKelamin = @json($dataJenisKelamin);
        const jenisKelamin = dataJenisKelamin.map(item => item.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
        const jmlWarga = dataJenisKelamin.map(item => item.jumlah); // sementara sek gaiso persentase karena blom nemu cara nambahi atribut % di akhir elemen
        createChart(ctx, jenisKelamin, jmlWarga, 'Jumlah Warga (Jenis Kelamin)');
    }
</script>
