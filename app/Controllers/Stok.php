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
            'satuan' => $this->satuanModel->findAll(),
            'validation' => validation_list_errors()
        ];

        echo view('v_header');
        return view('v_tambah_barang', $data);
    }

    public function tambahBarang()
    {
        if (!$this->validate([
            'id_barang' => [
                'label'  => 'id_barang',
                'rules'  => 'required|is_unique[barang.id_barang]',
                'errors' => [
                    'is_unique' => 'ID Barang telah terdaftar',
                ],
            ],
            'foto' => 'uploaded[foto]|is_image[foto]',
        ])) {
            return redirect()->to(base_url('stok/indextambah'))->withInput();
        }
        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();

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
                $file->move(ROOTPATH . 'public/uploads', $newName);
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
        return view('admin/detailbarang', $data);
    }

    // fungsi update barang

    public function indexUpdate($id_inventaris = null)
    {
        $data = [
            'data' => $this->barangModel->getBarangById($id_inventaris),
            'satuan' => $this->satuanModel->findAll(),
            'kategori' => $this->kategoriModel->findAll(),
            'validation' => validation_list_errors()
        ];
        echo view('v_header');
        return view('v_update_barang', $data);
    }
    public function updateBarang()
    {
        if (!$this->validate([
            'id_inventaris' => [
                'rules'  => 'required|is_not_unique[inventaris.id_inventaris]',
                'errors' => [
                    'is_unique' => 'ID inventaris telah terdaftar',
                ],
            ],
            'nama' => 'required',
            'stok' => 'required',
            'harga_beli' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'foto' => 'is_image[foto]',
        ])) {
            return redirect()->back()->withInput();
        }
        $dataLama = $this->barangModel->getBarangById($this->request->getVar('id_barang'));
        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $fotoLama = $dataLama['foto'];
            $newName = $file->getRandomName();
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
            if ($this->barangModel->update($this->request->getVar('id_barang'), $data)) {
                if (file_exists(ROOTPATH . 'public/uploads/' . $fotoLama)) {
                    unlink($fotoLama);
                }
                $file->move(ROOTPATH . 'public/uploads', $newName);
                session()->setFlashdata('update', 'Barang berhasil diupdate');
                return redirect()->to(base_url('/stok'));
            } else {
                return redirect()->back()->withInput();
            }
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
            if ($this->barangModel->update($this->request->getVar('id_barang'), $data)) {
                session()->setFlashdata('update', 'Barang berhasil diupdate');
                return redirect()->to(base_url('/stok'));
            } else {
                return redirect()->back()->withInput();
            }
        }
    }
    public function deleteBarang($id_barang)
    {
        $data = $this->barangModel->getBarangById($id_barang);
        if (file_exists($data['foto'])) {
            unlink($data['foto']);
        }
        $this->barangModel->delete($id_barang);
        session()->setFlashdata('delete', 'Barang berhasil dihapus');
        return redirect()->to('/stok');
    }
}
