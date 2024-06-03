<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = User::select('user.*', 'level.level_nama')
        ->join('level', 'user.level_id', '=', 'level.level_id')
        ->where('user.user_id', auth()->id())
        ->firstOrFail();
    return view('user.index', compact('user'));
}
    public function edit($user_id){
        $user = User::find($user_id);
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request, $user_id) {
        if ($request->has('keterangan')) {
            $request->validate([
                'keterangan' => 'max:100', // iki mosok salah yoo(ga work)
                'old_password' => 'required_with:password',
                'password' => 'nullable',
                'password_ulangi' => 'nullable'
            ]);
        }

        $user = User::where('user_id', $user_id)->firstOrFail();
        if ($request->filled('password') || $request->filled('password_ulangi')) {
            if (!isset($request->old_password)) {
                return redirect()->back()->with('flash',(object) ['type'=> 'error','message'=> 'Jika rubah Kata Sandi, Maka Isi Kata Sandi Lama']);
            }
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('flash',(object) ['type'=> 'error','message'=>  'Kata Sandi lama salah.']);
            }
            if ($request->password !== $request->password_ulangi) {
                return redirect()->back()->with('flash',(object) ['type'=> 'error','message'=>  'Kata Sandi Baru Tidak Sesuai.']);
            }

            $user->password = Hash::make($request->password);
        }

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->save();

        // nyoba flask message (blom di fix bisa karena blom nyoba)
        return redirect()->route('profil')->with('flash', (object) ['type'=>'success','message'=>'Data pengguna berhasil diperbarui.']);

        }
    }
