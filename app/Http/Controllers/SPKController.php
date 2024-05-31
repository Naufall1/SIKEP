<?php

namespace App\Http\Controllers;

use App\Models\ARAS;
use App\Models\Keluarga;
use App\Models\KriteriaModel;
use App\Models\MEREC;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;

class SPKController extends Controller
{
    private MEREC $MEREC;
    private ARAS $ARAS;
    private KriteriaModel $kriteria;
    private $daftarKeluarga;
    public function __construct()
    {
        $this->kriteria = new KriteriaModel();

        $this->daftarKeluarga = Keluarga::select(['no_kk', 'kepala_keluarga'])->get();

        $this->MEREC = new MEREC($this->kriteria);
        $this->MEREC->calculate();

        $this->ARAS = new ARAS($this->kriteria->kriteria(), $this->kriteria->namaKriteria(), $this->MEREC->getBobot());
        $this->ARAS->calculate();
    }
    public function index()
    {
        dd($this->MEREC->getMatriksTernormalisasi(), $this->MEREC->getNilaiSi(), $this->MEREC->getNilaiSij(), $this->MEREC->getNilaiEi());
        // dd($this->ARAS->getMatriksTernormalisasi_R(), $this->ARAS->getMatriksTerbobot_D(), $this->ARAS->getNilaiFungsiOptimum_S() ,$this->ARAS->getPeringkatUtilitas_K());
    }
    public function getMatriksKeputusan() : JsonResponse
    {
        $data = [];

        foreach ($this->kriteria->kriteria() as $key => $value) {
            $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            $data[$key] = array_merge($data[$key], $value);
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECMatriksTernormalisasi(): JsonResponse
    {
        $data = [];

        foreach ($this->MEREC->getMatriksTernormalisasi() as $key => $value) {
            $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            $data[$key] = array_merge($data[$key], $value);
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECNilaiSi() : JsonResponse
    {
        $data = [];

        foreach ($this->MEREC->getNilaiSi() as $key => $value) {
            $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            $data[$key][0] = $value;
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECSij() : JsonResponse
    {
        $data = [];

        foreach ($this->MEREC->getNilaiSij() as $key => $value) {
            $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            $data[$key] = array_merge($data[$key], $value);
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECEi() : JsonResponse
    {
        $data = [];

        $data[] = $this->MEREC->getNilaiEi();
        $data[0]['title'] = 'Nilai E';
        $data[0]['total'] = array_sum($this->MEREC->getNilaiEi());

        return DataTables::of(collect($data))
                ->make();
    }
    public function getMERECBobot() : JsonResponse
    {
        $data = [];

        $data[] = $this->MEREC->getBobot();
        $data[0]['title'] = 'Bobot';
        $data[0]['total'] = array_sum($this->MEREC->getNilaiEi());

        return DataTables::of(collect($data))
                ->make();
    }
    public function getARASMatriksKeputusan() : JsonResponse
    {
        $data = [];

        foreach ($this->ARAS->getMatriksKeputusan() as $key => $value) {
            if (!is_null($this->daftarKeluarga->find($key))) {
                $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            } else {
                $data[$key]['kepala_keluarga'] = 'A0';
            }
            $data[$key] = array_merge($data[$key], $value);
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getARASNormalisasi_1() : JsonResponse {
        $data = [];

        foreach ($this->ARAS->getNormalisasiTahap_1() as $key => $value) {
            if (!is_null($this->daftarKeluarga->find($key))) {
                $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            } else {
                $data[$key]['kepala_keluarga'] = 'A0';
            }
            $data[$key] = array_merge($data[$key], $value);
            $data[$key]['4'] = '-';
            $data[$key]['5'] = '-';
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getARASMatriksTernormalisasi() : JsonResponse
    {
        $data = [];

        foreach ($this->ARAS->getMatriksTernormalisasi_R() as $key => $value) {
            if (!is_null($this->daftarKeluarga->find($key))) {
                $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            } else {
                $data[$key]['kepala_keluarga'] = 'A0';
            }
            $data[$key] = array_merge($data[$key], $value);
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getARASMatriksTerbobot() : JsonResponse
    {
        $data = [];

        foreach ($this->ARAS->getMatriksTerbobot_D() as $key => $value) {
            if (!is_null($this->daftarKeluarga->find($key))) {
                $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            } else {
                $data[$key]['kepala_keluarga'] = 'A0';
            }
            $data[$key] = array_merge($data[$key], $value);
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getARASNilaiFungsiOptimal() : JsonResponse
    {
        $data = [];

        foreach ($this->ARAS->getNilaiFungsiOptimum_S() as $key => $value) {
            if (!is_null($this->daftarKeluarga->find($key))) {
                $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            } else {
                $data[$key]['kepala_keluarga'] = 'A0';
            }
            $data[$key][0] = $value;
        }

        return DataTables::of(collect($data))
                ->addIndexColumn()
                ->make();
    }
    public function getARASPeringkatUtilitas() : JsonResponse
    {
        $data = [];

        $rank = 1;
        foreach ($this->ARAS->getPeringkatUtilitas_K() as $key => $value) {
            $data[$key]['kepala_keluarga'] = $this->daftarKeluarga->find($key)->kepala_keluarga;
            $data[$key][0] = $value;
            $data[$key]['rank'] = $rank;
            $rank += 1;
        }

        return DataTables::of(collect($data))
                // ->addIndexColumn()
                ->make();
    }

}
