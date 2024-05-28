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
        foreach ($matriks as $no_kk => $nilai) {
            for ($j = 0; $j < $n; $j++) {
                $col = array_column($matriks, $j);
                $maxCol = max($col);
                $minCol = min($col);
                if ($j == 0 || $j == 1 || $j == 2 || $j == 3) { // Cost
                    $normalizedMatrix[$no_kk][$j] = $nilai[$j] != 0 ? $bobot[$j] * ($minCol / $nilai[$j]) : 0;
                } else { // Benefit
                    $normalizedMatrix[$no_kk][$j] = $maxCol != 0 ? $bobot[$j] * ($nilai[$j] / $maxCol) : 0;
                }
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
        $totalIdealSolution = array_sum($idealSolution);
        foreach ($alternativesScores as $no_kk => $score) {
            $rankings[$no_kk] = $totalIdealSolution != 0 ? $score / $totalIdealSolution : 0;
        }
        return $rankings;
    }
}
