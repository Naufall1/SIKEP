<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KriteriaModel extends Model
{
    use HasFactory;

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

    public function kriteria()
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
            ->keyBy('no_kk')
            ->toArray();

        $matriks = [];
        foreach ($keluarga as $key => $alternatif) {
            $matriks[$alternatif['no_kk']] = [
                $this->kriteriaKeluarga($alternatif['K1']),
                $this->kriteriaLuasBangunan($alternatif['K2']),
                isset($totalPenghasilanPerKeluarga[$alternatif['no_kk']]) ? $this->kriteriaTotalPenghasilan($totalPenghasilanPerKeluarga[$alternatif['no_kk']]['K3']) : 0,
                isset($jmlWargaBerpenghasilan[$alternatif['no_kk']]) ? $this->kriteriaJumlahWargaBerpenghasilan($jmlWargaBerpenghasilan[$alternatif['no_kk']]['K4']) : 0,
                isset($tanggungan[$alternatif['no_kk']]) ? $this->kriteriaTanggungan($tanggungan[$alternatif['no_kk']]['K5']) : 0,
                isset($jmlBersekolah[$alternatif['no_kk']]) ? $this->kriteriaJumlahBersekolah($jmlBersekolah[$alternatif['no_kk']]['K6']) : 0
            ];
        }
        return $matriks;
    }
    public function namaKriteria()
    {
        $namaKriteria = [
            'Tagihan Listrik',
            'Luas Bangunan',
            'Total Penghasilan Per Keluarga',
            'Jumlah Warga Berpenghasilan',
            'Tanggungan',
            'Jumlah Bersekolah'
        ];
        return $namaKriteria;
    }

}
