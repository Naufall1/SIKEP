<?php

namespace App\Http\Controllers;

use App\Models\ARAS;
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
    public function __construct()
    {
        $this->kriteria = new KriteriaModel();

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
        return DataTables::of(collect($this->kriteria->kriteria()))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECMatriksTernormalisasi(): JsonResponse
    {
        return DataTables::of(collect($this->MEREC->getMatriksTernormalisasi()))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECNilaiSi() : JsonResponse
    {
        return DataTables::of(collect($this->MEREC->getNilaiSi()))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECSij() : JsonResponse
    {
        return DataTables::of(collect($this->MEREC->getNilaiSij()))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECEi() : JsonResponse
    {
        return DataTables::of(collect($this->MEREC->getNilaiEi()))
                ->addIndexColumn()
                ->make();
    }
    public function getMERECBobot() : JsonResponse
    {
        return DataTables::of(collect($this->MEREC->getBobot()))
                ->addIndexColumn()
                ->make();
    }
    public function getARASMatriksKeputusan() : JsonResponse
    {
        return DataTables::of(collect($this->ARAS->getMatriksTernormalisasi_R()))
                ->addIndexColumn()
                ->make();
    }
    public function getARASMatriksTernormalisasi() : JsonResponse
    {
        return DataTables::of(collect($this->ARAS->getMatriksTernormalisasi_R()))
                ->addIndexColumn()
                ->make();
    }
    public function getARASMatriksTerbobot() : JsonResponse
    {
        return DataTables::of(collect($this->ARAS->getMatriksTerbobot_D()))
                ->addIndexColumn()
                ->make();
    }
    public function getARASNilaiFungsiOptimal() : JsonResponse
    {
        return DataTables::of(collect($this->ARAS->getNilaiFungsiOptimum_S()))
                ->addIndexColumn()
                ->make();
    }
    public function getARASPeringkatUtilitas() : JsonResponse
    {
        return DataTables::of(collect($this->ARAS->getPeringkatUtilitas_K()))
                ->addIndexColumn()
                ->make();
    }

}
