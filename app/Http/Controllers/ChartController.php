<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\Demografi;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\Warga;

class ChartController extends Controller
{
    public function filterData(Request $request)
    {
        $selectedRT = $request->input('selectedRT');
        // $selectedChart = $request->input('selectedChart');

        $dataPekerjaan = Warga::getDataPekerjaan($selectedRT);
        $dataJenisKelamin = Warga::getDataJenisKelamin($selectedRT);
        $dataAgama = Warga::getDataAgama($selectedRT);
        $dataTingkatPendidikan = Warga::getDataTingkatPendidikan($selectedRT);
        $dataBansos = Bansos::getDataBansos($selectedRT);
        $dataBansosByMonth = Bansos::getDataBansosByMonth($selectedRT);
        $dataUsia = Demografi::getDataUsia($selectedRT);

        // tes
        $filteredData = Keluarga::join('warga', 'keluarga.no_kk', '=', 'warga.no_kk')->selectRaw('keluarga.RT, warga.nama')->where('keluarga.RT', $selectedRT)->get();

        $responseData = [
            'dataPekerjaan' => $dataPekerjaan,
            'dataJenisKelamin' => $dataJenisKelamin,
            'dataAgama' => $dataAgama,
            'dataTingkatPendidikan' => $dataTingkatPendidikan,
            'dataBansos' => $dataBansos,
            'dataBansosByMonth' => $dataBansosByMonth,
            'dataUsia' => $dataUsia,
            'filteredData' => $filteredData,
        ];

        return response()->json($responseData);
    }

}

