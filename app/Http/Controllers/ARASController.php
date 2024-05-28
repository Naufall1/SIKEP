<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class ARASController extends Controller
{
    public function rankingBansos()
    {
        $kriteriaModel = new KriteriaModel();
        $matriks = $kriteriaModel->kriteria();
        // dd($matriks);

        $namaKriteria = $kriteriaModel->namaKriteria();


        // MEREC --> get bobot
        $merecController = new MERECController();
        $weightsData = $merecController->MEREC();
        $bobot = $weightsData->getData()['bobot']; // controler MEREC

        $m = count($matriks); // qty alternatif
        if ($m == 0) {
            return view('ranking', ['rankings' => [], 'namaKriteria' => $namaKriteria]);
        }
        $n = count($matriks[array_key_first($matriks)]); // qty kriteria
        // dd($n);

        // Step 1: Normalisasi Matriks Keputusan dengan Bobot
        $normalizedMatrix = [];
        for ($j = 0; $j < $n; $j++) {
            $col = array_column($matriks, $j);
            $maxCol = max($col);
            $minCol = min($col);
            foreach ($matriks as $no_kk => $nilai) {
                if ($j == 0 || $j == 1 || $j == 2 || $j == 3 ) { // Cost
                    $normalizedMatrix[$no_kk][$j] = $nilai[$j] != 0 ? $bobot[$j] * ($minCol / $nilai[$j]) : 0;
                    // dd($normalizedMatrix);
                } else { // Benefit arr--> indx 4 dan 5
                    $normalizedMatrix[$no_kk][$j] = $maxCol != 0 ? $bobot[$j] * ($nilai[$j] / $maxCol) : 0;
                }

            }
        }

        // Step 2: Hitung Skor Ideal
        $idealSolution = array_fill(0, $n, 0);
        foreach ($normalizedMatrix as $no_kk => $nilai) {
            foreach ($nilai as $j => $v) {
                $idealSolution[$j] += $v;
            }
        }

        // Step 3: Hitung Skor Alternatif
        $alternativesScores = [];
        foreach ($normalizedMatrix as $no_kk => $nilai) {
            $alternativesScores[$no_kk] = array_sum($nilai);
        }

        // Step 4: Hitung Nilai Utilitas dan Lakukan Perangkingan
        $rankings = [];
        $totalIdealSolution = array_sum($idealSolution);
        foreach ($alternativesScores as $no_kk => $score) {
            $rankings[$no_kk] = $totalIdealSolution != 0 ? $score / $totalIdealSolution : 0;
        }

        arsort($rankings);
        // dd(($rankings));
        return view('bansos.perhitungan.ranking', compact('rankings', 'namaKriteria', 'normalizedMatrix', 'matriks'));
    }
}
