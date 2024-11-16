<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiAsetKritis extends Model
{
    use HasFactory;

    protected $fillable = ['id_kategori', 'name', 'deskripsi'];

    public function kategoriAsetKritis()
    {
        return $this->belongsTo(KategoriAsetKritis::class, 'id_kategori');
    }

    public function persyaratanKeamanan()
    {
        return $this->hasOne(PersyaratanKeamanan::class);
    }

    public function risiko()
    {
        return $this->hasMany(Risiko::class, 'id_aset');
    }

    public function scopeCountByMonth($query, $month = null, $year = null)
    {
        $month = $month ?? date('m');
        $year = $year ?? date('Y');

        return $query->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }

    public static function getMonthlyPercentageChange()
    {
        $currentMonthCount = self::countByMonth();
        $previousMonthCount = self::countByMonth(date('m') - 1, date('Y'));

        if ($previousMonthCount === 0) {
            return 'Tidak ada data bulan sebelumnya';
        }

        $percentageChange = (($currentMonthCount - $previousMonthCount) / $previousMonthCount) * 100;

        return number_format($percentageChange) . '%';
    }

    public static function getRangeDateCreated()
    {
        $firstData = self::orderBy('created_at', 'asc')->first();
        $lastData = self::orderBy('created_at', 'desc')->first();

        // Format tanggal menjadi "Bulan Awal - Bulan Akhir"
        if ($firstData && $lastData) {
            $startDate = Carbon::parse($firstData->created_at)->format('M d');
            $endDate = Carbon::parse($lastData->created_at)->format('M d');
            $timeRange = $startDate . ' - ' . $endDate;
            return $timeRange; // Output: Contoh: Feb 1 - Apr 1
        } else {
            return "Tidak ada data";
        }
    }

    public static function getCountAssetByCategory()
    {
        // Mengambil jumlah aset kritis per kategori beserta nama kategorinya
        $asetKritisPerKategori = self::with('kategoriAsetKritis')
            ->selectRaw('id_kategori, count(*) as jumlah_aset')
            ->groupBy('id_kategori')
            ->get();

        // Mengubah data menjadi format yang lebih mudah dibaca
        return $asetKritisPerKategori->map(function ($item) {
            return [
                'value' => $item->jumlah_aset,
                'name' => $item->kategoriAsetKritis->name,
            ];
        });
    }
}
