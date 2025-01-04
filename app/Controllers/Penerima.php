<?php

namespace App\Controllers;

use App\Models\PenerimaModel;

class Penerima extends BaseController
{

    protected $penerimaModel;


    public function __construct()
    {

        $this->penerimaModel = new PenerimaModel();
    }

    public function index()
    {
        $data = [
            'penerima' => $this->penerimaModel->findAll()
        ];
        echo view('v_header');
        return view('v_penerima', $data);
    }

    public function tambahPenerima()
    {

        if ($this->request->getMethod() == 'post') {
            if (!$this->validate([
                'nama' => 'required|is_unique[penerima.nama]'
            ])) {
                // ganti url
                return redirect()->to(base_url('penerima/tambahpenerima'))->withInput();
            }
            $this->penerimaModel->insert([
                'nama' => $this->request->getVar('nama')
            ]);
            return redirect()->to(base_url('/penerima'));
        }
        $data['validation'] = validation_list_errors();
        echo view('v_header');
        return view('v_tambah_penerima', $data);
    }
    public function updatePenerima($id = null)

    {
        if ($this->request->getMethod() == 'post') {
            if (!$this->validate([
                'nama' => 'required|is_unique[penerima.nama]'
            ])) {
                // ganti url
                return redirect()->to(base_url('penerima/updatepenerima'))->withInput();
            }
            $this->penerimaModel->update($id, [
                'nama' => $this->request->getVar('nama')
            ]);
            return redirect()->to(base_url('/penerima'));
        }
        $data['validation'] = validation_list_errors();
        echo view('v_header');
        return view('v_tambah_penerima', $data);
    }
    public function deletePenerima($id)
    {
        $this->penerimaModel->delete($id);
        session()->setFlashdata('success', 'Penerima berhasil dihapus');
        return redirect()->to(base_url('penerima'));
    }
}
