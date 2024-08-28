<?php

namespace App\Controllers;

use App\Models\InventarisModel;

class Inventaris extends BaseController
{
    protected $inventarisModel;

    public function __construct()
    {
        $this->inventarisModel = new InventarisModel();
    }

    public function index()
    {
        $data = [
            'alat' => $this->inventarisModel->findAll(),
        ];
        echo view('v_header');
        return view('v_inventaris', $data);
    }

    public function indexTambah()
    {
        session()->set('id_temp', '');
        $dataAlat = [
            'inventaris' => $this->inventarisModel->findAll()
        ];

        echo view('v_header');
        return view('v_tambah_inventaris', $dataAlat);
    }

    public function simpanAlat()
    {
        if (!$this->validate([
            'id_inventaris' => 'required|is_unique[inventaris.id_inventaris]',
            'nama_inventaris' => 'required',
            'foto' => 'uploaded[foto]',
        ])) {
            return redirect()->to(base_url('inventaris/indextambah'))->withInput();
        }

        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
            $dataAlat = [
                'id_inventaris' => $this->request->getVar('id_inventaris'),
                'nama_inventaris' => $this->request->getVar('nama_inventaris'),
                'foto' => $foto_path,
                'stok' => 0,
                'harga_beli' => 0
            ];
            if (!$this->inventarisModel->insert($dataAlat)) {
                return redirect()->to('/inventaris')->with('success', 'Alat berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan barang');
            }
        } else {
            return redirect()->back()->with('error', 'Foto tidak valid atau sudah dipindahkan');
        }
    }

    public function indexDetail($id_inventaris = null)
    {
        $data = [
            'alat' => $this->inventarisModel->getById($id_inventaris)->first()
        ];
        echo view('v_header');
        return view('admin\detailalat', $data);
    }

    public function indexUpdate($id_inventaris = null)
    {
        $data = [
            'alat' => $this->inventarisModel->getById($id_inventaris)->first()
        ];
        echo view('v_header');
        return view('v_update_inventaris', $data);
    }

    // fungsi update alat
    public function updateAlat()
    {
        if (!$this->validate([
            'id_inventaris' => 'required|is_not_unique[inventaris.id_inventaris]',
            'nama_inventaris' => 'required',
        ])) {
            return redirect()->back();
        }
        $file = $this->request->getFile('foto');
        $dataLama = $this->inventarisModel->getById($this->request->getVar('id_inventaris'))->first();
        if ($file->isValid() && !$file->hasMoved()) {
            $fotoLama = $dataLama['foto'];
            unlink($fotoLama);
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/', $newName);
            $foto_path = 'uploads/' . $newName;
        } else {
            $foto_path =  $dataLama['foto'];
        }
        $data = [
            'nama_inventaris' => $this->request->getVar('nama_inventaris'),
            'foto' => $foto_path,
            'stok' => $this->request->getVar('stok'),
            'harga_beli' => $this->request->getVar('harga_beli'),
        ];
        if (!$this->inventarisModel->update($this->request->getVar('id_inventaris'), $data)) {
            return redirect()->back()->withInput();
        }
        return redirect()->to(base_url('/inventaris'))->with('success', 'Alat berhasil diperbarui');
    }

    public function deleteAlat($id_inventaris)
    {
        $this->inventarisModel->delete($id_inventaris);
        session()->setFlashdata('success', 'Alat berhasil dihapus');
        return redirect()->to(base_url('inventaris'));
    }
}
