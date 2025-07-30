<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\presencedetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = presence::all();
        return view('pages.presence.index', compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.presence.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
        ]);

        $presence = new presence();
        $presence->nama_kegiatan = $request->nama_kegiatan;
        $presence->slug = Str::slug($request->nama_kegiatan);
        $presence->tgl_kegiatan = $request->tanggal_kegiatan . ' ' . $request->waktu_mulai;
        $presence->save();

        return redirect()->route('presence.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $presence = Presence::findOrFail($id);
    $presenceDetails =presencedetail ::where('presence_id', $id)->get();
    return view('pages.presence.detail.show', compact('presence', 'presenceDetails'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $presence = Presence::findOrFail($id);
        return view('pages.presence.edit', compact('presence'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $request->validate([
        'nama_kegiatan' => 'required',
        'tanggal_kegiatan' => 'required',
        'waktu_mulai' => 'required',
    ]);

    $presence = Presence::findOrFail($id);
    $presence->nama_kegiatan = $request->nama_kegiatan;
    $presence->slug = Str::slug($request->nama_kegiatan);
    $presence->tgl_kegiatan = $request->tanggal_kegiatan . ' ' . $request->waktu_mulai;
    $presence->save();

    return redirect()->route('presence.index');
}

    public function destroy(string $id)
    {
        Presence::destroy($id);

        return redirect()->route('presence.index');
    }
}
