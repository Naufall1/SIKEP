<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class ARASController extends Controller
{
    protected $merecController;

    public function __construct(MERECController $merecController)
    {
        $this->merecController = $merecController;
    }

    public function rankingBansos()
    {
        $kriteriaModel = new KriteriaModel();
        $matriks = $kriteriaModel->kriteria();
        $namaKriteria = $kriteriaModel->namaKriteria();

        // Merec
        $weightsData = $this->merecController->MEREC();
        $bobot = $weightsData->getData()['bobot'];

        // Step 1: Normalisasi Matriks Keputusan dengan Bobot MERECs
        $normalizedMatrix = $this->normalisasiMatriks($matriks, $namaKriteria, $bobot);

        // Step 2: Hitung Skor Ideal
        $idealSolution = $this->hitungSkorIdeal($normalizedMatrix);

        // Step 3: Hitung Skor Alternatif
        $alternativesScores = $this->hitungSkorAlternatif($normalizedMatrix);

        // Step 4: Hitung Nilai Utilitas dan Lakukan Perangkingan
        $rankings = $this->hitungNilaiUtilitas($alternativesScores, $idealSolution);

        arsort($rankings);

        return view('bansos.perhitungan.ranking', compact('bobot','rankings', 'namaKriteria', 'idealSolution', 'alternativesScores', 'normalizedMatrix', 'matriks'));
    }

    private function normalisasiMatriks($matriks, $namaKriteria, $bobot)
    {
        $normalizedMatrix = [];
        $n = count($namaKriteria);
        $m = count($matriks);

        // Langkah 1: Hitung nilai A0 untuk setiap kriteria
        $a0Array = [];
        foreach ($namaKriteria as $index => $kriteria) {
            $col = array_column($matriks, $index);
            $maxCol = max($col);
            $minCol = min($col);

            // Hitung nilai A0
            if (in_array($index, [0, 1, 2, 3])) { // Cost
                $a0Array[] = $minCol;
            } else { // Benefit
                $a0Array[] = $maxCol;
            }
        }

        // Langkah 2: Normalisasi matriks dengan nilai A0
        foreach ($matriks as $no_kk => $nilai) {
            for ($j = 0; $j < $n; $j++) {
                if (in_array($j, [0, 1, 2, 3])) { // Cost
                    $minCol = $a0Array[$j];
                    $normalizedMatrix[$no_kk][$j] = $nilai[$j] != 0 ? $minCol / $nilai[$j] : 0;
                } else { // Benefit
                    $maxCol = $a0Array[$j];
                    $normalizedMatrix[$no_kk][$j] = $nilai[$j] / $maxCol;
                }
            }
        }

        // Masukkan bobot dikali ke normalisasi matrik
        foreach ($normalizedMatrix as $no_kk => $nilai) {
            foreach ($nilai as $j => $v) {
                $normalizedMatrix[$no_kk][$j] *= $bobot[$j];
            }
        }

        return $normalizedMatrix;
    }


    private function hitungSkorIdeal($normalizedMatrix)
    {
        $idealSolution = array_fill(0, count($normalizedMatrix[array_key_first($normalizedMatrix)]), 0);
        foreach ($normalizedMatrix as $no_kk => $nilai) {
            foreach ($nilai as $j => $v) {
                $idealSolution[$j] += $v;
            }
        }
        return $idealSolution;
    }


    private function hitungSkorAlternatif($normalizedMatrix)
    {
        $alternativesScores = [];
        foreach ($normalizedMatrix as $no_kk => $nilai) {
            $alternativesScores[$no_kk] = array_sum($nilai);
        }
        return $alternativesScores;
    }


    private function hitungNilaiUtilitas($alternativesScores, $idealSolution)
    {
        $rankings = [];
        $S0 = array_sum($idealSolution); // Skor total ideal
        foreach ($alternativesScores as $no_kk => $score) {
            $rankings[$no_kk] = $S0 != 0 ? $score / $S0 : 0;
        }
        return $rankings;
    }
}
