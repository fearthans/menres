<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAsetKritis extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function informasiAsetKritis()
    {
        return $this->hasMany(InformasiAsetKritis::class, 'id_kategori');
    }
}
