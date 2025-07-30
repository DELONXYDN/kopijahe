<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\PresenceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsenController extends Controller
{
    public function index($slug)
{
    $presence = Presence::where('slug', $slug)->firstOrFail();
    $presenceDetails = PresenceDetail::where('presence_id', $presence->id)->get();

    return view('pages.absen.index', [
        'presence' => $presence,
        'presenceDetails' => $presenceDetails
    ]);
}

    public function save(Request $request, string $id)
    {
        $presence = Presence::findOrFail($id);

        $request->validate([
            'presence_id' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'asal_instansi' => 'required',
            'signature' => 'required',
        ]);

        $presenceDetail = new PresenceDetail();
        $presenceDetail->presence_id = $presence->id;
        $presenceDetail->nama = $request->nama;
        $presenceDetail->jabatan = $request->jabatan;
        $presenceDetail->asal_instansi = $request->asal_instansi;
        $presenceDetail->save();        

        //decode base64 image
        $base64_image = $request->signature;
        @list($type, $file_date) = explode(';', $base64_image);
        @list(, $file_date) = explode(',', $file_date);

        // generate nama file
        $uniqChar = date('YmdHis') . uniqid();
        $signature = "tanda-tangan/{$uniqChar}.png";


        // simpan gambar ke public
        Storage::disk('public')->put($signature, base64_decode($file_date));
        
        $presenceDetail->tanda_tangan = $signature;
        $presenceDetail->save();

        return redirect()->back();
        

    }
}
