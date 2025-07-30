<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = ['nama_kegiatan', 'slug', 'tgl_kegiatan'];

    // Relasi: satu Presence punya banyak PresenceDetail
    public function details()
    {
        return $this->hasMany(PresenceDetail::class);
    }
}
