<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_laundry',      // By weight or by item
        'jenis_layanan',      // Wash and iron or wash and fold
        'tarif_layanan',      // Service rate
        'durasi_layanan',     // Express, 2 days, or 3 days
        'keterangan',         // Additional description
    ];

    /**
     * Combine the service type and turnaround time into one string.
     */
    public function getLayananAttribute()
    {
        return "{$this->jenis_layanan} - {$this->durasi_layanan}";
    }

    /**
     * Split the combined service into a service type and turnaround time.
     * @param string $layanan
     */
    public function setLayananAttribute($layanan)
    {
        [$jenisLayanan, $durasiLayanan] = explode(' - ', $layanan);
        $this->attributes['jenis_layanan'] = $jenisLayanan;
        $this->attributes['durasi_layanan'] = $durasiLayanan;
    }
}
