<?php
namespace App\Http\Controllers;

use App\Models\ArticleAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ArticleAnnouncementController extends Controller
{
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
        $user = Auth::user();

        // dd($request);
        $validatedData = $request->validate([
            // 'kode' => 'required|unique:article_announcement',
            'kategori' => 'required|string|max:255',
            // 'penulis' => 'required|string|max:255',
            // 'tanggal_publish' => 'required|date',
            // 'tanggal_dibuat' => 'required|date',
            // 'tanggal_edit' => 'nullable|date',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            // 'status' => 'required',
            'image_url' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255'
        ]);

        // ArticleAnnouncement::create($validatedData);
        $publikasi = new ArticleAnnouncement();

        $publikasi->fill($validatedData);

        $publikasi->user_id = $user->user_id;
        $publikasi->penulis = $user->nama;
        $publikasi->tanggal_publish = null;
        $publikasi->tanggal_dibuat = now();
        $publikasi->tanggal_edit = null;
        $publikasi->image_url = "coba.jpg";
        $publikasi->status = "Disembunyikan";

        $publikasi->save();

        return redirect()->route('publikasi')->with('success', 'Announcement created successfully.');
    }

    // Display the specified resource.
    public function show($kode)
    {
        // $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();
        $announcement = ArticleAnnouncement::where('kode', $kode)->firstOrFail();
        return view('publikasi.detail', compact('announcement'));
    }
    public function show_draf($kode)
    {
        $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();
        return view('publikasi.draf.detail', compact('announcement'));
    }

    // Show the form for editing the specified resource.
    public function edit($kode)
    {
        $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();
        return view('article_announcements.edit', compact('announcement'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $kode)
    {
        $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();

        $validatedData = $request->validate([
            'kode' => 'required|unique:article_announcement,kode,' . $announcement->kode . ',kode',
            'user_id' => 'required|exists:user,user_id',
            'kategori' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tanggal_publish' => 'required|date',
            'tanggal_dibuat' => 'required|date',
            'tanggal_edit' => 'nullable|date',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required',
            'image_url' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255'
        ]);

        $announcement->update($validatedData);

        return redirect()->route('article_announcements.index')->with('success', 'Announcement updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($kode)
    {
        $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();
        $announcement->delete();

        return redirect()->route('article_announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
