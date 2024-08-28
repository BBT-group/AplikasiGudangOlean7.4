<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $tableInventaris = 'inventaris';
    protected $tablePenerima = 'penerima';
    protected $tableMsPeminjaman = 'ms_peminjaman';
    protected $primaryKey = 'id_peminjaman';

    public function getPeminjaman()
    {
        return $this->findAll();
    }

    public function getPeminjamanGabung()
    {
        return $this->db->table($this->table)
            ->select('peminjaman.*, inventaris.nama_inventaris, penerima.nama as nama_penerima, ms_peminjaman.tanggal_pinjam, ms_peminjaman.tanggal_kembali')
            ->join($this->tableInventaris, 'inventaris.id_inventaris = peminjaman.id_inventaris')
            ->join($this->tableMsPeminjaman, 'ms_peminjaman.id_ms_peminjaman = peminjaman.id_ms_peminjaman')
            ->join($this->tablePenerima, 'penerima.id_penerima = ms_peminjaman.id_penerima')
            ->get()
            ->getResultArray();
    }

    public function getPeminjamanGabungFilter($start_date, $end_date)
    {
        return $this->db->table($this->table)
            ->select('peminjaman.*, inventaris.nama_inventaris, penerima.nama as nama_penerima, ms_peminjaman.tanggal_pinjam, ms_peminjaman.tanggal_kembali')
            ->join($this->tableInventaris, 'inventaris.id_inventaris = peminjaman.id_inventaris')
            ->join($this->tableMsPeminjaman, 'ms_peminjaman.id_ms_peminjaman = peminjaman.id_ms_peminjaman')
            ->join($this->tablePenerima, 'penerima.id_penerima = ms_peminjaman.id_penerima')
            ->where('DATE(ms_peminjaman.tanggal_pinjam) >=', $start_date)
            ->where('DATE(ms_peminjaman.tanggal_pinjam) <=', $end_date)
            ->get()
            ->getResultArray();
    }

    public function getByMasterId($id)
    {
        return $this->where('id_peminjaman', $id)->findAll();
    }
}
