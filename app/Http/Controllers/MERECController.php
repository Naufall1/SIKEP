<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class MERECController extends Controller
{
    public function MEREC()
    {
        $kriteriaModel = new KriteriaModel();
        $matriks = $kriteriaModel->kriteria();
        // dd($matriks);
        $namaKriteria = $kriteriaModel->namaKriteria();

        $m = count($matriks); // qty alternatif
        if ($m == 0) {
            return view('test',['bobot' => [], 'namaKriteria' => $namaKriteria]);
        }
        $n = count($matriks[array_key_first($matriks)]); // qty kriteria

        // Step 1: Normalisasi Matriks Keputusan
        $R = $this->normalisasiMatriks($matriks, $n);

        // Step 2: Hitung Si
        $S = $this->hitungSi($R, $n);

        // Step 3: Hitung Sij
        $S0 = $this->hitungSij($R, $n);

        // Step 4: Hitung Ei
        $E = $this->hitungEi($S0, $S, $n);

        // Step 5: Hitung Bobot
        $bobot = $this->hitungBobot($E);

        return view('bansos.perhitungan.bobot', compact('matriks','R', 'S', 'S0', 'E', 'bobot', 'namaKriteria'));
    }

    private function normalisasiMatriks($matriks, $n)
    {
        $R = [];
        foreach ($matriks as $no_kk => $nilai) {
            foreach ($nilai as $j => $v) {
                $col = array_column($matriks, $j);
                $maxCol = max($col);
                $minCol = min($col);

                if ($j == 0 || $j == 1 || $j == 2 || $j == 3) { // cost
                    $R[$no_kk][$j] = $v != 0 ? $minCol / $v : 0;
                } else { // benefit
                    $R[$no_kk][$j] = $maxCol != 0 ? $v / $maxCol : 0;
                }
            }
        }
        return $R;
    }

    private function hitungSi($R, $n)
    {
        $S = [];
        foreach ($R as $no_kk => $nilai) {
            $sumLog = 0;
            foreach ($nilai as $j => $r_ij) {
                if ($r_ij > 0) {
                    $sumLog += log($r_ij);
                }
            }
            $S[$no_kk] = log(1 + ($sumLog / $n));
        }
        return $S;
    }

    private function hitungSij($R, $n)
    {
        $S0 = [];
        foreach ($R as $no_kk => $nilai) {
            foreach ($nilai as $j => $r_ij) {
                $sumLog = 0;
                foreach ($nilai as $k => $r_ik) {
                    if ($j != $k && $r_ik > 0) {
                        $sumLog += abs(log($r_ik));
                    }
                }
                $S0[$no_kk][$j] = log(1 + ($sumLog / ($n - 1)));
            }
        }
        return $S0;
    }

    private function hitungEi($S0, $S, $n)
    {
        $E = array_fill(0, $n, 0);
        foreach ($S0 as $no_kk => $nilai) {
            foreach ($nilai as $j => $s0_ij) {
                $E[$j] += $s0_ij - $S[$no_kk];
            }
        }
        return $E;
    }

    private function hitungBobot($E)
    {
        $total_E = array_sum($E);
        $bobot = [];
        foreach ($E as $j => $e_j) {
            $bobot[$j] = $total_E != 0 ? $e_j / $total_E : 0;
        }
        arsort($bobot);
        return $bobot;
    }
}
