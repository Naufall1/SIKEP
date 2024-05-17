<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function ARAS($matriks, $bobot, $kriteria)
    {
        // Menentukan nilai A0 (Alternatif ideal)
        $A0 = $this->mencariA0($matriks, $kriteria);

        // Menambahkan A0 ke dalam matriks sebagai alternatif pertama
        array_unshift($matriks, $A0);

        // Langkah 2: Normalisasi Matriks Keputusan
        $R = $this->matriksKeputusan($matriks, $kriteria);

        // Langkah 3: Menentukan bobot matriks
        $D = $this->menghitungBerdasarkanBobot($R, $bobot);

        // Langkah 4: Menentukan nilai optimalisasi (S)
        $S = $this->menghitungFungsiOptimalisasi($D);

        // Langkah 5: Menentukan peringkat (K)
        $K = $this->hitungSkor($S);

        // dd($kriteria);
        return $K;
    }

    public function mencariA0($matriks, $kriteria)
    {
        $A0 = [];
        foreach ($kriteria as $k => $krit) {
            if ($krit['type']) { // Benefit
                $A0[$k] = max(array_column($matriks, $k));
            } else { // Cost
                $A0[$k] = min(array_column($matriks, $k));
            }
        }

        return $A0;
    }

    public function matriksKeputusan($matriks, $kriteria)
    {
        $R = [];
        foreach ($matriks as $i => $nilai_kriteria) {
            foreach ($nilai_kriteria as $k => $nilai) {
                $totalKriteria = array_sum(array_column($matriks, $k));
                if ($totalKriteria == 0) {
                    $R[$i][$k] = 0;
                } else {
                    $R[$i][$k] = $kriteria[$k]['type'] ? $nilai / $totalKriteria : ($nilai == 0 ? 0 : (1 / $nilai) / $totalKriteria);
                }
            }
        }
        // dd($R);
        return $R;
    }

    public function menghitungBerdasarkanBobot($R, $bobot)
    {
        $D = [];
        foreach ($R as $i => $nilai_kriteria) {
            foreach ($nilai_kriteria as $k => $nilai) {
                $D[$i][$k] = $nilai * $bobot[$k];
            }
        }
        // dd($D);
        return $D;
    }

    public function menghitungFungsiOptimalisasi($D)
    {
        $S = [];
        foreach ($D as $i => $nilai_kriteria) {
            $S[$i] = array_sum($nilai_kriteria);
        }
        // dd($S);
        return $S;
    }

    public function hitungSkor($S)
    {
        $S0 = $S[0];
        $K = [];
        for ($i = 1; $i < count($S); $i++) {
            $K[$i - 1] = $S[$i] / $S0;
        }
        return $K;
    }

    public function Kriteria()
    {
        $keluarga = Keluarga::all(['no_kk', 'tagihan_listrik AS K1', 'luas_bangunan AS K2'])->toArray();

        $totalPenghasilanPerKeluarga = Warga::with('keluarga')
            ->select('no_kk', DB::raw('SUM(penghasilan) as K3'))
            ->groupBy('no_kk')
            ->get()
            ->keyBy('no_kk')
            ->toArray();

        $jmlWargaBerpenghasilan = Warga::select('keluarga.no_kk', DB::raw('COUNT(warga.penghasilan) as K4'))
            ->join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->where('warga.penghasilan', '>', 0)
            ->groupBy('keluarga.no_kk')
            ->get()
            ->keyBy('no_kk')
            ->toArray();

        $tanggungan = Warga::select('keluarga.no_kk', DB::raw('COUNT(warga.penghasilan) as K5'))
            ->join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->where('warga.penghasilan', '=', 0)
            ->groupBy('keluarga.no_kk')
            ->get()
            ->keyBy('no_kk')
            ->toArray();

        $jmlBersekolah = Warga::select('keluarga.no_kk AS no_kk', DB::raw('COUNT(CASE WHEN warga.jenis_pekerjaan = "Pelajar/Mahasiswa" THEN warga.no_kk ELSE 0 END) AS K6'))
            ->join('keluarga', 'warga.no_kk', '=', 'keluarga.no_kk')
            ->groupBy('keluarga.no_kk')
            ->get()
            // ->keyBy('no_kk')
            ->toArray();
            // dd($jmlBersekolah);

        $dataAlt = [];

        foreach ($keluarga as $key => $value) {
            $dataAlt[$value['no_kk']] = [
                'K1' => $value['K1'],
                'K2' => $value['K2'],
                'K3' => (int)$totalPenghasilanPerKeluarga[$value['no_kk']]["K3"] ?? 0,
                'K4' => $jmlWargaBerpenghasilan[$value['no_kk']]['K4'] ?? 0,
                'K5' => $tanggungan[$value['no_kk']]['K5'] ?? 0,
                'K6' => $jmlBersekolah[$key]['K6'] ?? 0,
            ];

        }

        $matriks = [];
        foreach ($keluarga as $key => $alternatif) {
            // var_dump($alternatif);
            $matriks[$alternatif['no_kk']] = [
                $this->kriteriaKeluarga($alternatif['K1']),
                $this->kriteriaLuasBangunan($alternatif['K2']),
                isset($totalPenghasilanPerKeluarga[$alternatif['no_kk']]) ? $this->kriteriaTotalPenghasilan($totalPenghasilanPerKeluarga[$alternatif['no_kk']]['K3']) : 0,
                isset($jmlWargaBerpenghasilan[$alternatif['no_kk']]) ? $this->kriteriaJumlahWargaBerpenghasilan($jmlWargaBerpenghasilan[$alternatif['no_kk']]['K4']) : 0,
                isset($tanggungan[$alternatif['no_kk']]) ? $this->kriteriaTanggungan($tanggungan[$alternatif['no_kk']]['K5']) : 0,
                isset($jmlBersekolah[$key]) ? $this->kriteriaJumlahBersekolah($jmlBersekolah[$key]['K6']) : 0
            ];
        }
        // dd($matriks);

        $bobot = [
            (1 + (1 / 2) + (1 / 3) + (1 / 4) + (1 / 5) + (1 / 6)) / 6,
            ((1 / 2) + (1 / 3) + (1 / 4) + (1 / 5) + (1 / 6)) / 6,
            ((1 / 3) + (1 / 4) + (1 / 5) + (1 / 6)) / 6,
            ((1 / 4) + (1 / 5) + (1 / 6)) / 6,
            ((1 / 5) + (1 / 6)) / 6,
            (1 / 6) / 6
        ];

        $kriteria = [
            ['type' => false], // K1: Cost
            ['type' => false], // K2: Cost
            ['type' => false], // K3: Cost
            ['type' => false], // K4: Cost
            ['type' => true],  // K5: Benefit
            ['type' => true]   // K6: Benefit
        ];

        $peringkat = $this->ARAS($matriks, $bobot, $kriteria);

        // dd($keluarga, $matriks);
        foreach ($keluarga as $key => &$alternatif) {
            $alternatif['nilai'] = round($peringkat[$key], 4);
        }


        return view('test', compact(['dataAlt', 'matriks']));
    }

    public function kriteriaKeluarga($kriteria)
    {
        if ($kriteria > 0 && $kriteria <= 150000) {
            return 1;
        } elseif ($kriteria > 150000 && $kriteria <= 250000) {
            return 2;
        } elseif ($kriteria > 250000 && $kriteria <= 350000) {
            return 3;
        } elseif ($kriteria > 350000 && $kriteria <= 450000) {
            return 4;
        } elseif ($kriteria > 450000 && $kriteria <= 550000) {
            return 5;
        } elseif ($kriteria > 550000) {
            return 6;
        } else {
            return 0;
        }
        // dd($kriteria);
    }

    public function kriteriaLuasBangunan($kriteria)
    {
        if ($kriteria > 0 && $kriteria <= 50) {
            return 1;
        } elseif ($kriteria > 50 && $kriteria <= 75) {
            return 2;
        } elseif ($kriteria > 75 && $kriteria <= 150) {
            return 3;
        } elseif ($kriteria > 150 && $kriteria <= 225) {
            return 4;
        } elseif ($kriteria > 225 && $kriteria <= 300) {
            return 5;
        } elseif ($kriteria > 300) {
            return 6;
        } else {
            return 0;
        }
    }

    public function kriteriaTotalPenghasilan($kriteria)
    {
        if ($kriteria > 0 && $kriteria <= 150000) {
            return 1;
        } elseif ($kriteria > 150000 && $kriteria <= 250000) {
            return 2;
        } elseif ($kriteria > 250000 && $kriteria <= 350000) {
            return 3;
        } elseif ($kriteria > 350000 && $kriteria <= 450000) {
            return 4;
        } elseif ($kriteria > 450000 && $kriteria <= 550000) {
            return 5;
        } elseif ($kriteria > 550000) {
            return 6;
        } else {
            return 0;
        }
    }

    public function kriteriaJumlahWargaBerpenghasilan($kriteria)
    {
        if ($kriteria == 0) {
            return 1;
        } elseif ($kriteria == 1) {
            return 2;
        } elseif ($kriteria == 2) {
            return 3;
        } elseif ($kriteria == 3) {
            return 4;
        } elseif ($kriteria == 4) {
            return 5;
        } elseif ($kriteria == 5) {
            return 6;
        } elseif ($kriteria > 5) {
            return 7;
        } else {
            return 0;
        }
    }

    public function kriteriaTanggungan($kriteria)
    {
        if ($kriteria == 0) {
            return 1;
        } elseif ($kriteria == 1) {
            return 2;
        } elseif ($kriteria == 2) {
            return 3;
        } elseif ($kriteria == 3) {
            return 4;
        } elseif ($kriteria == 4) {
            return 5;
        } elseif ($kriteria == 5) {
            return 6;
        } elseif ($kriteria > 5) {
            return 7;
        } else {
            return 0;
        }
    }

    public function kriteriaJumlahBersekolah($kriteria)
    {
        if ($kriteria == 0) {
            return 1;
        } elseif ($kriteria == 1) {
            return 2;
        } elseif ($kriteria == 2) {
            return 3;
        } elseif ($kriteria == 3) {
            return 4;
        } elseif ($kriteria == 4) {
            return 5;
        } elseif ($kriteria == 5) {
            return 6;
        } elseif ($kriteria > 5) {
            return 7;
        } else {
            return 0;
        }
    }
}
