<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SatuanModel;
use Config\Pager;
use PhpParser\Node\Stmt\TryCatch;

class Stok extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $satuanModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->satuanModel = new SatuanModel();
    }

    public function index(): string
    {

        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->barangModel->getBarangByName($keyword);
        } else {
            $barang = $this->barangModel->getBarangWithKategori();
        }
        $data = [

            'barang' => $barang->findAll(),
            'pager' => $this->barangModel->pager
        ];
        echo view('v_header');
        return view('v_stok', $data);
    }

    public function indexTambah()
    {
        session()->set('id_temp', '');
        $data = [
            'kategori' => $this->kategoriModel->findAll(),
            'satuan' => $this->satuanModel->findAll()
        ];

        echo view('v_header');
        return view('v_tambah_barang', $data);
    }

    public function tambahBarang()
    {
        if (!$this->validate([
            'id_barang' => 'required|is_unique[barang.id_barang]',
        ])) {
            return redirect()->to(base_url('stok/indextambah'))->withInput();
        }
        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;

            $newID = $this->kategoriModel->where('nama_kategori', $this->request->getPost('id_kategori'))->first();
            $idSat = $this->satuanModel->where('nama_satuan', $this->request->getPost('id_satuan'))->first();

            $data = [
                'id_barang' => $this->request->getPost('id_barang'),
                'nama' => $this->request->getPost('nama'),
                'foto' => $foto_path,
                'stok' => 0,
                'harga_beli' => 0,
                'id_kategori' => $newID['id_kategori'],
                'id_satuan' => $idSat['id_satuan'],
            ];

            if (!$this->barangModel->insert($data)) {
                return redirect()->to('/stok')->with('success', 'Barang berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan barang');
            }
        } else {
            return redirect()->back()->with('error', 'Foto tidak valid atau sudah dipindahkan');
        }
    }

    // fungsi ke detail barang
    public function indexDetail($id_barang = null)
    {
        $barang = $this->barangModel->getBarangById($id_barang);
        $data = [
            'data' => $barang,
        ];
        echo view('v_header');
        return view('admin\detailbarang', $data);
    }

    // fungsi update barang

    public function indexUpdate($id_inventaris = null)
    {
        $data = [
            'data' => $this->barangModel->getBarangById($id_inventaris),
            'satuan' => $this->satuanModel->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_update_barang', $data);
    }
    public function updateBarang()
    {
        $dataLama = $this->barangModel->getBarangById($this->request->getVar('id_barang'));
        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $fotoLama = $dataLama['foto'];
            unlink($fotoLama);
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
            $newID = $this->kategoriModel->where('nama_kategori', $this->request->getVar('id_kategori'))->first();
            $idSat = $this->satuanModel->where('nama_satuan', $this->request->getVar('id_satuan'))->first();
            $data = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'foto' => $foto_path,
                'stok' => $this->request->getVar('stok'),
                'harga_beli' => $this->request->getVar('harga_beli'),
                'id_kategori' => $newID['id_kategori'],
                'id_satuan' => $idSat['id_satuan'],
            ];
            $this->barangModel->update($this->request->getVar('id_barang'), $data);
            session()->setFlashdata('update', 'Barang berhasil diupdate');
            return redirect()->to(base_url('/stok'));
        } else {
            $newID = $this->kategoriModel->where('nama_kategori', $this->request->getVar('id_kategori'))->first();
            $idSat = $this->satuanModel->where('nama_satuan', $this->request->getVar('id_satuan'))->first();
            $data = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'foto' => $dataLama['foto'],

                'stok' => $this->request->getVar('stok'),
                'harga_beli' => $this->request->getVar('harga_beli'),
                'id_satuan' => $idSat['id_satuan'],
                'id_kategori' => $newID['id_kategori'],
            ];
            $this->barangModel->update($this->request->getVar('id_barang'), $data);
            session()->setFlashdata('update', 'Barang berhasil diupdate');
            return redirect()->to('/stok');
        }
    }
    public function deleteBarang($id_barang)
    {
        $data = $this->barangModel->getBarangById($id_barang);
        unlink($data['foto']);
        $this->barangModel->delete($id_barang);
        session()->setFlashdata('delete', 'Barang berhasil dihapus');
        return redirect()->to('/stok');
    }
}
