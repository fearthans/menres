<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersyaratanKeamanan extends Model
{
    use HasFactory;

    protected $fillable = ['id_aset', 'jenis', 'kebutuhan'];

    public function informasiAsetKritis()
    {
        return $this->belongsTo(InformasiAsetKritis::class, 'id_aset');
    }

    public static function getSecurityRequirementAssetCounts() {
        $assetRequirement = self::with('informasiAsetKritis')
            ->selectRaw('jenis, count(*) as jumlah_aset')
            ->groupBy('jenis')
            ->orderBy('jenis', 'asc')
            ->get();

        $data = $assetRequirement->map(function ($item) {
            return $item->jumlah_aset;
        });
        return $data;
        // var_dump(json_encode($data));
    }
}
