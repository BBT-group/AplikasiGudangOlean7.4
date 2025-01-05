<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Thumbnails;

class LaporanMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $tableBarang = 'barang';
    protected $tableInventaris = 'inventaris';
    protected $tableMsBarangMasuk = 'ms_barang_masuk';
    protected $tableSatuan = 'satuan';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['id_barang', 'id_ms_barang_masuk', 'jumlah', 'id_inventaris'];



    public function getBarangMasukGabung()
    {
        return
            $this->select('barang_masuk.*, barang.stok, barang.harga_beli, barang.nama, ms_barang_masuk.waktu, satuan.nama_satuan,ms_barang_masuk.keterangan')
            ->join($this->tableBarang, 'barang.id_barang = barang_masuk.id_barang')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->join($this->tableSatuan, 'satuan.id_satuan = barang.id_satuan')
            ->findAll();
    }


    public function getBarangMasukGabungFilter($start_date, $end_date)
    {
        return $this->db->table($this->table)
            ->select('barang_masuk.*, barang.stok, barang.harga_beli, barang.nama, ms_barang_masuk.waktu, satuan.nama_satuan,ms_barang_masuk.keterangan')
            ->join($this->tableBarang, 'barang.id_barang = barang_masuk.id_barang')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->join($this->tableSatuan, 'satuan.id_satuan = barang.id_satuan')
            ->where('DATE(ms_barang_masuk.waktu) >=', $start_date)
            ->where('DATE(ms_barang_masuk.waktu) <=', $end_date)
            ->get()
            ->getResultArray();
    }



    public function getAlatMasukGabung()
    {
        return $this->db->table($this->table)
            ->select('barang_masuk.*, inventaris.stok, inventaris.harga_beli, inventaris.nama_inventaris as nama, ms_barang_masuk.waktu,ms_barang_masuk.keterangan,"alat" as nama_satuan,inventaris.id_inventaris as id_barang')
            ->join('inventaris', 'inventaris.id_inventaris = barang_masuk.id_inventaris')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->orderBy('waktu', 'DESC')
            ->get()
            ->getResultArray();
    }
}
