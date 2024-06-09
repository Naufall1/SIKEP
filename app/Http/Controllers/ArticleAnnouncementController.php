<?php
namespace App\Http\Controllers;

use App\Models\ArticleAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticleAnnouncementController extends Controller
{
    function __construct()
    {
        session()->put('image', null);
    }
    // Display a listing of the resource.
    public function index_publikasi()
    {
        return view('publikasi.index');
    }
    public function list_publikasi()
    {
        $select = [
            'kode',
            'judul',
            'penulis',
            'kategori',
            'status',
            'tanggal_dibuat',
            'tanggal_publish'
        ];

        $announcements = ArticleAnnouncement::select($select)->get();

        return DataTables::of($announcements)
                ->addIndexColumn()
                ->addColumn('action', function ($announcements) {
                    return '
                        <a href="' . route('publikasi.detail', $announcements->kode) . '"
                            class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                            Detail
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function index_draf()
    {
        return view('publikasi.draf.index');
    }

    public function list_draf()
    {
        $select = [
            'kode',
            'judul',
            'penulis',
            'kategori',
            'status',
            'tanggal_dibuat',
            'tanggal_publish'
        ];

        $announcements = ArticleAnnouncement::select($select)->where('user_id', Auth::user()->user_id)->get();

        return DataTables::of($announcements)
                ->addIndexColumn()
                ->addColumn('action', function ($announcements) {
                    return '
                        <a href="' . route('publikasi.draf.detail', $announcements->kode) . '"
                            class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                            Detail
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $user = Auth::user();
        // $publikasi = new ArticleAnnouncement();
        // return view('article_announcements.create', compact('announcement'));
        return view('publikasi.tambah', compact('user'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $filename = '';
        if (!$this->hasImage()) {
            $request->validate([
                'gambar' => 'required|file|image|mimes:jpeg,jpg,png|max:5000'
            ]);
        }

        if ($request->has('gambar')) {
            session()->put('image', (object) [
                'filename' => $request->file('gambar')->getClientOriginalName(),
                'content' => $request->file('gambar')->getContent()
            ]);
        }
        $user = Auth::user();

        $validatedData = $request->validate([
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'caption' => 'required|string|max:255'
        ]);

        $filename = explode('.', session()->get('image')->filename)[0]
                    . '_' .
                    date('Y-m-d-H_i_s') .
                    '.' .
                    explode('.', session()->get('image')->filename)[1];

        if (Storage::disk('public')->put(
                'publikasi/'. $filename,
            session()->get('image')->content)
            ){
            session()->forget('image');
        };

        $publikasi = new ArticleAnnouncement();
        $publikasi->fill($validatedData);
        $publikasi->user_id = $user->user_id;
        $publikasi->penulis = $user->nama;
        $publikasi->tanggal_dibuat = now();
        $publikasi->tanggal_edit = null;
        $publikasi->image_url = $filename;

        if ($request->has('status') && $request->status === 'Ditampilkan') {
            $publikasi->status = 'Ditampilkan';
            $publikasi->tanggal_publish = now();
        } else {
            $publikasi->status = 'Disembunyikan';
            $publikasi->tanggal_publish = null;
        }

        $publikasi->save();
        session()->save();

        return redirect()->route('publikasi')->with('flash', (object)[
            'type'=>'success',
            'message' => 'Pengumuman berhasil dibuat.'
        ]);
    }

    private function hasImage()
    {
        return is_null(session()->get('image')) ? false : true;
    }

    // Display the specified resource.
    public function show($kode)
    {
        // $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();
        $announcement = ArticleAnnouncement::where('kode', $kode)->firstOrFail();
        return view('publikasi.draf.detail', compact('announcement'));
    }
    public function show_draf($kode)
    {
        $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();
        return view('publikasi.draf.detail', compact('announcement'));
    }

    // Show the form for editing the specified resource.
    public function edit_draf($kode)
    {
        $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();
        return view('publikasi.draf.edit', compact('announcement'));
    }
    public function edit_publikasi($kode)
    {
        $announcement = ArticleAnnouncement::where('kode', $kode)->firstOrFail();
        return view('publikasi.edit', compact('announcement'));
    }

    // Update the specified resource in storage.

    public function update_publikasi(Request $request, $kode) // publikasi
    {
        $user = Auth::user();

        $announcement = ArticleAnnouncement::where('kode', $kode)->firstOrFail();
        $announcement->status = $request->status_publikasi;

        if ($request->status_publikasi === 'Disembunyikan') {
            $announcement->save();
        } else {
            $announcement->tanggal_publish = now();
            $announcement->save();
        }

        return redirect()->route('publikasi')->with('flash', (object)[
            'type' => 'success',
            'message' => 'Pengumuman berhasil diperbarui.'
        ]);
    }

    public function update_draf(Request $request, $kode)
    {
        $filename = '';
        if ($request->has('gambar')) {
            $request->validate([
                'gambar' => 'file|image|mimes:jpeg,jpg,png|max:5000'
            ]);

            session()->put('image', (object) [
                'filename' => $request->file('gambar')->getClientOriginalName(),
                'content' => $request->file('gambar')->getContent()
            ]);
        }

        $user = Auth::user();

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'caption' => 'required|string|max:255'
        ]);

        $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', $user->user_id)->firstOrFail();

        if ($this->hasImage()) {
            $filename = explode('.', session()->get('image')->filename)[0]
                        . '_' .
                        date('Y-m-d-H_i_s') .
                        '.' .
                        explode('.', session()->get('image')->filename)[1];

            if(Storage::disk('public')->put(
                    'publikasi/'. $filename,
                session()->get('image')->content)
                ){
                session()->forget('image');
            };
            $announcement->image_url = $filename;
        }

        $announcement->judul = $request->judul;
        $announcement->caption = $request->caption;
        $announcement->isi = $request->isi;

        if ($announcement->isDirty()) {
            $announcement->tanggal_edit = now();
            $announcement->save();
        }

        return redirect()->route('publikasi.draf')->with('flash', (object)[
            'type' => 'success',
            'message' => 'Announcement updated successfully.'
        ]);
    }
}
