<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptOrder extends Model
{
    use HasFactory;
    protected $table='trecd';
    protected $fillable = [
        'id',
        'jenis_dokumen',
        'nomoraju',
        'dpbnomor',
        'dpbtanggal',
        'bpbnomor',
        'bpbtanggal',
        'pemasok_pengirim',
        'kode_barang',
        'nama_barang',
        'sat',
        'jumlah',
        'nilai_barang',
        'nilai_barang_usd',
        'comp_code',
        'note',
        'tstatus'];
}
