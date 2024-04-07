<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->id()); // ambil user_id dgn cara id()
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
            ]);
        }

        $user = User::where('user_id', $user_id)->firstOrFail();
        // cek lek password lama ga pdo maka di return
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama salah.');
        }
        else {
        // gawe update e user ngkok
        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password, // soale lek dikosongi tetep berubah
        ]);

        // nyoba flask message (blom di fix bisa karena blom nyoba)
        return redirect()->route('profil')->with('success', 'Data pengguna berhasil diperbarui.');

        }
    }

}


