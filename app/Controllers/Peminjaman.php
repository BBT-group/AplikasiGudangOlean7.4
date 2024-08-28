<?php

namespace App\Controllers;

use App\Models\InventarisModel;
use App\Models\MasterPeminjamanModel;
use App\Models\PeminjamanModel;
use App\Models\PenerimaModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $masterPeminjamanModel;
    protected $penerimaModel;
    protected $inventarisModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->masterPeminjamanModel = new MasterPeminjamanModel();
        $this->penerimaModel = new PenerimaModel();
        $this->inventarisModel = new InventarisModel();
    }
    public function index()
    {
        $data = [
            'pinjam' => $this->masterPeminjamanModel->getAllWithNama(),
        ];
        echo view('v_header');
        return view('v_beranda_peminjaman', $data);
    }
    public function updateStok()
    {
        if (!$this->validate([
            'nama_penerima' => 'required'
        ])) {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
        $barang = session()->get('datalist_pinjam');
        if (!empty($barang)) {
            $namaPenerima = $this->request->getVar('nama_supplier');
            if ($this->penerimaModel->where('nama', $namaPenerima)->first() == null) {
                $suppId = $this->penerimaModel->insert(['nama' =>
                $namaPenerima], true);
            } else {
                $supp = $this->penerimaModel->where('nama', $namaPenerima)->first();
                $suppId = $supp['id_supplier'];
            }
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime =  date("Y-m-d H:i:s");
            $this->masterPeminjamanModel->insert(['waktu' => $currentDateTime, 'id_supplier' => $suppId]);

            $idms = $this->masterPeminjamanModel->getInsertID();

            foreach ($barang as $b) {
                $barang1 = $this->inventarisModel->where('id_barang', $b['id_barang'])->first();
                $data = [
                    'nama' => $barang1['nama'],
                    'id_satuan' => $barang1['id_satuan'],
                    'foto' => $barang1['foto'],

                    'stok' => $barang1['stok'] + $b['stok'],
                    'harga_beli' => $b['harga_beli'],
                    'id_kategori' => $barang1['id_kategori'],
                ];

                $this->inventarisModel->update($b['id_barang'], $data);

                $this->peminjamanModel->insert(['id_barang' => $barang1['id_barang'], 'id_ms_barang_masuk' => $idms, 'jumlah' => $b['stok']]);

                session()->remove('datalist');
                return redirect()->to(base_url('/barang_masuk'));
            }
        } else {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
    }
}
