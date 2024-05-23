<?php
namespace App\Http\Controllers;

use App\Models\ArticleAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleAnnouncementController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $user = Auth::user();
        $announcements = ArticleAnnouncement::where('user_id', $user->user_id)->get();
        return view('article_announcements.index', compact('announcements'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $announcement = new ArticleAnnouncement();
        return view('article_announcements.create', compact('announcement'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|unique:article_announcement',
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

        ArticleAnnouncement::create($validatedData);

        return redirect()->route('article_announcements.index')->with('success', 'Announcement created successfully.');
    }

    // Display the specified resource.
    public function show($kode)
    {
        $announcement = ArticleAnnouncement::where('kode', $kode)->where('user_id', Auth::user()->user_id)->firstOrFail();
        return view('article_announcements.show', compact('announcement'));
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
