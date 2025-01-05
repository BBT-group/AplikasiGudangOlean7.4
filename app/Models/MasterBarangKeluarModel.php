<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBarangKeluarModel extends Model
{
    protected $table = 'ms_barang_keluar';
    protected $primaryKey = 'id_ms_barang_keluar';
    protected $allowedFields = ['waktu', 'id_penerima', 'keterangan'];

    public function getAll()
    {
        return $this->select('ms_barang_keluar.*, penerima.nama ')
            ->join('penerima', 'penerima.id_penerima = ms_barang_keluar.id_penerima')
            ->orderBy('waktu', 'DESC')
            ->findAll();
    }
    public function getById($id)
    {
        return $this->select('ms_barang_keluar.*, penerima.nama ')
            ->join('penerima', 'penerima.id_penerima = ms_barang_keluar.id_penerima')->where('id_ms_barang_keluar', $id)->first();
    }
    public function getBarangKeluarPerBulan($year)
    {
        return $this->select("MONTH(waktu) as month, COUNT(id_ms_barang_keluar) as total")
            ->where("YEAR(waktu)", $year)
            ->groupBy("MONTH(waktu)")
            ->orderBy("month")
            ->findAll();
    }
}
