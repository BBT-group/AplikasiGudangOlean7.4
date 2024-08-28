<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterPeminjamanModel extends Model
{
    protected $table = 'ms_peminjaman';
    protected $primaryKey = 'id_ms_peminjaman';
    protected $allowedFields = ['tanggal_pinjam', 'tanggal_kembali', 'id_penerima', 'status', 'bukti_peminjaman', 'keterangan'];

    public function getAllWithNama()
    {
        return $this->select('ms_peminjaman.*,penerima.nama')
            ->join('penerima', 'penerima.id_penerima = ms_peminjaman.id_penerima');
    }
    public function getById($id)
    {
        return $this->select('ms_peminjaman.*,penerima.nama')
            ->join('penerima', 'penerima.id_penerima = ms_peminjaman.id_penerima')
            ->where('id_ms_peminjaman', $id)
            ->first();
    }
    public function getChartData() {
        return $this->select('status, COUNT(*) as count')
                    ->groupBy('status')
                    ->findAll();
    }
}
