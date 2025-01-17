<?php

namespace App\Controllers;



use App\Models\KategoriModel;



class Kategori extends BaseController
{

    protected $kategoriModel;


    public function __construct()
    {

        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'kategori' => $this->kategoriModel->findAll(),

        ];
        echo view('v_header');
        return view('v_kategori', $data);
    }

    public function tambahKategori()
    {
        if (!$this->validate([
            'nama_kategori' => [
                'rules'  => 'required|is_unique[kategori.nama_kategori]',
                'errors' => [
                    'is_unique' => 'Nama Kategori telah terdaftar',
                ],
            ]
        ])) {
            return redirect()->to(base_url('kategori/indextambah'))->withInput();
        }
        $this->kategoriModel->insert(['nama_kategori' => $this->request->getVar('nama_kategori')]);
        session()->setFlashdata('success', 'Kategori berhasil ditambahkan');
        return redirect()->to(base_url('kategori'));
    }

    public function indexUpdate($id)
    {
        $data = [
            'kategori' => $this->kategoriModel->where('id_kategori', $id)->first(),
            'validation' => validation_list_errors()
        ];
        echo view('v_header');
        return view('v_update_kategori', $data);
    }

    public function indexTambah()
    {
        $data = ['validation' => validation_list_errors()];
        echo view('v_header');
        return view('v_tambah_kategori', $data);
    }


    public function updateKategori()
    {
        if (!$this->validate([
            'id_kategori' => 'required|is_not_unique[kategori.id_kategori]',
            'nama_kategori' => [
                'rules'  => 'required|is_unique[kategori.nama_kategori]',
                'errors' => [
                    'is_unique' => 'Nama Kategori telah terdaftar',
                ],
            ]
        ])) {
            return redirect()->back()->withInput();
        }
        if (!$this->kategoriModel->update($this->request->getVar('id_kategori'), ['nama_kategori' => $this->request->getVar('nama_kategori')])) {
            return redirect()->back()->withInput();
        }
        session()->setFlashdata('success', 'Kategori berhasil diupdate');
        return redirect()->to(base_url('/kategori'));
    }
    public function deleteKategori($id_kategori)
    {
        $this->kategoriModel->delete($id_kategori);
        session()->setFlashdata('success', 'Kategori berhasil dihapus');
        return redirect()->to(base_url('kategori'));
    }
}
