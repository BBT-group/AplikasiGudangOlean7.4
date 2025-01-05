<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterPeminjamanModel extends Model
{
    protected $table = 'ms_peminjaman';
    protected $primaryKey = 'id_ms_peminjaman';
    protected $allowedFields = ['tanggal_pinjam', 'tanggal_kembali', 'id_penerima', 'status', 'bukti_peminjaman', 'keterangan'];

    public function getAll()
    {
        return $this->select('ms_peminjaman.*,penerima.nama')
            ->orderBy('tanggal_pinjam', 'DESC')
            ->join('penerima', 'penerima.id_penerima = ms_peminjaman.id_penerima')
            ->findAll();
    }

    public function getAllWithNama() {}
    public function getById($id)
    {
        return $this->select('ms_peminjaman.*,penerima.nama')
            ->join('penerima', 'penerima.id_penerima = ms_peminjaman.id_penerima')
            ->where('id_ms_peminjaman', $id)
            ->first();
    }
    public function getChartData()
    {
        return $this->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->findAll();
    }
}
