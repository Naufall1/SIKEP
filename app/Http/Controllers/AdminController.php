<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }
    public function list(Request $request): JsonResponse
    {
        $user = new User();
        $admin = $user->getAdmin();

        return DataTables::of($admin)
            ->addIndexColumn()
            ->addColumn('action', function ($admin) {
                return '
                    <a href="' . route('admin.detail', [$admin->username]) . '"
                        class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                        Detail
                    </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function show(string $username): View
    {
        $user = new User();

        if (!$user->isAdmin($username)) {
            return redirect()->back();
        }

        $admin = $user->getAdmin($username);
        return view('admin.detail', compact('admin'));
    }
    public function create(): View
    {
        return view('admin.tambah');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|max:100',
            'keterangan' => 'max:15',
            'username' => 'required|unique:user,username|max:50',
            'password' => 'required|min:8|confirmed|max:100',
        ]);

        $user = new User();
        $user->fill($request->only(['nama', 'keterangan', 'username']));
        $user->level_id = 3;
        $user->password = Hash::make($request->password);

        if($user->save())
        {
            return redirect()->route('admin')->with('flash', (object) [
                'type'=> 'success',
                'message'=> 'Admin berhasil ditambahkan'
            ]);
        }
        return redirect()->back()->with('flash', (object) [
            'type'=> 'error',
            'message'=> 'Admin gagal ditambahkan'
        ]);

    }
}
