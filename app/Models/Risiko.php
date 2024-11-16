<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Risiko extends Model
{
    use HasFactory;

    protected $table = 'risikos';
    protected $primaryKey = 'id';
    protected $fillable = ['kode', 'id_aset', 'kerentanan', 'ancaman', 'potensi_sebab', 'potensi_efek', 'severity', 'occurrence', 'detection', 'mitigation', 'mitigation_date', 'created_at', 'updated_at'];

    public function asetKritis()
    {
        return $this->belongsTo(InformasiAsetKritis::class, 'id_aset');
    }

    public static function getRisksOrderByAsset()
    {
        $risiko = Risiko::with('asetKritis')
            ->get()
            ->groupBy('id_aset');

        $risikos = $risiko->map(function ($item) {
            return [
                'id' => $item[0]->asetKritis->id,
                'aset' => $item[0]->asetKritis->name,
                // 'aset' => $item->asetKritis->name,
                'risiko' => $item->map(function ($risiko) {
                    return [
                            'aset' => $risiko->id,
                            'kode' => $risiko->kode,
                            'kerentanan' => $risiko->kerentanan,
                            'ancaman' => $risiko->ancaman,
                            'potensi_sebab' => $risiko->potensi_sebab,
                            'potensi_efek' => $risiko->potensi_efek,
                            'severity' => $risiko->severity,
                            'occurrence' => $risiko->occurrence,
                            'detection' => $risiko->detection
                        ];
                })->toArray(),
            ];
        });
        return($risikos);
    }

    // ambil jumlah asset semua, lalu ambil jumlah aseet yang punya nilai risiko
    // buat list yang menampilkan jumlah risiko yang dimiliki tiap asset 
}
