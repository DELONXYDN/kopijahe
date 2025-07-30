<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\PresenceDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresenceDetailController extends Controller
{
    public function exportpdf(string $id)
    {
        $presence = Presence::findOrFail($id);
        $presenceDetails = PresenceDetail::where('presence_id', $id)->get();

        // Path dasar folder tanda tangan
        $folderPath = storage_path('app/public/tanda-tangan');

        foreach ($presenceDetails as $detail) {
            if ($detail->tanda_tangan) {
                // Buat path absolut ke file tanda tangan
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $detail->tanda_tangan;

                if (file_exists($filePath)) {
                    $type = pathinfo($filePath, PATHINFO_EXTENSION);
                    $data = file_get_contents($filePath);
                    $detail->tanda_tangan_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                } else {
                    $detail->tanda_tangan_base64 = null;
                }
            } else {
                $detail->tanda_tangan_base64 = null;
            }
        }

        // Load view PDF
        $pdf = Pdf::setOptions(['isRemoteEnabled' => true])
            ->loadView('pages.presence.detail.export-pdf', compact('presence', 'presenceDetails'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream("{$presence->nama_kegiatan}.pdf");
    }
}
