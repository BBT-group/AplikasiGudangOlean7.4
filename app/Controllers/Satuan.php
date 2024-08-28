<?php

namespace App\Controllers;



use App\Models\SatuanModel;




class Satuan extends BaseController
{

    protected $satuanModel;


    public function __construct()
    {

        $this->satuanModel = new SatuanModel();
    }

    public function index()
    {
        $data = [
            'satuan' => $this->satuanModel->findAll()
        ];
        echo view('v_header');
        return view('v_satuan', $data);
    }

    public function indexTambah()
    {
        echo view('v_header');

        return view('admin/v_tambah_satuan');
    }

    public function tambahSatuan()
    {
        if (!$this->validate([
            'nama_satuan' => 'required|is_unique[satuan.nama_satuan]'
        ])) {
            session()->setFlashdata('warning', 'Satuan sudah ada');
            return redirect()->to(base_url('/satuan/indextambah'))->withInput();
        }
        $this->satuanModel->insert(['nama_satuan' => $this->request->getVar('nama_satuan')]);
        session()->setFlashdata('success', 'Satuan berhasil ditambahkan');
        return redirect()->to(base_url('satuan'));
    }

    public function indexUpdate($id)
    {
        $data = [
            'satuan' => $this->satuanModel->where('id_satuan', $id)->first()
        ];
        echo view('v_header');
        return view('v_update_satuan', $data);
    }

    public function updateSatuan()
    {
        if (!$this->validate([
            'id_satuan' => 'required|is_not_unique[satuan.id_satuan]',
            'nama_satuan' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }
        if (!$this->satuanModel->update($this->request->getVar('id_satuan'), ['nama_satuan' => $this->request->getVar('nama_satuan')])) {
            return redirect()->back()->withInput();
        }
        session()->setFlashdata('success', 'Satuan berhasil diupdate');
        return redirect()->to(base_url('/satuan'));
    }

    public function deleteSatuan($id_satuan)
    {
        $this->satuanModel->delete($id_satuan);
        session()->setFlashdata('success', 'Satuan berhasil dihapus');
        return redirect()->to(base_url('satuan'));
    }
}
