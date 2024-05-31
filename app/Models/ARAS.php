<?php

namespace App\Models;

class ARAS
{
    private array $matriks;
    private array $matriksKeputusan;
    private array $namaKriteria = [];
    private array $bobot;
    private array $normalisasiCost = [];
    private array $normalizedMatrix = [];
    private array $matriksTerbobot = [];
    private array $nilaiFungsiOptimum_S = [];
    private array $peringkatUtilitas_K = [];

    public function __construct(array $matriks, array $namaKriteria, array $bobot) {
        $this->matriks = $matriks;
        $this->namaKriteria = $namaKriteria;
        $this->bobot = $bobot;
    }
    public function calculate()
    {
        $this->normalisasi();
        $this->hitungMatriksTernormalisasiTerbobot();
        $this->hitungNilaiFungsiOptimum();
        $this->hitungPeringkat();
    }

    public function normalisasi(): array
    {
        // $normalizedMatrix = [];
        $n = count($this->namaKriteria);
        $m = count($this->matriks);
        $cost = [];
        $array_sum = [];

        // Langkah 1: Hitung nilai A0 untuk setiap kriteria
        $a0Array = [];
        foreach ($this->namaKriteria as $index => $kriteria) {
            $col = array_column($this->matriks, $index);
            $maxCol = max($col);
            $minCol = min($col);

            // Hitung nilai A0
            if (in_array($index, [0, 1, 2, 3])) { // Cost
                $a0Array[] = $minCol;
            } else { // Benefit
                $a0Array[] = $maxCol;
            }
        }

        $this->matriksKeputusan['A0'] = $a0Array;

        foreach ($this->matriks as $key => $value) {
            $this->matriksKeputusan[$key] = $value;
        }

        // Langkah 2: Menghitung normalisasi step 1 untuk cost
        foreach ($this->matriks as $no_kk => $nilai) {
            for ($i=0; $i <=3 ; $i++) {
                $cost['0'][$i] = $a0Array[$i] != 0 ? 1 / $a0Array[$i] : 0;
            }
            for ($j = 0; $j <= 3; $j++) {
                $cost[$no_kk][$j] = $nilai[$j] != 0 ? 1 / $nilai[$j] : 0;
            }
        }

        $this->normalisasiCost = $cost;

        // Menjumlah nilai setiap kriteria
        for ($i=0; $i < $n; $i++) {
            $array_sum[] = 0;
            if (in_array($i, [0, 1, 2, 3])) {
                $array_sum[$i] += $cost['0'][$i];
            } else {
                $array_sum[$i] += $a0Array[$i];
            }

            foreach ($this->matriks as $no_kk => $nilai) {
                if (in_array($i, [0, 1, 2, 3])) { // Cost
                    $array_sum[$i] += $cost[$no_kk][$i];
                } else { // Benefit
                    $array_sum[$i] += $nilai[$i];
                }
            }
        }

        // Normalisasi A0
        for ($i=0; $i < $n; $i++) {
            if (in_array($i, [0, 1, 2, 3])) { // Cost
                $this->normalizedMatrix['0'][$i] = $cost['0'][$i] != 0 ? $cost['0'][$i] / $array_sum[$i] : 0;
            } else { // Benefit
                $this->normalizedMatrix['0'][$i] = $a0Array[$i] / $array_sum[$i];
            }
        }

        // Menormalisasi semua baris
        foreach ($this->matriks as $no_kk => $nilai) {
            for ($j = 0; $j < $n; $j++) {
                if (in_array($j, [0, 1, 2, 3])) { // Cost
                    $this->normalizedMatrix[$no_kk][$j] = $cost[$no_kk][$j] != 0 ? $cost[$no_kk][$j] / $array_sum[$j] : 0;
                } else { // Benefit
                    $this->normalizedMatrix[$no_kk][$j] = $nilai[$j] / $array_sum[$j];
                }
            }
        }

        return $this->normalizedMatrix;
    }

    public function hitungMatriksTernormalisasiTerbobot(array $matriksTernormalisasi = null)
    {
        if (!$matriksTernormalisasi){
            $matriksTernormalisasi = $this->normalizedMatrix;
        }

        /**
         * Hitung matriks terbobot dengan melakukan perkalian nilai kriteria
         * dengan setiap bobotnya untuk setiap alternatif
         */
        foreach ($matriksTernormalisasi as $key => $value) {
            for ($i=0; $i < count($this->namaKriteria); $i++) {
                $this->matriksTerbobot[$key][$i] = $this->bobot[$i] * $value[$i];
            }
        }

        return $this->matriksTerbobot;
    }

    public function hitungNilaiFungsiOptimum(array $matriksTerbobot = null)
    {
        if (!$matriksTerbobot){
            $matriksTerbobot = $this->matriksTerbobot;
        }

        /**
         * Hitung nilai Fungsi Optimum dengan melakukan SUM
         * terhadap semua nilai kriteria(terbobot) pada setiap alternatif
         * */
        foreach ($matriksTerbobot as $no_kk => $value) {
            $this->nilaiFungsiOptimum_S[$no_kk] = array_sum($value);
        }

        return $this->nilaiFungsiOptimum_S;
    }

    public function hitungPeringkat(array $nilaiFungsiOptimum = null)
    {
        if (!$nilaiFungsiOptimum){
            $nilaiFungsiOptimum = $this->nilaiFungsiOptimum_S;
        }

        /**
         * Hitung nilai Peringkat Utilitas (K) dengan membagi setiap nilai S dengan S0.
         */
        foreach ($nilaiFungsiOptimum as $no_kk => $value) {
            if ($no_kk == '0') continue;
            $this->peringkatUtilitas_K[$no_kk] = $value / $nilaiFungsiOptimum['0'];
        }

        arsort($this->peringkatUtilitas_K);

        return $this->peringkatUtilitas_K;
    }
    public function getMatriksKeputusan() : array {
        return $this->matriksKeputusan;
    }
    public function getNormalisasiTahap_1() : array {
        return $this->normalisasiCost;
    }
    public function getMatriksTernormalisasi_R() : array {
        return $this->normalizedMatrix;
    }
    public function getMatriksTerbobot_D() : array {
        return $this->matriksTerbobot;
    }
    public function getNilaiFungsiOptimum_S() : array {
        return $this->nilaiFungsiOptimum_S;
    }
    public function getPeringkatUtilitas_K() : array {
        return $this->peringkatUtilitas_K;
    }
}
