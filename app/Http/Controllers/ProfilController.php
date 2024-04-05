<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->id()); // ambil user_id dgn cara id()
        return view('user.index', compact('user'));
}
    public function edit($user_id){
        $user = User::find($user_id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        // kudu di isi sesuai karo tipe data e
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'nama' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $user = User::where('user_id', $user_id)->firstOrFail();

        // gawe update e user ngkok
        $user->update([
            'username' => $request->username,
            'password' => $request->md5()->password,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);
        // nyoba flask message (blom di fix bisa karena blom nyoba)
        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

}


