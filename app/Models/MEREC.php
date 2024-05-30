<?php

namespace App\Models;

class MEREC
{
    private KriteriaModel $kriteria;
    private array $R;
    private array $S;
    private array $S0;
    private array $E;
    private array $bobot;

    public function __construct(KriteriaModel $kriteria) {
        $this->kriteria = $kriteria;
    }
    public function getBobot(): array
    {
        return $this->bobot;
    }
    public function calculate()
    {
        $matriks = $this->kriteria->kriteria();


        $n = count($matriks[array_key_first($matriks)]); // jumlah kriteria

        // Step 1: Normalisasi Matriks Keputusan
        $this->R = $this->normalisasiMatriks($matriks, $n);

        // Step 2: Hitung Si
        $this->S = $this->hitungSi($this->R, $n);

        // Step 3: Hitung Sij
        $this->S0 = $this->hitungSij($this->R, $n);

        // Step 4: Hitung Ei
        $this->E = $this->hitungEi($this->S0, $this->S, $n);

        // Step 5: Hitung Bobot
        $this->bobot = $this->hitungBobot($this->E);

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
                    $R[$no_kk][$j] = ($v != 0 && $maxCol != 0) ? $v / $maxCol : 0;
                } else { // benefit
                    $R[$no_kk][$j] = ($v != 0 && $minCol != 0) ? $minCol / $v : 0;
                }
            }
        }
        return $R;
    }

    private function hitungSi($R, $n)
    {
        $S = [];
        foreach ($R as $no_kk => $nilai) {
            $sumLn = 0;
            foreach ($nilai as $j => $r_ij) {
                $sumLn += abs(log($r_ij));
            }
            $S[$no_kk] = log(1 + (1 / $n) * $sumLn);
        }
        return $S;
    }
    private function hitungSij($R, $n)
    {
        $S0 = [];
        foreach ($R as $no_kk => $nilai) {
            foreach ($nilai as $j => $r_ij) {
                $sumLogAbs = 0;
                $count = 1;
                foreach ($nilai as $k => $r_ik) {
                    if ($k != $j && $r_ik > 0) {
                        $sumLogAbs += abs(log($r_ik));
                        $count++;
                    }
                }
                if ($count > 0) {
                    $S0[$no_kk][$j] = log(1 + ($sumLogAbs / $count));
                } else {
                    $S0[$no_kk][$j] = 0;
                }
            }
        }
        // dd($count);
        return $S0;
    }

    private function hitungEi($S0, $S, $n)
    {
        $E = array_fill(0, $n, 0);

        foreach ($S0 as $no_kk => $nilai) {
            for ($j = 0; $j < count($nilai); $j++) {
                $E[$j] += (abs($S0[$no_kk][$j] - $S[$no_kk]));
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

    public function getMatriksTernormalisasi(): array
    {
        return $this->R;
    }
    public function getNilaiSi(): array
    {
        return $this->S;
    }
    public function getNilaiSij(): array
    {
        return $this->S0;
    }
    public function getNilaiEi(): array
    {
        return $this->E;
    }

}
