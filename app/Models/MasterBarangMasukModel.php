<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterBarangMasukModel extends Model
{
    protected $table = 'ms_barang_masuk';
    protected $primaryKey = 'id_ms_barang_masuk';
    protected $allowedFields = ['waktu', 'id_supplier', 'keterangan'];
    protected bool $allowEmptyInserts = true;

    public function getAll()
    {

        return $this->select('ms_barang_masuk.*, supplier.nama ')
            ->orderBy('waktu', 'DESC')
            ->join('supplier', 'supplier.id_supplier = ms_barang_masuk.id_supplier')
            ->findAll();
    }

    public function getById($id)
    {
        return $this->select('ms_barang_masuk.*, supplier.nama ')
            ->join('supplier', 'supplier.id_supplier = ms_barang_masuk.id_supplier')->where('id_ms_barang_masuk', $id)->first();
    }

    public function getBarangMasukGabungFilter($start_date, $end_date)
    {
        return $this->db->table($this->table)
            ->join('barang_masuk', 'barang_masuk.id_ms_barang_masuk = ms_barang_masuk.id_ms_barang_masuk')
            ->join('barang', 'barang.id_barang = barang_masuk.id_barang')
            ->where('DATE(ms_barang_masuk.waktu) >=', $start_date)
            ->where('DATE(ms_barang_masuk.waktu) <=', $end_date)

            ->get()
            ->getResultArray();
    }
    public function getBarangMasukPerBulan($year)
    {
        return $this->select("MONTH(waktu) as month, COUNT(id_ms_barang_masuk) as total")
            ->where("YEAR(waktu)", $year)
            ->groupBy("MONTH(waktu)")
            ->orderBy("month")
            ->findAll();
    }
}
