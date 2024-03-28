<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (!Auth::check()) {
            return $this->dashboardGuest();
        }
        switch (Auth::user()->hasLevel['level_kode']) {
            case 'RW':
                return $this->dashboardRW();
            case 'RT':
                return $this->dashboardRT();
            case 'ADM':
                return $this->dashboardADM();
            default:
                break;
        }
    }
    private function dashboardRW() {
        return view('dashboard.index', ['title' => 'RW','text' => 'Ketua RW']);
    }
    private function dashboardRT() {
        return view('dashboard.index', ['title' => 'RT','text' => 'Ketua RT']);
    }
    private function dashboardADM() {
        return view('dashboard.index', ['title' => 'Admin','text' => 'Admin']);
    }
    private function dashboardGuest() {
        return view('dashboard.index', ['title' => 'Umum','text' => 'Warga']);
    }
}
